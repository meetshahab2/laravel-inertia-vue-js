<template>
  <div class="flex h-screen bg-gray-100 text-gray-800">
    <!-- ✅ Sidebar -->
    <Sidebar />

    <!-- ✅ Main content area -->
    <div class="flex flex-col flex-1">
      <!-- ✅ Header -->
      <Header :title="title" />

      <!-- ✅ Page content -->
      <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
        <slot />
      </main>

      <!-- ✅ Footer -->
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
