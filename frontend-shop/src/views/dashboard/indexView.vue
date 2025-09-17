<script setup>
import CustomerMenu from '@/components/CustomerMenu.vue';
import { useAuthStore } from '@/stores/auth';
import { storeToRefs } from 'pinia';

const { user } = storeToRefs(useAuthStore())
</script>

<template>
  <main class="bg-gray-200">
    <div class="container flex py-8">
      <div>
        <CustomerMenu />
      </div>
      <div class="w-full bg-white rounded-lg shadow-lg flex flex-col p-6">
        <h2 class="text-xl font-bold flex items-center text-gray-800 pb-3 border-b">
          <!-- Icon Home dari flowbite -->
          <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
            </path>
          </svg>
          DASHBOARD
        </h2>
        <p v-if="user" class="text-2xl mt-5">Selamat Datang <strong>{{ user.name }}</strong></p>
        <p v-else class="text-2xl mt-5">Memuat data...</p>
      </div>
    </div>
  </main>
</template>