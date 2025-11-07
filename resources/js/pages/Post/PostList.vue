<template>
  <div class="container mt-5">
    <h2 class="mb-4">Posts</h2>

    <div class="mb-3 text-end">
      <button class="btn btn-success" @click="openModal">New Post</button>
    </div>

    <div class="row row-cols-1 row-cols-md-2 g-4">
      <div v-for="post in posts" :key="post.id" class="col">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">{{ post.title }}</h5>
            <p class="text-muted">By {{ post.author?.name }} | {{ post.category?.name }}</p>
            <p>{{ post.excerpt }}</p>
          </div>
          <div class="card-footer bg-light">
            <button class="btn btn-sm btn-outline-primary" @click="editPost(post)">
              Edit
            </button>
            <button class="btn btn-sm btn-outline-danger ms-2" @click="deletePost(post.id)">
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Component -->
    <PostModal ref="postModal" :categories="categories" :tags="tags" @saved="fetchPosts" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from '../../axios'
import PostModal from './PostForm.vue'

const posts = ref([])
const categories = ref([])
const tags = ref([])

// ref to modal
const postModal = ref(null)

const fetchPosts = async () => {
  try {
    const res = await axios.get('/api/posts')
    posts.value = res?.data
  } catch (err) {
    console.error(err)
  }
}

const openModal = () => {
  // show empty modal for creating a new post
  postModal.value.showModal()
}

const editPost = (post) => {
  // pass post to modal for editing
  postModal.value.setPost(post) // you need a method in PostModal to accept editing post
  postModal.value.showModal()
}

const deletePost = async (id) => {
  if (!confirm('Are you sure you want to delete this post?')) return
  await axios.delete(`/api/posts/${id}`)
  fetchPosts()
}

onMounted(() => {
  fetchPosts()
})
</script>
