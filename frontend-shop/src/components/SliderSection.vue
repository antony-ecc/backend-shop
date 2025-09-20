<script setup>
import { useSliderStore } from '@/stores/slider';
import { onMounted, ref } from 'vue';

import Swiper from 'swiper';
import { Autoplay, Navigation } from 'swiper/modules';
// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

const { getAllSliders } = useSliderStore();
const sliders = ref([]);

const initSwiper = () => {
    new Swiper('.swiper', {
        modules: [Navigation, Autoplay],
        loop: true,
        slidesPerView: 1,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        }
    })
}

onMounted( async () => {
    sliders.value = await getAllSliders();
    initSwiper();
});
</script>

<template>
  <section id="product-slider">
    <div class="main-slider swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide" v-for="slider in sliders" :key="slider.id">
          <img :src="slider.image" alt="Product 1" style="height: 800px;">
          <div class="swiper-slide-content">
            <h2 class="text-3xl md:text-7xl font-bold text-white mb-2 md:mb-4">{{ slider.title }}</h2>
            <p class="mb-4 text-white md:text-2xl">{{ slider.description }}</p>
            <a href="slider.link"
              class="bg-primary hover:bg-transparent text-white hover:text-white border border-transparent hover:border-white font-semibold px-4 py-2 rounded-full inline-block">Shop
              now</a>
          </div>
        </div>
      </div>
    </div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </section>
</template>