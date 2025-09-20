<script setup>
import CustomerMenu from '@/components/CustomerMenu.vue';
import { useOrderStore } from '@/stores/order';
import { onMounted, ref } from 'vue';


const { getAllOrders } = useOrderStore();
const orders = ref([])

onMounted(async () => {
    orders.value = await getAllOrders();
})
</script>

<template>
  <main class="bg-gray-200">
    <div class="container flex py-8">
      <div>
        <CustomerMenu />
      </div>
      <div class="w-full bg-white rounded-lg shadow-lg flex flex-col p-6">
        <h2 class="text-xl font-bold flex items-center text-gray-800 pb-3 border-b">
          <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
          </svg>
          ORDER
        </h2>
        <div class="bg-white rounded-lg">
          <div class="overflow-x-auto">
            <table class="min-w-full">
              <thead>
                <tr class="bg-blue-600 text-white text-left text-sm font-semibold uppercase tracking-wider">
                  <th class="px-6 py-3">INVOICE</th>
                  <th class="px-6 py-3">FULL NAME</th>
                  <th class="px-6 py-3">STATUS</th>
                  <th class="px-6 py-3">GRAND TOTAL</th>
                  <th class="px-6 py-3">OPTIONS</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="order in orders" :key="order.id">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ order.invoice }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ order.name }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ order.status }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ order.grand_total }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <router-link :to="{ name: 'detail_order', params: { snap_token: order.snap_token } }"
                      class="px-3 py-1 bg-blue-600 text-white rounded-2xl hover:bg-blue-800">Detail</router-link>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>