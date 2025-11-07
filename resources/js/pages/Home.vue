<template>
  <div class="container mt-5">
    <div class="card mb-4 shadow-sm p-3">
      <div class="row g-2 align-items-end">
        <div class="col-md-3">
          <label class="form-label">Title</label>
          <input v-model="filters.title" type="text" class="form-control" placeholder="Search title...">
        </div>
        <div class="col-md-3">
          <label class="form-label">Author</label>
          <input v-model="filters.author" type="text" class="form-control" placeholder="Search author...">
        </div>
        <div class="col-md-3">
          <label class="form-label">Category</label>
          <select v-model="filters.category" class="form-select">
            <option value="">All</option>
            <option v-for="cat in categories" :key="cat.id" :value="cat.name">{{ cat.name }}</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">Tags</label>
          <select v-model="filters.tag" class="form-select">
            <option value="">All</option>
            <option v-for="tag in tags" :key="tag.id" :value="tag.name">{{ tag.name }}</option>
          </select>
        </div>
      </div>

      <div class="mt-3 text-end">
        <button class="btn btn-primary" @click="fetchPosts">Search</button>
        <button class="btn btn-outline-secondary ms-2" @click="resetFilters">Reset</button>
      </div>
    </div>

    <!--Post cards -->
    <div v-if="posts.length" class="row row-cols-1 row-cols-md-2 g-4">
      <div v-for="post in posts" :key="post.id" class="col">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">{{ post.title }}</h5>
            <p class="card-text text-muted">By {{ post.author.name }} | {{ post.category.name }}</p>
            <p class="card-text">{{ post.excerpt }}</p>
            <div>
              <span v-for="tag in post.tags" :key="tag.id" class="badge bg-info me-1">
                {{ tag.name }}
              </span>
            </div>
          </div>

          <!-- Comment section -->
          <div class="card-footer bg-light">
            <button class="btn btn-sm btn-outline-primary" @click="toggleComments(post.id)">
              {{ showComments[post.id] ? 'Hide' : 'Show' }} Comments
            </button>

            <div v-if="showComments[post.id]" class="mt-3">
              <div v-for="comment in post.comments" :key="comment.id" class="mb-2 border-start ps-2">
                <strong>{{ comment.user.name }}</strong>:
                <span>{{ comment.body }}</span>
              </div>

              <div class="input-group mt-2">
                <input v-model="newComment[post.id]" type="text" class="form-control" placeholder="Add a comment...">
                <button class="btn btn-primary" @click="addComment(post.id)">Send</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-else class="text-center text-muted mt-5">
      <p>No posts found.</p>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import axios from 'axios'

const posts = ref([])
const categories = ref([])
const tags = ref([])
const filters = reactive({ title: '', author: '', category: '', tag: '' })
const showComments = reactive({})
const newComment = reactive({})

const fetchPosts = async () => {
  const { data } = await axios.get('/api/posts', { params: filters })
  posts.value = data
}

const resetFilters = () => {
  Object.keys(filters).forEach(k => filters[k] = '')
  fetchPosts()
}

const toggleComments = id => {
  showComments[id] = !showComments[id]
}

const addComment = async (postId) => {
  if (!newComment[postId]) return
  await axios.post(`/api/posts/${postId}/comments`, { body: newComment[postId] })
  newComment[postId] = ''
  fetchPosts()
}

onMounted(async () => {
  try {
    await fetchPosts()

    const catRes = await axios.get('/api/category/all')
    // const tagRes = await axios.get('/api/tags') // uncomment when ready

    categories.value = catRes.data
    // tags.value = tagRes?.data || [] // safe fallback
  } catch (err) {
    console.error('Error fetching posts or categories:', err)
  }
})
</script>
