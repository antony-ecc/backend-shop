<script setup>
import CustomerMenu from '@/components/CustomerMenu.vue';
import { moneyFormat } from '@/helper/useFormatter';
import { useOrderStore } from '@/stores/order';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';

const { getDetailOrder } = useOrderStore();
const detailOrder = ref([]);

const route = useRoute()

onMounted(async () => {
    const snap_token = route.params.snap_token;
    detailOrder.value = await getDetailOrder(snap_token);
})
</script>

<template>
  <div class="container mx-auto mb-5 mt-4 px-4 md:px-0">
    <div class="flex flex-wrap -mx-3">
      <div class="w-full md:w-1/4 px-3 mb-4">
        <CustomerMenu />
      </div>
      <div class="w-full md:w-3/4 px-3 mb-4">
        <div class="bg-white rounded-lg shadow">
          <div class="p-6">
            <h5 class="font-bold"> <i class="fas fa-shopping-cart"></i>ORDER</h5>
            <hr class="my-4 border-gray-200">
            <table class="w-full table-auto">
              <tbody>
                <tr>
                  <td class="w-1/4 py-2">
                    NO. INVOICE
                  </td>
                  <td class="w-1 py-2">:</td>
                  <td class="py-2">
                    {{ detailOrder.invoice }}
                  </td>
                </tr>
                <tr>
                  <td class="w-1/4 py-2">
                    NAMA LENGKAP
                  </td>
                  <td class="w-1 py-2">:</td>
                  <td class="py-2">
                    {{ detailOrder.name }}
                  </td>
                </tr>
                <tr>
                  <td class="w-1/4 py-2">
                    NO. TELP / WA
                  </td>
                  <td class="w-1 py-2">:</td>
                  <td class="py-2">
                    {{ detailOrder.phone }}
                  </td>
                </tr>
                <tr>
                  <td class="w-1/4 py-2">
                    KURIR / SERVICE / COST
                  </td>
                  <td class="w-1 py-2">:</td>
                  <td class="py-2">
                    {{ detailOrder.courier }} / {{ detailOrder.service }} / {{ detailOrder.cost_courier }}
                  </td>
                </tr>
                <tr>
                  <td class="w-1/4 py-2">
                    ALAMAT LENGKAP
                  </td>
                  <td class="w-1 py-2">:</td>
                  <td class="py-2">
                    {{ detailOrder.address }}
                  </td>
                </tr>
                <tr>
                  <td class="w-1/4 py-2">
                    TOTAL PEMBELIAN
                  </td>
                  <td class="w-1 py-2">:</td>
                  <td class="py-2">
                    {{ moneyFormat(detailOrder.grand_total) }}
                  </td>
                </tr>
                <tr>
                  <td class="w-1/4 py-2">
                    STATUS
                  </td>
                  <td class="w-1 py-2">:</td>
                  <td class="py-2">
                    <button class="bg-gray-500 hover:bg-gray-600 font-semibold py-2 px-4 rounded-full">BAYAR
                      SEKARANG</button>
                    <button class="bg-green-500 hover:bg-green-600 text-gray-400 font-semibold py-2 px-4 rounded-full">
                      {{ detailOrder.status }}</button>
                    <button
                      class="bg-yellow-500 hover:bg-yellow-600 text-gray-400 font-semibold py-2 px-4 rounded-full">
                      {{ detailOrder.status }}</button>
                    <button class="bg-red-500 hover:bg-red-600 text-gray-400 font-semibold py-2 px-4 rounded-full">
                      {{ detailOrder.status }}</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="bg-white rounded-lg shadow mt-4">
          <div class="p-6">
            <h5><i class="fa fa-shopping-cart"></i> DETAIL ORDER</h5>
            <hr class="my-4 border-gray-200">
            <table class="w-full">
              <tbody>
                <tr v-for="product in detailOrder.orders" :key="product.id"
                  class="bg-gray-100 border-b border-gray-200">
                  <td class="p-4" width="25%">
                    <div class="w-24 h-24">
                      <img :src="product.image" class="w-full h-full object-cover rounded-lg">
                    </div>
                  </td>
                  <td class="p-4" width="50%">
                    <h5 class="font-bold mb-2">{{ product.product_name }}</h5>
                    <table class="table-auto" style="font-size: 14px">
                      <tbody>
                        <tr>
                          <td class="p-0">QTY</td>
                          <td class="p-0">:</td>
                          <td class="p-0 font-bold">{{ product.qty }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td class="p-4 text-right">
                    <p class="m-0 font-bold">{{ product.price }}</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>