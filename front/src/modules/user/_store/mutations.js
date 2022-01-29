import Jwt from "../../../api/jwt";
import router from "../../../router"

const STORE_ALL_USERS = (state, users) => {
  state.users = users
}

const STORE_USER_BY_ID = (state, user) => {
  state.user = user
}


export default {
  STORE_ALL_USERS,
  STORE_USER_BY_ID
}
