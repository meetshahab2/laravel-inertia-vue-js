<template>
  <header class="bg-gray-800 text-white p-4">
    <h1 class="text-xl font-bold">{{ title }}</h1>
  </header>
</template>

<script setup>
defineProps({
  title: {
    type: String,
    default: 'Dashboard'
  }
})
</script>
