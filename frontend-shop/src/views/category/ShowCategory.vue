<script setup>
import { calculateDiscount, moneyFormat } from '@/helper/useFormatter';
import { useCategoryStore } from '@/stores/category';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';


const { getProductInCategories } = useCategoryStore();
const products = ref([]);
const route =useRoute();

onMounted(async () => {
    const slug = route.params.slug;
    products.value = await getProductInCategories(slug);
})
</script>

<template>
  <section id="latest-products" class="py-10">
    <div v-if="products.length >= 1">
      <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-8">Products</h2>
        <div class="flex flex-wrap -mx-4 items-stretch">
          <div v-for="product in products" :key="product.id" class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
            <div class="bg-white p-5 rounded-lg shadow-lg">
              <img :src="product.image" alt="Product 1" class="w-full object-cover mb-4 rounded-lg">
              <router-link to=""
                class="text-2xl font-semibold mb-2">{{ product.title }}</router-link>
              <div class="flex items-center mb-4">
                <span class="text-lg font-bold text-primary">{{ moneyFormat(calculateDiscount(product)) }}</span>
                <span v-if="product.discount != null || product.discount > 0" class="text-sm line-through ml-2">{{ moneyFormat(product.price) }}</span>
              </div>
              <router-link to="" class=" bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white
              hover:text-primary font-semibold py-2 px-4 rounded-full w-full">View Detail
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="container mx-auto px-4">
      <h2 class="text-2xl font-bold mb-8">Tidak ada produk dikategori ini</h2>
    </div>
  </section>
</template>