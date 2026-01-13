<template>
  <AdminLayout title="Add Specialization">
    <div class="p-8 max-w-3xl mx-auto bg-white rounded-lg shadow">
      <h1 class="text-2xl font-bold mb-6 text-gray-800">
        Add New Specialization
      </h1>

      <!-- ✅ Flash Success Message -->
      <div
        v-if="$page.props.flash?.success"
        class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 border border-green-300"
      >
        {{ $page.props.flash.success }}
      </div>

      <!-- ✅ Specialization Form -->
      <form @submit.prevent="submit" class="grid grid-cols-1 gap-4">

        <!-- Specialization Name -->
        <div>
          <label class="font-medium">Specialization Name *</label>
          <input
            v-model="form.specialization_name"
            type="text"
            class="input"
          />
          <p v-if="form.errors.specialization_name" class="error">
            {{ form.errors.specialization_name }}
          </p>
        </div>

        <!-- Description -->
        <div>
          <label class="font-medium">Description *</label>
          <textarea
            v-model="form.specialization_description"
            class="input"
          ></textarea>
          <p v-if="form.errors.specialization_description" class="error">
            {{ form.errors.specialization_description }}
          </p>
        </div>

        <!-- Status -->
        <div class="flex items-center mt-2">
          <input
            type="checkbox"
            v-model="form.specialization_status"
            class="mr-2"
          >
          <label>Active</label>
        </div>

        <!-- Buttons -->
        <div class="flex gap-3 mt-4">
          <button
            type="submit"
            :disabled="form.processing"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
          >
            {{ form.processing ? 'Saving...' : 'Save Specialization' }}
          </button>

          <Link
            :href="route('admin.specializations.index')"
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
  specialization_name: '',
  specialization_description: '',
  specialization_status: true, // true = Active (1)
})

function submit() {
  form.post(route('admin.specializations.store'))
}
</script>

<style scoped>
.input {
  width: 100%;
  border: 1px solid #d1d5db;
  padding: 8px;
  border-radius: 6px;
}
.error {
  color: red;
  font-size: 13px;
}
</style>
