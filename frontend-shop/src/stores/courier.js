import Api from "@/services/Api";
import { defineStore } from "pinia";

export const useCourierStore = defineStore('courierStore', {
    state: () => {
        return {
            provinces: [],
            cities: [],
            districts: [],
            couriers: [{ name: 'JNE', value: 'jne'}, { name: 'POS Indonesia', value: 'pos'}, { name: 'TIKI', value: 'tiki' }],
            ongkirOptions: [],
            errors: {}
        }
    },
    actions: {
        async getProvinces() {
            const res = await Api.get('/rajaongkir/provinces');
            return this.provinces = res.data.data;
        },
        async getCities(province) {
            const res = await Api.get(`/rajaongkir/cities/${province}`);
            return this.cities = res.data.data;
        },
        
        async getDistricts(city) {
            const res = await Api.get(`/rajaongkir/districts/${city}`);
            return this.districts = res.data.data;
        },
        async checkOngkir(district, weight, courier) {
            const res = await Api.post('/rajaongkir/checkOngkir', {
                district_id: district,
                weight: weight,
                courier: courier,
            });

            return this.ongkirOptions = res.data.data;
        },
    }

})