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

    async getCart() {
      try {
        const res = await Api.get('/cart');

        const data = res.data;
        return data.cart;
      } catch (error) {
        this.errors = error.response.data.errors
      }
    },

    async getTotalCart() {
      try {
        const res = await Api.get('/cart/total');

        const data = res.data;
        return parseFloat(data.total);
      } catch (err) {
        this.errors = err.response.data.errors;
      }
    },

    async getTotalWeight() {
      try {
        const res = await Api.get('/cart/totalWeight');

        const data = res.data;
        return data.total;
      } catch (error) {
        this.errors = error.response.data.errors;
      }
    },

    async removeCartItem(cart) {
      try {
        const res = await Api.post(`/cart/remove/${cart}`);

        const data = res.data;
        return data.success;
      } catch (err) {
        this.errors = err.response.data.errors;
        return false;
      }
    },

    async checkout(formData) {
      try {
        const res = await Api.post('/checkout', formData);

        const data = res.data;
        return data.snap_token;
      } catch (error) {
        if(error.response.data.errors) {
          this.errors = error.response.data.errors;
        } else {
          this.errors = { general: ['Gagal Melakukan Checkout'] };
        }
        
        return false;
      }
    },
    
  },
});
