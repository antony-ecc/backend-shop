import Api from "@/services/Api";
import { defineStore } from "pinia";

export const useCartStore = defineStore("cartStore", {
  state: () => {
    return {
      errors: {},
    };
  },
  actions: {
    async addToCart(product_id, quantity) {
      try {
        const res = await Api.post('/cart', {
          product_id: product_id,
          quantity: quantity,
        });

        const data = res.data;
        return data.success;
      } catch (error) {
        this.errors = error.response.data.errors;
        return false;
      }
    },
  },
});
