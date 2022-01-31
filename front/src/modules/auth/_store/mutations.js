import Jwt from "../../../api/jwt";
import router from "../../../router"

const STORE_ME = (state, me) => {
  state.me = me
}
const STORE_AUTH = (state, user) => {
  state.user = user
}
const STORE_ME_LOGOUT = (state) => {
  router.push({name: 'login'})
  state.me = []
  Jwt.destroyToken()
  router.go(0)

}


export default{
  STORE_ME,
  STORE_ME_LOGOUT,
  STORE_AUTH
}
