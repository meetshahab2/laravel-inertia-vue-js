<template>
  <footer class="bg-gray-900 border-t border-gray-700 p-4 text-center text-sm text-gray-400">
    Admin Dashboard © {{ currentYear }} | Built with ❤️ using
    <span class="text-white font-semibold">Laravel</span> +
    <span class="text-white font-semibold">Inertia</span> +
    <span class="text-white font-semibold">Vue</span>
  </footer>
</template>

<script setup>
const currentYear = new Date().getFullYear()
</script>
