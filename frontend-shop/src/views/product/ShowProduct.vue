<script setup>
import { calculateDiscount, moneyFormat } from "@/helper/useFormatter";
import { useAuthStore } from "@/stores/auth";
import { useCartStore } from "@/stores/cart";
import { useProductStore } from "@/stores/product";
import { storeToRefs } from "pinia";
import { onMounted, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import Swal from "sweetalert2";

const { getDetailProduct } = useProductStore();
const product = ref([]);
const route = useRoute();
const quantity = ref(1);

const { addToCart } = useCartStore();
const { user } = storeToRefs(useAuthStore());
const router = useRouter();

const handleAddToCart = async (product, quantity) => {
  if (!user.value) {
    return router.push({ name: "login" });
  }
  const res = await addToCart(product, quantity);
  if (res) {
    Swal.fire({
      toast: true,
      position: "top-end",
      icon: "success",
      title: "Success add item to cart",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      customClass: {
        popup: "mt-24",
      },
    });
  }
};

function checkStock() {
  if(quantity.value > product.value.stock) {
    quantity.value = product.value.stock;
  } else if (quantity.value < 1) {
    quantity.value = 1;
  }
}

onMounted(async () => {
  const slug = route.params.slug;
  product.value = await getDetailProduct(slug);
});
</script>

<template>
  <!-- Product info -->
  <section id="product-info">
    <div class="container mx-auto">
      <div class="py-6">
        <div class="flex flex-col lg:flex-row gap-6">
          <!-- Image Section -->
          <div class="w-full lg:w-1/2">
            <!-- Big Image -->
            <div id="main-image-container">
              <img
                id="main-image"
                class="h-auto w-full max-w-full rounded-lg object-fit object-center"
                :src="product.image"
                alt="Main Product Image"
              />
            </div>
          </div>
          <!-- Product Details Section -->
          <div class="w-full lg:w-1/2 flex flex-col">
            <div class="pb-8 border-b border-gray-line">
              <h1 class="text-3xl font-bold mb-4">{{ product.title }}</h1>
              <div class="mb-4 pb-4 border-b border-gray-line">
                <p class="mb-2">
                  Availability: <strong> {{ product.stock }} In Stock</strong>
                </p>
              </div>
              <div class="text-2xl font-semibold mb-8">
                {{ moneyFormat(calculateDiscount(product)) }}
              </div>
              <div v-if="product.stock > 0" class="flex items-center mb-8">
                <span>Quantity</span>
                <input v-model="quantity" :max="product.stock" @input="checkStock" type="number" class="ml-2 border rounded-2xl py-1 px-3" />
              </div>
              <div class="mb-4 pb-4 border-b border-gray-line">
                <p v-if="product.discount != null || product.discount > 0" class="mb-2">
                  Discount: <strong> {{ product.discount }}%</strong>
                </p>
              </div>
              <button v-if="product.stock > 0"
                @click.prevent="handleAddToCart(product.id, quantity)"
                class="bg-primary border border-transparent hover:bg-transparent hover:border-primary text-white hover:text-primary font-semibold py-2 px-4 rounded-full">Add to Cart
              </button>
              <button v-else disabled
                class="border border-primary bg-transparent font-semibold py-2 px-4 rounded-full">
                Out of Stock
              </button>
            </div>
            <!-- Social sharing -->
            <div class="flex space-x-4 my-6">
              <a href="#" class="w-4 h-4 flex items-center justify-center">
                <img
                  src="../../assets/images/social_icons/facebook.svg"
                  alt="Facebook"
                  class="w-4 h-4 transition-transform transform hover:scale-110"
                />
              </a>
              <a href="#" class="w-4 h-4 flex items-center justify-center">
                <img
                  src="../../assets/images/social_icons/instagram.svg"
                  alt="Instagram"
                  class="w-4 h-4 transition-transform transform hover:scale-110"
                />
              </a>
              <a href="#" class="w-4 h-4 flex items-center justify-center">
                <img
                  src="../../assets/images/social_icons/pinterest.svg"
                  alt="Pinterest"
                  class="w-4 h-4 transition-transform transform hover:scale-110"
                />
              </a>
              <a href="#" class="w-4 h-4 flex items-center justify-center">
                <img
                  src="../../assets/images/social_icons/twitter.svg"
                  alt="Twitter"
                  class="w-4 h-4 transition-transform transform hover:scale-110"
                />
              </a>
              <a href="#" class="w-4 h-4 flex items-center justify-center">
                <img
                  src="../../assets/images/social_icons/viber.svg"
                  alt="Viber"
                  class="w-4 h-4 transition-transform transform hover:scale-110"
                />
              </a>
            </div>
            <!-- Additional Information -->
            <div>
              <h3 class="text-lg font-semibold mb-2">Product Description</h3>
              <p v-html="product.description"></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
