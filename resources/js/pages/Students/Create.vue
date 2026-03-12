<script setup lang="">
import { useForm, Link } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  age: '',
  image: null,
})

function submit() {
  form.post(route('student.store'))
}
</script>

<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 flex items-center justify-center py-10">
    <div class="w-full max-w-xl bg-white dark:bg-gray-800 shadow-xl rounded-xl p-8">

      <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
        Create Student
      </h1>

      <form @submit.prevent="submit" class="space-y-6">

        <!-- Name -->
        <div>
          <label class="block text-sm font-medium text-gray-700  dark:text-gray-300 mb-1">
            Name
          </label>
          <input
            v-model="form.name"
            type="text"
            class="w-full rounded-full border border-blue-500 p-2 focus:border-indigo-500 focus:ring-indigo-500"
          />

          <p v-if="form.errors.name" class="text-sm text-red-500 mt-1">
            {{ form.errors.name }}
          </p>
        </div>

        <!-- Age -->
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Age
          </label>
          <input
            v-model="form.age"
            type="number"
            class="w-full rounded-full  border border-blue-500  p-2 focus:border-indigo-500 focus:ring-indigo-500"
          />
          <p v-if="form.errors.age" class="text-sm text-red-500 mt-1">
            {{ form.errors.age }}
          </p>
        </div>

        <!-- Image -->
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Image
          </label>
          <input
            type="file"
            @change="e => form.image = e.target.files[0]"
            class="block w-full text-sm text-gray-500
                   file:mr-4 file:py-2 file:px-4
                   file:rounded-lg file:border-0
                   file:text-sm file:font-semibold
                   file:bg-indigo-50 file:text-indigo-700
                   hover:file:bg-indigo-100"
          />
          <p v-if="form.errors.image" class="text-sm text-red-500 mt-1">
            {{ form.errors.image }}
          </p>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-4">
          <Link
            :href="route('students')"
            class="px-4 py-2 text-gray-600 hover:text-gray-800"
          >
            Index page
          </Link>

          <button
            type="submit"
            :disabled="form.processing"
            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow transition disabled:opacity-50"
          >
            Create
          </button>
        </div>

      </form>
    </div>
  </div>
</template>