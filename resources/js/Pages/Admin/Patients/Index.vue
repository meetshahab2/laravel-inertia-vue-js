<template>
  <AdminLayout title="Patients">
    <div class="p-8">
      <!-- Flash Messages -->
      <div
        v-if="show && flash.success"
        class="mb-4 bg-green-100 text-green-800 px-4 py-2 rounded flex justify-between"
      >
        <span>{{ flash.success }}</span>
        <button @click="show = false">✖</button>
      </div>

      <div
        v-if="show && flash.error"
        class="mb-4 bg-red-100 text-red-800 px-4 py-2 rounded flex justify-between"
      >
        <span>{{ flash.error }}</span>
        <button @click="show = false">✖</button>
      </div>

      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Patient List</h1>

        <Link
          :href="route('admin.patients.create')"
          class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
        >
          + Add Patient
        </Link>
      </div>

      <!-- Sorting -->
      <div class="mb-4 flex items-center space-x-3">
        <label class="font-semibold text-gray-700">Sort By:</label>

        <select v-model="sortBy" class="border px-3 py-1 rounded">
          <option value="patient_id">ID</option>
          <option value="patient_first_name">First Name</option>
        </select>

        <select v-model="sortDirection" class="border px-3 py-1 rounded">
          <option value="asc">Ascending</option>
          <option value="desc">Descending</option>
        </select>
      </div>

      <!-- Table -->
      <div v-if="sortedPatients.length === 0" class="text-gray-500">
        No patients found.
      </div>

      <table
        v-else
        class="table-auto w-full border-collapse border border-gray-300 bg-white rounded shadow-sm"
      >
        <thead>
          <tr class="bg-gray-100">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Code</th>
            <th class="border px-4 py-2">Name</th>
            <th class="border px-4 py-2">Phone</th>
            <th class="border px-4 py-2">Gender</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2 text-center">Actions</th>
          </tr>
        </thead>

        <tbody>
          <tr
            v-for="patient in sortedPatients"
            :key="patient.patient_id"
            class="hover:bg-gray-50 transition"
          >
            <td class="border px-4 py-2">{{ patient.patient_id }}</td>
            <td class="border px-4 py-2">{{ patient.patient_code }}</td>
            <td class="border px-4 py-2 font-medium">
              {{ patient.patient_first_name }} {{ patient.patient_last_name }}
            </td>
            <td class="border px-4 py-2">{{ patient.patient_phone }}</td>
            <td class="border px-4 py-2">{{ patient.patient_gender }}</td>
            <td class="border px-4 py-2">
              <span
                :class="patient.patient_status === 1 ? 'text-green-600' : 'text-red-500'"
              >
                {{ patient.patient_status === 1 ? 'Active' : 'Inactive' }}
              </span>
            </td>
            <td class="border px-4 py-2 text-center space-x-2">
              <Link
                :href="route('admin.patients.edit', patient.patient_id)"
                class="text-blue-600 hover:underline"
              >
                Edit
              </Link>

              <Link
                as="button"
                method="delete"
                :href="route('admin.patients.destroy', patient.patient_id)"
                class="text-red-600 hover:underline"
                preserve-scroll
                @click="confirmDelete"
              >
                Delete
              </Link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AdminLayout>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
  patients: {
    type: Array,
    default: () => [],
  },
})

const page = usePage()
const flash = computed(() => page.props.flash || {})
const show = ref(false)

watch(
  flash,
  () => {
    if (flash.value.success || flash.value.error) {
      show.value = true
      setTimeout(() => (show.value = false), 3000)
    }
  },
  { immediate: true }
)

const sortBy = ref('patient_id')
const sortDirection = ref('asc')

const sortedPatients = computed(() => {
  return [...props.patients].sort((a, b) => {
    const key = sortBy.value
    let result = 0

    if (a[key] < b[key]) result = -1
    if (a[key] > b[key]) result = 1

    return sortDirection.value === 'asc' ? result : -result
  })
})

function confirmDelete(e) {
  if (!confirm('Are you sure you want to delete this patient?')) {
    e.preventDefault()
  }
}
</script>
