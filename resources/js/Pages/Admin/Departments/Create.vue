<template>
  <AdminLayout title="Add Department">
    <div class="p-8 max-w-3xl mx-auto bg-white rounded-lg shadow">
      <h1 class="text-2xl font-bold mb-6 text-gray-800">Add New Department</h1>

      <!-- ✅ Flash Success Message -->
      <div
        v-if="$page.props.flash?.success"
        class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 border border-green-300"
      >
        {{ $page.props.flash.success }}
      </div>

      <!-- ✅ Department Form -->
      <form @submit.prevent="submit" class="grid grid-cols-1 gap-4">

        <!-- Department Name -->
        <div>
          <label class="font-medium">Department Name *</label>
          <input
            v-model="form.department_name"
            type="text"
            class="input"
          />
          <p v-if="form.errors.department_name" class="error">
            {{ form.errors.department_name }}
          </p>
        </div>

        <!-- Department Description -->
        <div>
          <label class="font-medium">Description *</label>
          <textarea
            v-model="form.department_description"
            class="input"
          ></textarea>
          <p v-if="form.errors.department_description" class="error">
            {{ form.errors.department_description }}
          </p>
        </div>

        <!-- Status -->
        <div class="flex items-center mt-2">
          <input
            type="checkbox"
            v-model="form.department_status"
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
            {{ form.processing ? 'Saving...' : 'Save Department' }}
          </button>

          <Link
            :href="route('admin.departments.index')"
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
  department_name: '',
  department_description: '',
  department_status: true, // true = Active
})

function submit() {
  form.post(route('admin.departments.store'))
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
