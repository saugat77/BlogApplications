<template>
  <div class="container mt-5">
    <h2 class="mb-4">Categories</h2>

    <div class="mb-3 text-end">
      <button class="btn btn-success" @click="openModal()">New Category</button>
    </div>

    <!-- Category Table -->
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(category,index) in categories.data" :key="category.id">
          <td>{{ (categories.current_page - 1) * categories.per_page + index + 1 }}</td>
          <td>{{ category.name }}</td>
          <td>
            <button class="btn btn-sm btn-outline-primary" @click="editCategory(category)">Edit</button>
            <button class="btn btn-sm btn-outline-danger ms-2" @click="deleteCategory(category.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination -->
     <Pagination
      :current-page="categories.current_page"
      :total-pages="categories.last_page"
      @page-changed="fetchCategories"
    />

    <!-- Modal Component -->
    <CategoryModal ref="categoryModal" @saved="fetchCategories" />
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import axios from '../../axios'
import CategoryModal from './CategoryModal.vue';
import Pagination from '../../Common/Pagination.vue'

const categories = ref({ data: [], current_page: 1, last_page: 1, per_page: 10 })
const categoryModal = ref(null)

// Fetch categories with pagination
const fetchCategories = async (page = 1) => {
  try {
    const res = await axios.get(`/api/categories?page=${page}`)
    categories.value = res.data
  } catch (err) {
    console.error(err)
  }
}

// Modal functions
const openModal = () => {
  categoryModal.value.setCategory(null)
  categoryModal.value.showModal()
}

const editCategory = (category) => {
  categoryModal.value.setCategory(category)
  categoryModal.value.showModal()
}

const deleteCategory = async (id) => {
  if (!confirm('Are you sure?')) return
  try {
    await axios.delete(`/api/categories/${id}`)
    fetchCategories(categories.value.current_page)
  } catch (err) {
    console.error(err)
  }
}

onMounted(() => {
  fetchCategories()
})
</script>
