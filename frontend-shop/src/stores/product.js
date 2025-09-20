import Api from "@/services/Api";
import { defineStore } from "pinia";

export const useProductStore = defineStore("productStore", {
  state: () => {
    return {
      errors: {},
    };
  },

  actions: {
    async getAllProducts() {
      const res = await Api.get("/products");
      const data = res.data;

      return data.products;
    },

    async getDetailProduct(slug) {
        const res = await Api.get(`/product/${slug}`);
        const data = res.data;

        return data.product;
    }
  },
});