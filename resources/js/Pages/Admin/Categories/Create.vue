<template>
  <AdminLayout title="Add Category">
    <div class="p-8 max-w-xl mx-auto bg-white rounded-lg shadow">
      <h1 class="text-2xl font-bold mb-6 text-gray-800">Add New Category</h1>

      <!-- ✅ Flash Success Message -->
      <div
        v-if="$page.props.flash?.success"
        class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 border border-green-300"
      >
        {{ $page.props.flash.success }}
      </div>

      <!-- ✅ Form -->
      <form @submit.prevent="submit">
        <!-- Name -->
        <div class="mb-4">
          <label for="name" class="block font-medium mb-2">
            Name <span class="text-red-500">*</span>
          </label>
          <input
            id="name"
            v-model="form.name"
            type="text"
            class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
            :class="{ 'border-red-500': form.errors.name }"
            placeholder="Enter category name"
           
          />
          <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
            {{ form.errors.name }}
          </div>
        </div>

        <!-- Description -->
        <div class="mb-4">
          <label for="description" class="block font-medium mb-2">Description</label>
          <textarea
            id="description"
            v-model="form.description"
            class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
            :class="{ 'border-red-500': form.errors.description }"
            placeholder="Enter description"
          ></textarea>
          <div v-if="form.errors.description" class="text-red-500 text-sm mt-1">
            {{ form.errors.description }}
          </div>
        </div>

        <!-- Status -->
        <div class="mb-6 flex items-center">
          <input
            id="status"
            type="checkbox"
            v-model="form.status"
            class="mr-2 w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
          />
          <label for="status" class="font-medium">Active</label>
        </div>

        <!-- Buttons -->
        <div class="flex space-x-3">
          <button
            type="submit"
            :disabled="form.processing"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 disabled:opacity-50"
          >
            <span v-if="form.processing">Saving...</span>
            <span v-else>Save</span>
          </button>

          <Link
            :href="route('admin.categories.index')"
            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
          >
            Cancel
          </Link>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const form = useForm({
  name: '',
  description: '',
  status: true,
})

function submit() {
  form.post(route('admin.categories.store'))
}
</script>
