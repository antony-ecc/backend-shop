import Api from "@/services/Api";
import { defineStore } from "pinia";

export const useSliderStore = defineStore("slideStore", {
  state: () => {
    return {
      errors: {},
    };
  },

  actions: {
    async getAllSliders() {
      const res = await Api.get("/sliders");
      const data = res.data;

      return data.sliders;
    },
  },
});
