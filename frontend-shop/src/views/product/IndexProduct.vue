<script setup>
import { calculateDiscount, moneyFormat } from '@/helper/useFormatter';
import { useProductStore } from '@/stores/product';
import { onMounted, ref } from 'vue';


const { getAllProducts } = useProductStore();
const products = ref([]);

onMounted(async () => {
    products.value = await getAllProducts();
})
</script>

<template>
  <section id="latest-products" class="py-10">
    <div class="container mx-auto px-4">
      <div class="flex justify-between">
        <h2 class="text-2xl font-bold mb-8">Latest products</h2>
        <router-link to="" class="text-blue-400 underline">All Products</router-link>
      </div>
      <div class="flex flex-wrap -mx-4 items-stretch">
        <!-- Product 1 -->
        <div v-for="product in products" :key="product.id" class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
          <div class="bg-white p-5 rounded-lg shadow-lg">
            <img :src="product.image" alt="Product 1" class="w-full object-cover mb-4 rounded-lg">
            <router-link :to="{ name: 'detail_product', params: { slug: product.slug } }"
              class="text-lg font-semibold mb-2">{{ product.title }}</router-link>
            <p class="text-xs my-2 text-gray-500 uppercase">{{ product.category.name }}</p>
            <div class="flex items-center mb-4">
              <span class="text-lg font-bold text-primary">{{ moneyFormat(calculateDiscount(product)) }}</span>
              <span v-if="product.discount !=null || product.discount > 0"
                class="text-sm text-gray-400 line-through ml-2">{{ moneyFormat(product.price) }}</span>
            </div>
            <router-link :to="{ name: 'detail_product', params: { slug: product.slug } }" class=" bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white
              hover:text-primary font-semibold py-2 px-4 rounded-full w-full">View Detail
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>