<template>
  <div class="flex min-h-screen">
    <Sidebar />

    <div class="flex-1 flex flex-col">
      <Header :title="title" />

      <main class="flex-1 p-6 bg-gray-100">
        <slot />
      </main>

      <Footer />
    </div>
  </div>
</template>

<script setup>
import Header from '@/Components/Header.vue'
import Sidebar from '@/Components/Sidebar.vue'
import Footer from '@/Components/Footer.vue'

defineProps({
  title: {
    type: String,
    default: 'Dashboard'
  }
})
</script>
