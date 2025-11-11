<template>
  <AdminLayout title="Edit Product">
    <div class="p-8 max-w-2xl mx-auto bg-white rounded-lg shadow">
      <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Product</h1>

      <div
        v-if="$page.props.flash?.success"
        class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 border border-green-300"
      >
        {{ $page.props.flash.success }}
      </div>

      <form @submit.prevent="submit" enctype="multipart/form-data">
        <!-- Name -->
        <div class="mb-4">
          <label class="block font-medium mb-2">Name</label>
          <input
            v-model="form.name"
            type="text"
            class="w-full border px-3 py-2 rounded"
          />
          <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
            {{ form.errors.name }}
          </div>
        </div>

        <!-- Description -->
        <div class="mb-4">
          <label class="block font-medium mb-2">Description</label>
          <textarea
            v-model="form.description"
            class="w-full border px-3 py-2 rounded"
          ></textarea>
        </div>

        <!-- Category -->
        <div class="mb-4">
          <label class="block font-medium mb-2">Category</label>
          <select
            v-model="form.category_id"
            class="w-full border px-3 py-2 rounded"
          >
            <option value="">-- Select Category --</option>
            <option v-for="cat in categories" :key="cat.id" :value="cat.id">
              {{ cat.name }}
            </option>
          </select>
        </div>

        <!-- Price -->
        <div class="mb-4">
          <label class="block font-medium mb-2">Price (₹)</label>
          <input
            v-model="form.price"
            type="number"
            class="w-full border px-3 py-2 rounded"
          />
        </div>

        <!-- Stock -->
        <div class="mb-4">
          <label class="block font-medium mb-2">Stock</label>
          <input
            v-model="form.stock"
            type="number"
            class="w-full border px-3 py-2 rounded"
          />
        </div>

        <!-- Product Images -->
        <div class="mb-6">
          <label class="block font-medium mb-2">Product Images</label>

          <div
            class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-400 transition"
            @drop.prevent="handleDrop"
            @dragover.prevent
          >
            <input
              type="file"
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
                Drag & Drop or
                <span class="text-blue-600 underline">Browse</span>
              </p>
            </div>
          </div>

          <!-- Existing Images -->
          <div v-if="existingImages.length" class="flex flex-wrap gap-3 mt-4">
            <div
              v-for="(img, index) in existingImages"
              :key="'existing-' + index"
              class="relative group"
            >
              <img
                :src="img.url"
                alt="Product image"
                class="w-24 h-24 object-cover rounded-lg border border-gray-300 shadow-sm"
              />
              <button
                type="button"
                @click="removeExistingImage(index)"
                class="absolute top-1 right-1 bg-black/50 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition"
              >
                ✕
              </button>
            </div>
          </div>

          <!-- New Previews -->
          <div v-if="imagePreviews.length" class="flex flex-wrap gap-3 mt-4">
            <div
              v-for="(img, index) in imagePreviews"
              :key="'preview-' + index"
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
            class="mr-2 w-4 h-4"
          />
          <label for="status" class="font-medium">Active</label>
        </div>

        <div class="flex space-x-3">
          <button
            type="submit"
            :disabled="form.processing"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 disabled:opacity-50"
          >
            <span v-if="form.processing">Saving...</span>
            <span v-else>Update</span>
          </button>

          <Link
            :href="route('admin.products.index')"
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
import { useForm, Link, router } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
  product: Object,
  categories: Array,
})

const form = useForm({
  name: props.product.name || '',
  description: props.product.description || '',
  category_id: props.product.category_id || '',
  price: props.product.price || '',
  stock: props.product.stock || '',
  status: !!props.product.status,
  images: [],
  remove_images: [],
})

const existingImages = ref(
  props.product.images?.map((img) => ({
    id: img.id,
    url: img.url || `/storage/${img.path}`,
  })) || []
)

const fileInput = ref(null)
const imagePreviews = ref([])

function handleImageUpload(e) {
  const files = Array.from(e.target.files)
  form.images.push(...files)
  imagePreviews.value.push(...files.map((f) => URL.createObjectURL(f)))
}

function handleDrop(e) {
  const files = Array.from(e.dataTransfer.files)
  form.images.push(...files)
  imagePreviews.value.push(...files.map((f) => URL.createObjectURL(f)))
}

function removeImage(index) {
  form.images.splice(index, 1)
  imagePreviews.value.splice(index, 1)
}

function removeExistingImage(index) {
  const img = existingImages.value[index]
  if (img?.id) {
    form.remove_images.push(img.id)
  }
  existingImages.value.splice(index, 1)
}

/*function submit() {
  alert('hai');
  console.log("products", props.product);
  form.put(route('admin.products.update', props.product.id), {
    forceFormData: true,
    onSuccess: () => {
      imagePreviews.value = []
      router.visit(route('admin.products.index'))
    },
  })
}*/

function submit() {
  const formData = new FormData();

  formData.append('name', form.name ?? '');
  formData.append('description', form.description ?? '');
  formData.append('category_id', form.category_id ?? '');
  formData.append('price', form.price ?? '');
  formData.append('stock', form.stock ?? '');
  formData.append('status', form.status ? 1 : 0);

  if (form.images && form.images.length) {
    form.images.forEach((file, index) => {
      formData.append(`images[${index}]`, file);
    });
  }

  if (form.remove_images && form.remove_images.length) {
    form.remove_images.forEach((id, index) => {
      formData.append(`remove_images[${index}]`, id);
    });
  }

  router.post(route('admin.products.update', props.product.id), formData, {
    method: 'post',
    headers: {
      'X-HTTP-Method-Override': 'PUT',
    },
    onSuccess: () => {
      imagePreviews.value = [];
      router.visit(route('admin.products.index'));
    },
    onError: (errors) => {
      console.error('Validation errors:', errors);
    },
  });
}

</script>
