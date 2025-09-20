<script setup>
import { useCategoryStore } from '@/stores/category';
import { onMounted, ref } from 'vue';


const { getAllCategories } = useCategoryStore();
const categories = ref([])

onMounted(async () => {
    categories.value = await getAllCategories();
})
</script>

<template>
  <section id="latest-products" class="py-10">
    <div class="container mx-auto px-4">
      <h2 class="text-2xl font-bold mb-8">All Categories</h2>
      <div class="flex flex-wrap -mx-4 items-stretch">
        <div v-for="category in categories" :key="category.id" class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
          <div class="bg-white p-3 rounded-lg shadow-lg">
            <img :src="category.image" alt="category 1" class="w-full object-cover mb-4 rounded-lg">
            <router-link to=""
              class="text-lg font-semibold mb-2">{{ category.name }}</router-link>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>