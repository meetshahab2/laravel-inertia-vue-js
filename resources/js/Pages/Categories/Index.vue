<template>
  <AppLayout title="Categories">
    <div class="p-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Category List</h1>
        <Link
          href="/categories/create"
          class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
        >
          + Add Category
        </Link>
      </div>

      <!-- Sorting Controls -->
      <div class="mb-4 flex space-x-3">
        <label class="font-semibold">Sort By:</label>
        <select
          v-model="sortBy"
          class="border px-3 py-1 rounded"
          @change="sortCategories"
        >
          <option value="id">ID</option>
          <option value="name">Name</option>
        </select>

        <select
          v-model="sortDirection"
          class="border px-3 py-1 rounded"
          @change="sortCategories"
        >
          <option value="asc">Ascending</option>
          <option value="desc">Descending</option>
        </select>
      </div>

      <!-- Category Table -->
      <div v-if="sortedCategories.length === 0" class="text-gray-500">
        No categories found.
      </div>

      <table
        v-else
        class="table-auto w-full border-collapse border border-gray-300 text-left"
      >
        <thead>
          <tr class="bg-gray-100">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Description</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2 text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="category in sortedCategories"
            :key="category.id"
            class="hover:bg-gray-50"
          >
            <td class="border px-4 py-2">{{ category.id }}</td>
            <td class="border px-4 py-2">{{ category.name }}</td>
            <td class="border px-4 py-2">{{ category.description ?? '-' }}</td>
            <td class="border px-4 py-2">
              <span
                :class="category.status ? 'text-green-600' : 'text-red-500'"
              >
                {{ category.status ? 'Active' : 'Inactive' }}
              </span>
            </td>
            <td class="border px-4 py-2 text-center space-x-2">
              <Link
                :href="`/categories/${category.id}/edit`"
                class="text-blue-500 hover:underline"
              >
                Edit
              </Link>
              <Link
                as="button"
                method="delete"
                :href="`/categories/${category.id}`"
                class="text-red-500 hover:underline"
                preserve-scroll
                @confirm="confirmDelete"
              >
                Delete
              </Link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
  categories: {
    type: Array,
    default: () => [],
  },
})

const sortBy = ref('id')
const sortDirection = ref('asc')

const sortedCategories = computed(() => {
  return [...props.categories].sort((a, b) => {
    const key = sortBy.value
    let compare = 0

    if (a[key] < b[key]) compare = -1
    if (a[key] > b[key]) compare = 1

    return sortDirection.value === 'asc' ? compare : -compare
  })
})

function sortCategories() {
  // Sorting is reactive via computed, so no extra code needed
}

function confirmDelete(e) {
  if (!confirm('Are you sure you want to delete this category?')) {
    e.preventDefault()
  }
}
</script>
