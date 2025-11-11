<template>
  <div class="min-h-screen flex items-center justify-center">
    <form @submit.prevent="submit" class="w-full max-w-md bg-white p-6 rounded shadow">
      <h1 class="text-2xl mb-4">Admin Login</h1>

      <div class="mb-3">
        <label class="block mb-1">Email</label>
        <input v-model="form.email" type="email" class="w-full p-2 border rounded" />
        <p v-if="form.errors.email" class="text-red-600 text-sm">{{ form.errors.email }}</p>
      </div>

      <div class="mb-3">
        <label class="block mb-1">Password</label>
        <input v-model="form.password" type="password" class="w-full p-2 border rounded" />
        <p v-if="form.errors.password" class="text-red-600 text-sm">{{ form.errors.password }}</p>
      </div>

      <button :disabled="form.processing" class="w-full py-2 bg-blue-600 text-white rounded">
        {{ form.processing ? 'Logging in...' : 'Login' }}
      </button>

      <p v-if="form.errors.general" class="text-red-600 mt-3">{{ form.errors.general }}</p>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  email: '',
  password: '',
})

// Post directly to the backend URL (no Ziggy)
const submit = () => {
  form.post('/admin/login')
}
</script>
