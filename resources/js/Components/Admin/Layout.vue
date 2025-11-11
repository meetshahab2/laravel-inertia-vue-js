<template>
  <div class="flex h-screen bg-gray-900 text-white">
    <!-- Sidebar -->
    <Sidebar />

    <!-- Main Content Area -->
    <div class="flex flex-col flex-1 bg-gray-100 text-gray-900">
      <!-- Header -->
      <Header :title="title" />

      <!-- Main Content -->
      <main class="flex-1 overflow-y-auto p-6">
        <slot />
      </main>

      <!-- Footer -->
      <Footer />
    </div>
  </div>
</template>

<script setup>
import Sidebar from '@/Components/Admin/Sidebar.vue'
import Header from '@/Components/Admin/Header.vue'
import Footer from '@/Components/Admin/Footer.vue'

defineProps({
  title: {
    type: String,
    default: 'Admin Panel',
  },
})
</script>
