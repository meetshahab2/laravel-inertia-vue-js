<template>
  <aside class="w-64 bg-gray-800 text-white p-4">
    <h2 class="text-lg font-bold mb-4">Menu</h2>
    <ul>
      <li>
        <Link href="/products" class="block py-1 hover:text-gray-300">
          Products
        </Link>
      </li>
      <li>
        <Link href="/categories" class="block py-1 hover:text-gray-300">
          Categories
        </Link>
      </li>
    </ul>
  </aside>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>
