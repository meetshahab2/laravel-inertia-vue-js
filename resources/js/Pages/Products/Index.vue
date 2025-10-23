<template>
  <AppLayout title="Products">
    <div class="p-8">
      <h1 class="text-3xl font-bold mb-6">Product List</h1>
      <div v-if="products.length === 0" class="text-gray-500">
        No products found.
      </div>

      <table 
        v-else 
        class="table-auto w-full border-collapse border border-gray-300"
      >
        <thead>
          <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2">ID</th>
            <th class="border border-gray-300 px-4 py-2">Name</th>
            <th class="border border-gray-300 px-4 py-2">Price</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <td class="border border-gray-300 px-4 py-2">{{ product.id }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ product.name }}</td>
            <td class="border border-gray-300 px-4 py-2">₹{{ product.price }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
  products: {
    type: Array,
    default: () => [],
  },
});
</script>
