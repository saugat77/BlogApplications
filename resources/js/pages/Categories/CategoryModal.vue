<template>
  <div class="modal fade" tabindex="-1" ref="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ category.id ? 'Edit Category' : 'New Category' }}</h5>
          <button type="button" class="btn-close" @click="hideModal"></button>
        </div>

        <div class="modal-body">
             <div v-if="errorMessage" class="alert alert-danger">
                {{ errorMessage }}
            </div>
          <div class="mb-3">
            <label class="form-label">Category Name <span class="text-danger">*</span></label>
            <input v-model="category.name" type="text" class="form-control" placeholder="Enter name" />
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" @click="hideModal">Cancel</button>
          <button class="btn btn-primary" @click="saveCategory">{{ category.id ? 'Update' : 'Create' }}</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Modal } from 'bootstrap'
import axios from '../../axios'

const category = ref({ name: '' })
const modal = ref(null)
let bsModal = null
const errorMessage = ref('')

const emit = defineEmits(['saved'])

onMounted(() => {
  bsModal = new Modal(modal.value, { backdrop: 'static', keyboard: false })
})

const showModal = () => bsModal?.show()
const hideModal = () => {
    bsModal?.hide()
    errorMessage.value = '';
}

const setCategory = (cat) => {
  if (cat) category.value = { ...cat }
  else category.value = { name: '' }
  errorMessage.value = ''
}

// Save or update category
const saveCategory = async () => {
  try {
     errorMessage.value = ''
      if (!category.value.name.trim()) {
      errorMessage.value = 'Category name is required.'
      return
    }
    if (category.value.id) {
      await axios.put(`/api/categories/${category.value.id}`, category.value)
    } else {
      await axios.post('/api/categories', category.value)
    }
    hideModal()
    emit('saved')
    category.value = { name: '' } // reset
  } catch (err) {
  if (err.response?.data?.errors?.name) {
      errorMessage.value = err.response.data.errors.name[0]
    } else if (err.response?.data?.message) {
      errorMessage.value = err.response.data.message
    } else {
      errorMessage.value = 'Something went wrong.'
    }
    console.error(err)
  }
}

// Expose methods to parent
defineExpose({ showModal, hideModal, setCategory })
</script>
