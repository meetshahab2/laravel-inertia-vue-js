<template>
  <aside class="w-64 bg-gray-900 text-white flex flex-col min-h-screen">
    <!-- Logo -->
    <div class="p-4 text-2xl font-bold text-white border-b border-gray-700">
      Admin Panel
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-2">
      <Link
        :href="route('admin.dashboard')"
        class="block px-3 py-2 rounded transition"
        :class="isActive('admin.dashboard')
          ? 'bg-gray-800 text-white font-semibold'
          : 'text-gray-300 hover:bg-gray-800 hover:text-white'"
      >
        🏠 Dashboard
      </Link>

      <Link
        :href="route('admin.categories.index')"
        class="block px-3 py-2 rounded transition"
        :class="isActive('admin.categories.*')
          ? 'bg-gray-800 text-white font-semibold'
          : 'text-gray-300 hover:bg-gray-800 hover:text-white'"
      >
        🏷️ Categories
      </Link>

      <Link
        :href="route('admin.products.index')"
        class="block px-3 py-2 rounded transition"
        :class="isActive('admin.products.*')
          ? 'bg-gray-800 text-white font-semibold'
          : 'text-gray-300 hover:bg-gray-800 hover:text-white'"
      >
        📦 Products
      </Link>
      <Link
        :href="route('admin.patients.index')"
        class="block px-3 py-2 rounded transition"
        :class="isActive('admin.patients.*')
          ? 'bg-gray-800 text-white font-semibold'
          : 'text-gray-300 hover:bg-gray-800 hover:text-white'"
      >
        🧑‍⚕️ Patients
      </Link>
      <Link
        :href="route('admin.departments.index')"
        class="block px-3 py-2 rounded transition"
        :class="isActive('admin.departments.*')
          ? 'bg-gray-800 text-white font-semibold'
          : 'text-gray-300 hover:bg-gray-800 hover:text-white'"
      >
        🏥 Departments
      </Link>
      <Link
        :href="route('admin.specializations.index')"
        class="block px-3 py-2 rounded transition"
        :class="isActive('admin.specializations.*')
          ? 'bg-gray-800 text-white font-semibold'
          : 'text-gray-300 hover:bg-gray-800 hover:text-white'"
      >
        🧬 Specializations
      </Link>


    </nav>

    <!-- Logout -->
    <footer class="p-4 border-t border-gray-700 bg-gray-950">
      <form @submit.prevent="logout">
        <button
          type="submit"
          class="w-full bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700 transition"
        >
          Logout
        </button>
      </form>

      <p class="text-center text-xs text-gray-400 mt-2">
        &copy; {{ currentYear }} Admin Panel
      </p>
    </footer>
  </aside>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

const form = useForm({})
const logout = () => form.post(route('admin.logout'))

const currentYear = new Date().getFullYear()

const isActive = (pattern) => route().current(pattern)
</script>
