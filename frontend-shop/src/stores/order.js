import Api from "@/services/Api";
import { defineStore } from "pinia";

export const useOrderStore = defineStore('orderStore', {
    state: () => {
        return {
            errors: {}
        }
    },
actions: {
    async getAllOrders() {
        const res = await Api.get('/order');
        const data = res.data;

        return data.data;
    },

    async getDetailOrder(snap_token) {
    const res = await Api.get(`/order/${snap_token}`);
    const data = res.data;

    return data.data;
    }
},


})