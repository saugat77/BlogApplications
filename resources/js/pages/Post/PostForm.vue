<template>
    <div class="modal fade" tabindex="-1" ref="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ post.id ? 'Edit Post' : 'New Post' }}</h5>
                    <button type="button" class="btn-close" @click="hideModal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Categories</label>
                        <select v-model="post.category_ids" class="form-select" multiple>
                            <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                                {{ cat.name }}
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input v-model="post.title" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Thumbanail</label>
                        <textarea v-model="post.thumbnail" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Body</label>
                        <textarea v-model="post.body" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" @click="hideModal">Cancel</button>
                    <button class="btn btn-primary" @click="savePost">{{ post.id ? 'Update' : 'Create' }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Modal } from 'bootstrap'
import axios from '../../axios'
import { defineExpose } from 'vue'

const modal = ref(null)
const categories = ref([])
let bsModal = null

const post = ref({ title: '', body: '', thumbnail: '', category_ids: [] })

onMounted(() => {
    bsModal = new Modal(modal.value, { backdrop: 'static', keyboard: false })
    fetchCategories();
})

const showModal = () => bsModal?.show()
const hideModal = () => bsModal?.hide()

const setPost = (p) => {
    post.value = { ...p }
}

const fetchCategories = async () => {
    try {
        const res = await axios.get('/api/category/all')
        categories.value = res.data
    } catch (err) {
        console.error(err)
    }
}

// save post
const savePost = async () => {
    try {
        if (post.value.id) await axios.put(`/api/posts/${post.value.id}`, post.value)
        else await axios.post('/api/posts', post.value)
        hideModal()
        emit('saved')
        post.value = { title: '', body: '' } // reset
    } catch (err) {
        console.error(err)
    }
}

defineExpose({ showModal, hideModal, setPost })
const emit = defineEmits(['saved'])
</script>
