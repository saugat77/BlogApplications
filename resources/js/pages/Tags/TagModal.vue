<template>
  <div class="modal fade" tabindex="-1" ref="modalRef">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ tag.id ? 'Edit Tag' : 'New Tag' }}</h5>
          <button type="button" class="btn-close" @click="hideModal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input v-model="tag.name" class="form-control" placeholder="Enter tag name" />
            <small class="text-danger">{{ error }}</small>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" @click="hideModal">Cancel</button>
          <button class="btn btn-primary" @click="saveTag">{{ tag.id ? 'Update' : 'Create' }}</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from '../../axios'
import { Modal } from 'bootstrap'

const emit = defineEmits(['saved'])

const modalRef = ref(null)
let bsModal = null

const tag = ref({ name: '' })
const error = ref('')

onMounted(() => {
  bsModal = new Modal(modalRef.value)
})

const showModal = () => bsModal.show()
const hideModal = () => {
  bsModal.hide()
  error.value = ''
}

const setTag = (data) => {
  tag.value = data ? { ...data } : { name: '' }
  showModal()
}

const saveTag = async () => {
  try {
    if (!tag.value.name) {
      error.value = 'Tag name is required'
      return
    }

    if (tag.value.id) {
      await axios.put(`/api/tags/${tag.value.id}`, tag.value)
    } else {
      await axios.post('/api/tags', tag.value)
    }

    emit('saved')
    hideModal()
  } catch (err) {
    error.value = err.response?.data?.message || 'Something went wrong'
    console.error(err)
  }
}

// expose methods for parent
defineExpose({ showModal, hideModal, setTag })
</script>
