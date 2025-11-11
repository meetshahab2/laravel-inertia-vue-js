<template>
  <AdminLayout title="Add Product">
    <div class="p-8 max-w-2xl mx-auto bg-white rounded-lg shadow">
      <h1 class="text-2xl font-bold mb-6 text-gray-800">Add New Product</h1>

      <!-- ✅ Flash Success Message -->
      <div
        v-if="$page.props.flash?.success"
        class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 border border-green-300"
      >
        {{ $page.props.flash.success }}
      </div>

      <!-- ✅ Product Form -->
      <form @submit.prevent="submit" enctype="multipart/form-data">
        <!-- Product Name -->
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
            placeholder="Enter product name"
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
            placeholder="Enter product description"
          ></textarea>
          <div v-if="form.errors.description" class="text-red-500 text-sm mt-1">
            {{ form.errors.description }}
          </div>
        </div>

        <!-- Category -->
        <div class="mb-4">
          <label for="category_id" class="block font-medium mb-2">
            Category <span class="text-red-500">*</span>
          </label>
          <select
            id="category_id"
            v-model="form.category_id"
            class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
            :class="{ 'border-red-500': form.errors.category_id }"
          >
            <option value="">-- Select Category --</option>
            <option v-for="cat in categories" :key="cat.id" :value="cat.id">
              {{ cat.name }}
            </option>
          </select>
          <div v-if="form.errors.category_id" class="text-red-500 text-sm mt-1">
            {{ form.errors.category_id }}
          </div>
        </div>

        <!-- Price -->
        <div class="mb-4">
          <label for="price" class="block font-medium mb-2">
            Price (₹) <span class="text-red-500">*</span>
          </label>
          <input
            id="price"
            v-model="form.price"
            type="number"
            step="0.01"
            min="0"
            class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
            :class="{ 'border-red-500': form.errors.price }"
            placeholder="Enter price"
          />
          <div v-if="form.errors.price" class="text-red-500 text-sm mt-1">
            {{ form.errors.price }}
          </div>
        </div>

        <!-- Stock -->
        <div class="mb-4">
          <label for="stock" class="block font-medium mb-2">
            Stock <span class="text-red-500">*</span>
          </label>
          <input
            id="stock"
            v-model="form.stock"
            type="number"
            min="0"
            class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
            :class="{ 'border-red-500': form.errors.stock }"
            placeholder="Enter stock quantity"
          />
          <div v-if="form.errors.stock" class="text-red-500 text-sm mt-1">
            {{ form.errors.stock }}
          </div>
        </div>

        <!-- 🖼️ Product Images -->
        <div class="mb-6">
          <label class="block font-medium mb-2">
            Product Images <span class="text-gray-500 text-sm">(Multiple allowed)</span>
          </label>

          <!-- Dropzone -->
          <div
            class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-400 transition"
            @drop.prevent="handleDrop"
            @dragover.prevent
          >
            <input
              type="file"
              name="images[]"
              multiple
              class="hidden"
              ref="fileInput"
              @change="handleImageUpload"
            />
            <div @click="fileInput.click()">
              <svg
                class="mx-auto mb-2 w-10 h-10 text-gray-400"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M7 16V4m0 0l3 3m-3-3L4 7m13 4v8m0 0l3-3m-3 3l-3-3"
                />
              </svg>
              <p class="text-gray-600">
                Drag & Drop images or
                <span class="text-blue-600 underline">Browse</span>
              </p>
            </div>
          </div>

          <div v-if="form.errors.images" class="text-red-500 text-sm mt-1">
            {{ form.errors.images }}
          </div>

          <!-- ✅ Image Previews -->
          <div v-if="imagePreviews.length" class="flex flex-wrap gap-3 mt-4">
            <div
              v-for="(img, index) in imagePreviews"
              :key="index"
              class="relative group"
            >
              <img
                :src="img"
                class="w-24 h-24 object-cover rounded-lg border border-gray-300 shadow-sm"
              />
              <button
                type="button"
                @click="removeImage(index)"
                class="absolute top-1 right-1 bg-black/50 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition"
              >
                ✕
              </button>
            </div>
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
import { ref } from 'vue'
import { useForm, Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import AdminLayout from '@/Layouts/AdminLayout.vue'

// Props from controller (categories)
defineProps({
  categories: Array,
})

const fileInput = ref(null)
const imagePreviews = ref([])

// ✅ Reactive Inertia form
const form = useForm({
  name: '',
  description: '',
  category_id: '',
  price: '',
  stock: '',
  status: true,
  images: [],
})

// 🖼️ Handle image upload (manual browse)
function handleImageUpload(e) {
  const files = Array.from(e.target.files)
  form.images.push(...files)
  imagePreviews.value.push(...files.map(file => URL.createObjectURL(file)))
}

// 🖱️ Handle drag & drop upload
function handleDrop(e) {
  const files = Array.from(e.dataTransfer.files)
  form.images.push(...files)
  imagePreviews.value.push(...files.map(file => URL.createObjectURL(file)))
}

// ❌ Remove selected image
function removeImage(index) {
  form.images.splice(index, 1)
  imagePreviews.value.splice(index, 1)
}

function submit() {
  form.post(route('admin.products.store'), {
    forceFormData: true,
    onSuccess: () => {
      form.reset()
      imagePreviews.value = []
    },
  })
}
</script>
