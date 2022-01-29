import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";

import Jwt from "./jwt";

const Api = {
  init() {
    Vue.use(VueAxios, axios);
    Vue.axios.defaults.baseURL = process.env.VUE_APP_API_URL;
    this.setupHeaders();
    Vue.axios.interceptors.response.use(function(response) {
      return response;
    });
  },

  setupHeaders() {
    Vue.axios.defaults.headers.common["Content-Type"] = "application/json";
    Vue.axios.defaults.headers.common["Accept"] = "application/json";
    Vue.axios.defaults.headers.common[
      "Authorization"
      ] = `Bearer ${Jwt.getToken()}`;
    ["get", "post", "put", "patch"].forEach(function(method) {
      Vue.axios.defaults.headers[method]["Content-Type"] = "application/json";
    });
  },

  async query(resource, data) {
    return new Promise(resolve => {
      const result = Vue.axios.get(resource, { params: data });
      resolve(result);
    });
  },

  get(resource, slug = "") {
    return new Promise(resolve => {
      const result = Vue.axios.get(`${resource}/${slug}`);
      resolve(result);
    });
  },

  async post(resource, params, options) {
    const result = await Vue.axios.post(
      `${resource}`,
      JSON.stringify(params),
      options
    );
    return result;
  },

  async put(resource, id, params) {
    const result = await Vue.axios.put(
      `${resource}${id ? "/" + id : ""}`,
      JSON.stringify(params)
    );
    return result;
  },

  patch(resource, id, params) {
    return Vue.axios.patch(`${resource}/${id}`, JSON.stringify(params));
  },

  delete(resource, id) {
    return new Promise(resolve => {const result = Vue.axios.delete(`${resource}/${id}`); resolve(result);
    });
  }
};
export default Api;
