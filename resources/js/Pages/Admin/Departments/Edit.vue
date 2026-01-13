<template>
  <AdminLayout title="Edit Department">
    <div class="p-8 max-w-2xl mx-auto bg-white rounded-lg shadow">
      <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Department</h1>

      <!-- ✅ Department Form -->
      <form @submit.prevent="submit" class="space-y-4">

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

        <!-- Description -->
        <div>
          <label class="font-medium">Description *</label>
          <textarea
            v-model="form.department_description"
            class="input"
            rows="4"
          ></textarea>
          <p v-if="form.errors.department_description" class="error">
            {{ form.errors.department_description }}
          </p>
        </div>

        <!-- Status -->
        <div class="flex items-center gap-2">
          <input
            type="checkbox"
            v-model="form.department_status"
          />
          <label>Active</label>
        </div>

        <!-- Buttons -->
        <div class="flex gap-3 pt-4">
          <button
            type="submit"
            :disabled="form.processing"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
          >
            {{ form.processing ? 'Updating...' : 'Update Department' }}
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

const props = defineProps({
  department: {
    type: Object,
    required: true,
  },
})

const form = useForm({
  department_name: props.department.department_name ?? '',
  department_description: props.department.department_description ?? '',
  department_status: props.department.department_status === 1,
})

function submit() {
  form.put(
    route('admin.departments.update', props.department.department_id)
  )
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
