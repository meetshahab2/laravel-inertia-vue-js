<template>
  <AppLayout title="Categories">
    <div class="p-8">
      <h1 class="text-3xl font-bold mb-6">Category List</h1>

      <div v-if="categories.length === 0" class="text-gray-500">
        No categories found.
      </div>

      <table v-else class="table-auto w-full border-collapse border border-gray-300">
        <thead>
          <tr class="bg-gray-100">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Name</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories" :key="category.id">
            <td class="border px-4 py-2">{{ category.id }}</td>
            <td class="border px-4 py-2">{{ category.name }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'

defineProps({
  categories: {
    type: Array,
    default: () => [],
  },
});
</script>
