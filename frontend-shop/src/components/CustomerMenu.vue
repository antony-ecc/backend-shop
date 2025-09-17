<script setup>
</script>

<template>
  <aside class="w-64 bg-white rounded-lg shadow-lg mr-8 flex flex-col p-6">
    <div class="mb-4 pb-3 border-b">
      <h2 class="text-xl font-bold text-gray-800">MAIN MENU</h2>
    </div>
    <nav class="flex-grow">
      <ul class="space-y-4">
        <li>
          <router-link to="/customer/dashboard" active-class="bg-gray-100 text-gray-900"
            class="flex items-center p-3 rounded-lg text-gray-600 hover:bg-gray-100 transition duration-200">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
              </path>
            </svg>
            <span>DASHBOARD</span>
          </router-link>
        </li>
        <li>
          <router-link to="/customer/order" active-class="bg-gray-100 text-gray-900"
            class="flex items-center p-3 rounded-lg text-gray-600 hover:bg-gray-100 transition duration-200">
            <svg class="w-6 h-6 mr-3 text-gray-800 dark:text-white" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
            </svg>
            <span>MY ORDER</span>
          </router-link>
        </li>
        <li>
          <form>
            <button
              class="flex items-center p-3 w-full rounded-lg text-gray-600 hover:bg-gray-100 transition duration-200">
              <svg class="w-5 h-5 mr-3 transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
              </svg>
              <span>LOGOUT</span>
            </button>
          </form>
        </li>
      </ul>
    </nav>
  </aside>
</template>