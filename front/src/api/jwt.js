import Api from "@/api";
const TOKEN = "token";

export default {
  getToken() {
    return window.localStorage.getItem(TOKEN);
  },

  saveToken(token) {
    window.localStorage.setItem(TOKEN, token);
    Api.init();
  },

  destroyToken() {
    window.localStorage.removeItem(TOKEN);
  }
};
