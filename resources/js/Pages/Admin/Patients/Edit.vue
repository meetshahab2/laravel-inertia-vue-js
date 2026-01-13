<template>
  <AdminLayout title="Edit Patient">
    <div class="p-8 max-w-3xl mx-auto bg-white rounded-lg shadow">
      <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Patient</h1>

      <!-- ✅ Patient Form -->
      <form @submit.prevent="submit" class="grid grid-cols-2 gap-4">

        <!-- First Name -->
        <div>
          <label class="font-medium">First Name *</label>
          <input v-model="form.patient_first_name" type="text" class="input" />
          <p v-if="form.errors.patient_first_name" class="error">
            {{ form.errors.patient_first_name }}
          </p>
        </div>

        <!-- Last Name -->
        <div>
          <label class="font-medium">Last Name *</label>
          <input v-model="form.patient_last_name" type="text" class="input" />
          <p v-if="form.errors.patient_last_name" class="error">
            {{ form.errors.patient_last_name }}
          </p>
        </div>

        <!-- Email -->
        <div>
          <label class="font-medium">Email *</label>
          <input v-model="form.patient_email" type="email" class="input" />
          <p v-if="form.errors.patient_email" class="error">
            {{ form.errors.patient_email }}
          </p>
        </div>

        <!-- Phone -->
        <div>
          <label class="font-medium">Phone *</label>
          <input v-model="form.patient_phone" type="text" class="input" />
          <p v-if="form.errors.patient_phone" class="error">
            {{ form.errors.patient_phone }}
          </p>
        </div>

        <!-- Gender -->
        <div>
          <label class="font-medium">Gender *</label>
          <select v-model="form.patient_gender" class="input">
            <option value="">Select</option>
            <option>Male</option>
            <option>Female</option>
            <option>Other</option>
          </select>
        </div>

        <!-- Blood Group -->
        <div>
          <label class="font-medium">Blood Group *</label>
          <select v-model="form.patient_blood_group" class="input">
            <option value="">Select</option>
            <option>A+</option><option>A-</option>
            <option>B+</option><option>B-</option>
            <option>AB+</option><option>AB-</option>
            <option>O+</option><option>O-</option>
          </select>
        </div>

        <!-- DOB -->
        <div>
          <label class="font-medium">Date of Birth *</label>
          <input v-model="form.patient_dob" type="date" class="input" />
        </div>

        <!-- Status -->
        <div class="flex items-center mt-6">
          <input type="checkbox" v-model="form.patient_status" class="mr-2" />
          <label>Active</label>
        </div>

        <!-- Address -->
        <div class="col-span-2">
          <label class="font-medium">Address *</label>
          <textarea v-model="form.patient_address" class="input"></textarea>
        </div>

        <!-- Buttons -->
        <div class="col-span-2 flex gap-3 mt-4">
          <button
            type="submit"
            :disabled="form.processing"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
          >
            {{ form.processing ? 'Updating...' : 'Update Patient' }}
          </button>

          <Link
            :href="route('admin.patients.index')"
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
  patient: Object,
})

const form = useForm({
  patient_first_name: props.patient.patient_first_name,
  patient_last_name: props.patient.patient_last_name,
  patient_email: props.patient.patient_email,
  patient_phone: props.patient.patient_phone,
  patient_gender: props.patient.patient_gender,
  patient_blood_group: props.patient.patient_blood_group,
  patient_dob: props.patient.patient_dob
    ? props.patient.patient_dob.substring(0, 10)
    : '',
  patient_address: props.patient.patient_address,
  patient_status: props.patient.patient_status === 1,
})

function submit() {
  form.put(route('admin.patients.update', props.patient.patient_id))
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
