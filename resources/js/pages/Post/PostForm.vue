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
                     <multiselect
                        v-model="post.category_ids"
                        :options="categories"
                        :multiple="false"
                        :track-by="'id'"
                        :label="'name'"
                        placeholder="Select items"
                        />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input v-model="post.title" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Thumbnail</label>
                        <textarea v-model="post.thumbnail" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Body</label>
                        <textarea v-model="post.body" class="form-control"></textarea>
                    </div>
                         <div class="mb-3">
                        <label class="form-label">Tags</label>
                     <multiselect
                        v-model="post.tag_ids"
                        :options="tags"
                        :multiple="true"
                        :track-by="'id'"
                        :label="'name'"
                        placeholder="Select items"
                        />
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

const modal = ref(null)
const categories = ref([])
const tags = ref([])
let bsModal = null

const post = ref({ title: '', body: '', thumbnail: '', category_ids: [], tag_ids:[] })

onMounted(() => {
    bsModal = new Modal(modal.value, { backdrop: 'static', keyboard: false })
    console.log('Modal mounted', modal.value)
    fetchCategories();
    fetchTags();
})

const showModal = () => bsModal?.show()
const hideModal = () => bsModal?.hide()

const setPost = (p) => {
   post.value = {
        id: p.id || null,
        title: p.title || '',
        body: p.body || '',
        thumbnail: p.thumbnail || '',
        category_ids: p.category ? [p.category] : [], // wrap single category as array for multiselect
        tag_ids: p.tags
        }
}

const fetchCategories = async () => {
    try {
        const res = await axios.get('/api/category/all')
        categories.value = res.data
    } catch (err) {
        console.error(err)
    }
}
const fetchTags = async () => {
    try {
        const res = await axios.get('/api/tag/all')
        tags.value = res.data
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
        post.value = ref({ title: '', body: '', thumbnail: '', category_ids: [], tag_ids: [] }) // reset
    } catch (err) {
        console.error(err)
    }
}

defineExpose({ showModal, hideModal, setPost })
const emit = defineEmits(['saved'])
</script>
