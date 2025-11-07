<template>
  <div class="container mt-5">
    <h2 class="mb-4">Tags</h2>

    <div class="mb-3 text-end">
      <button class="btn btn-success" @click="openModal()">New Tag</button>
    </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(tag, index) in tags.data" :key="tag.id">
          <td>{{ (tags.current_page - 1) * tags.per_page + index + 1 }}</td>
          <td>{{ tag.name }}</td>
          <td>
            <button class="btn btn-sm btn-outline-primary" @click="editTag(tag)">Edit</button>
            <button class="btn btn-sm btn-outline-danger ms-2" @click="deleteTag(tag.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>

    <Pagination
      :current-page="tags.current_page"
      :total-pages="tags.last_page"
      @page-changed="fetchTags"
    />

    <TagModal ref="tagModal" @saved="fetchTags" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from '../../axios'
import TagModal from './TagModal.vue'
import Pagination from '../../Common/Pagination.vue'


const tags = ref({ data: [], current_page: 1, last_page: 1, per_page: 6 })
const tagModal = ref(null)

// Fetch tags for a specific page (default page 1)
const fetchTags = async (page = 1) => {
  try {
    const res = await axios.get(`/api/tags?page=${page}`)
    tags.value = res.data
  } catch (err) {
    console.error(err)
  }
}

const openModal = () => tagModal.value.setTag(null)
const editTag = (tag) => tagModal.value.setTag(tag)
const deleteTag = async (id) => {
  if (!confirm('Are you sure you want to delete this tag?')) return
  try {
    await axios.delete(`/api/tags/${id}`)
    fetchTags(tags.value.current_page)
  } catch (err) {
    console.error(err)
  }
}

onMounted(() => fetchTags())
</script>
