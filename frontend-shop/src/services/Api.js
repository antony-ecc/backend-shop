import axios from "axios";

const Api = axios.create({
  baseURL: "http://backend-shop.test/api",
  // baseURL: "http://fp-backend-shop.test/api",
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
    Authorization: `Bearer ${localStorage.getItem("token")}`,
  },
});

export default Api;
