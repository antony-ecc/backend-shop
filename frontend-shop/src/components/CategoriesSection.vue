<script setup>
import { useCategoryStore } from '@/stores/category';
import { onMounted, ref } from 'vue';


const { getHeaderCategories } = useCategoryStore();
const categories = ref([]);

onMounted(async () => {
   categories.value = await getHeaderCategories();
})
</script>

<template>
  <!-- Product banner section -->
  <section id="product-banners">
    <div class="container mx-auto py-10">
      <div class="flex justify-between">
        <h2 class="text-2xl font-bold mb-8">Latest categories</h2>
        <router-link :to="{ name: 'categories' }" class="text-blue-400 underline">All Categories</router-link>
      </div>
      <div class="flex flex-wrap -mx-4">
        <!-- Category 1 -->
        <div v-for="category in categories" :key="category.id" class="w-full sm:w-1/3 px-4 mb-8">
          <div class="category-banner relative overflow-hidden rounded-lg shadow-lg group">
            <img :src="category.image" alt="Category 1" class="w-full h-auto">
            <div class="absolute inset-0 bg-gray-light bg-opacity-50"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white p-4">
              <h2 class="text-2xl md:text-3xl font-bold mb-4">{{ category.name }}</h2>
              <router-link :to="{ name: 'detail_category', params: { slug: category.slug } }" class="bg-primary hover:bg-transparent border border-transparent hover:border-white text-white
                hover:text-white font-semibold px-4 py-2 rounded-full inline-block">Shop
                now</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
.category-banner {
  height: 300px;
}
</style>