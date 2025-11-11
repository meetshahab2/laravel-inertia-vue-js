<template>
  <header class="bg-gray-900 text-white p-4 flex justify-between items-center border-b border-gray-700">
    <h1 class="text-xl font-bold">{{ title }}</h1>
    <div class="text-gray-300 text-sm">
      Logged in as
      <span class="font-semibold text-white">
        {{ $page.props.auth?.admin?.name || 'Admin' }}
      </span>
    </div>
  </header>
</template>

<script setup>
defineProps({
  title: {
    type: String,
    default: 'Admin Panel',
  },
})
</script>
