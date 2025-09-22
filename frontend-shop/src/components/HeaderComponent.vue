<script setup>
import { useAuthStore } from '@/stores/auth';
import { onMounted } from 'vue';


const authStore = useAuthStore();

onMounted(async () => {
    await authStore.getUser()
})
</script>

<template>
  <!-- Header -->
  <header class="bg-gray-dark sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center py-4">
      <!-- Left section: Logo -->
      <router-link :to="{ name: 'home' }" class="flex items-center">
        <div>
          <img src="../assets/images/logo.png" alt="Logo" class="h-14 w-auto mr-4">
        </div>
      </router-link>

      <!-- Hamburger menu (for mobile) -->
      <div class="flex lg:hidden">
        <button id="hamburger" class="text-white focus:outline-none">
          <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
          </svg>
        </button>
      </div>

      <!-- Center section: Menu -->
      <nav class="hidden lg:flex md:flex-grow justify-center">
        <div class="flex justify-center space-x-4 text-white">
        </div>
      </nav>

      <!-- Right section: Buttons (for desktop) -->
      <div class="hidden lg:flex items-center space-x-4 relative">
        <div class="relative group cart-wrapper">
          <router-link :to="{ name: 'cart' }">
            <img src="../assets/images/cart-shopping.svg" alt="Cart" class="h-6 w-6 group-hover:scale-120">
          </router-link>
        </div>
        <div v-if="authStore.user">
          <router-link :to="{ name: 'dashboard' }"
            class="border hover:bg-transparent text-white hover:text-primary font-semibold px-4 py-2 rounded-full inline-block">Account
          </router-link>
        </div>
        <div v-else class="space-x-2">
          <router-link :to="{ name: 'register' }"
            class="bg-primary border border-primary hover:bg-transparent text-white hover:text-primary font-semibold px-4 py-2 rounded-full inline-block">
            Register
          </router-link>
          <router-link :to="{ name: 'login' }"
            class="bg-primary border border-primary hover:bg-transparent text-white hover:text-primary font-semibold px-4 py-2 rounded-full inline-block">
            Login
          </router-link>
        </div>
      </div>
    </div>
  </header>
</template>>