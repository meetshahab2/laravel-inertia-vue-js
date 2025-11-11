<template>
  <AdminLayout title="Products">
    <div class="p-8">
      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Product List</h1>

        <!-- Add Product Button -->
        <Link
          :href="route('admin.products.create')"
          class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
        >
          + Add Product
        </Link>
      </div>

      <!-- Sorting Controls -->
      <div class="mb-4 flex items-center space-x-3">
        <label class="font-semibold text-gray-700">Sort By:</label>

        <select
          v-model="sortBy"
          class="border px-3 py-1 rounded"
          @change="sortProducts"
        >
          <option value="id">ID</option>
          <option value="name">Name</option>
          <option value="price">Price</option>
        </select>

        <select
          v-model="sortDirection"
          class="border px-3 py-1 rounded"
          @change="sortProducts"
        >
          <option value="asc">Ascending</option>
          <option value="desc">Descending</option>
        </select>
      </div>

      <!-- Product Table -->
      <div v-if="sortedProducts.length === 0" class="text-gray-500">
        No products found.
      </div>

      <table
        v-else
        class="table-auto w-full border-collapse border border-gray-300 text-left bg-white rounded shadow-sm"
      >
        <thead>
          <tr class="bg-gray-100">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Images</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Price</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2 text-center">Actions</th>
          </tr>
        </thead>

        <tbody>
          <tr
            v-for="product in sortedProducts"
            :key="product.id"
            class="hover:bg-gray-50 transition"
          >
            <td class="border px-4 py-2">{{ product.id }}</td>

            <!-- Product Images -->
            <td class="border px-4 py-2">
              <div class="flex space-x-2">
                <template v-if="product.images && product.images.length">
                  <img
                    v-for="(image, index) in product.images"
                    :key="index"
                    :src="`/storage/${image.path}`"
                    class="w-12 h-12 object-cover rounded border"
                    alt="Product image"
                  />
                </template>
                <span v-else class="text-gray-400 italic">No image</span>
              </div>
            </td>

            <td class="border px-4 py-2 font-medium">{{ product.name }}</td>
            <td class="border px-4 py-2">₹{{ product.price }}</td>

            <td class="border px-4 py-2">
              <span :class="product.status ? 'text-green-600' : 'text-red-500'">
                {{ product.status ? 'Active' : 'Inactive' }}
              </span>
            </td>

            <td class="border px-4 py-2 text-center space-x-2">
              <Link
                :href="route('admin.products.edit', product.id)"
                class="text-blue-600 hover:underline"
              >
                Edit
              </Link>

              <Link
                as="button"
                method="delete"
                :href="route('admin.products.destroy', product.id)"
                class="text-red-600 hover:underline"
                preserve-scroll
                @click="confirmDelete"
              >
                Delete
              </Link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
  products: {
    type: Array,
    default: () => [],
  },
})

const sortBy = ref('id')
const sortDirection = ref('asc')

// Reactive sorting
const sortedProducts = computed(() => {
  return [...props.products].sort((a, b) => {
    const key = sortBy.value
    let compare = 0

    if (a[key] < b[key]) compare = -1
    if (a[key] > b[key]) compare = 1

    return sortDirection.value === 'asc' ? compare : -compare
  })
})

function sortProducts() {
  // sorting happens reactively
}

function confirmDelete(e) {
  if (!confirm('Are you sure you want to delete this product?')) {
    e.preventDefault()
  }
}
</script>
