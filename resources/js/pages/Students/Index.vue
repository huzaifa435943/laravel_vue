<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'

defineProps({
  students: Array
})

const page = usePage()
</script>

<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-10">
    <div class="max-w-7xl mx-auto px-6">

      <!-- Header -->
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">
          Students
        </h1>

        <Link
          :href="route('student.create')"
          class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow transition"
        >
          + Create Student
        </Link>
      </div>

      <!-- Flash Message -->
      <div
        v-if="page.props.flash?.success"
        class="mb-6 p-4 rounded-lg bg-green-100 text-green-700 border border-green-200"
      >
        {{ page.props.flash.success }}
      </div>

      <!-- Students Grid -->
      <div
        v-if="students.length"
        class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"
      >
        <div
          v-for="student in students"
          :key="student.id"
          class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg transition overflow-hidden"
        >
          <img
            v-if="student.image"
            :src="`/${student.image}`"
            class="w-full h-48 object-cover"
          />

          <div class="p-5">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
              {{ student.name }}
            </h2>

            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
              Age: {{ student.age }}
            </p>

            <div class="flex justify-between items-center mt-4">
              <Link
                :href="route('student.edit', student.id)"
                class="text-sm font-medium text-yellow-600 hover:text-yellow-700"
              >
                Edit
              </Link>

              <Link
                as="button"
                method="delete"
                :href="route('student.destroy', student.id)"
                class="text-sm font-medium text-red-600 hover:text-red-700"
              >
                Delete
              </Link>
            </div>
          </div>
        </div>
      </div>

      <div v-else class="text-gray-500 text-center py-20">
        No students found.
      </div>

    </div>
  </div>
</template>