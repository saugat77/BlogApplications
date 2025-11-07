<template>
  <nav v-if="totalPages > 1">
    <ul class="pagination justify-content float-end">
      <li
        class="page-item"
        :class="{ disabled: currentPage === 1 }"
        @click="changePage(currentPage - 1)"
      >
        <a class="page-link" href="#">Previous</a>
      </li>

      <li
        v-for="page in pagesToShow"
        :key="page"
        class="page-item"
        :class="{ active: page === currentPage }"
        @click="changePage(page)"
      >
        <a class="page-link" href="#">{{ page }}</a>
      </li>

      <li
        class="page-item"
        :class="{ disabled: currentPage === totalPages }"
        @click="changePage(currentPage + 1)"
      >
        <a class="page-link" href="#">Next</a>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  currentPage: { type: Number, required: true },
  totalPages: { type: Number, required: true },
})

const emit = defineEmits(['page-changed'])

// Simple sliding window pagination (show max 5 pages)
const pagesToShow = computed(() => {
  const pages = []
  let start = Math.max(1, props.currentPage - 2)
  let end = Math.min(props.totalPages, start + 4)

  // Adjust start if there are fewer than 5 pages at the end
  start = Math.max(1, end - 4)

  for (let i = start; i <= end; i++) pages.push(i)
  return pages
})

const changePage = (page) => {
  if (page < 1 || page > props.totalPages || page === props.currentPage) return
  emit('page-changed', page)
}
</script>
