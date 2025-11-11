<template>
  <AdminLayout title="Dashboard">
    <div class="bg-white p-6 rounded shadow text-center">
      <h2 class="text-lg font-semibold mb-2">Welcome to Admin Dashboard 🎉</h2>
      <p class="text-gray-600 mb-6">
        You can manage your entire system from here.
      </p>

      <!-- 🖼️ Show Image from Storage -->
      <img
        src="/public/storage/uploads/welcome.jpg"
        alt="Welcome"
        class="mx-auto w-80 rounded-xl shadow-md"
      />
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Components/Admin/Layout.vue'
</script>
