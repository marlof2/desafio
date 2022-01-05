import Jwt from "../../../api/jwt";
import router from "../../../router"

const STORE_ALL_CLIENTE = (state, clientes) => {
  state.clientes = clientes
}

const STORE_CLIENTE_BY_ID = (state, cliente) => {
  state.cliente = cliente
}



export default{
  STORE_ALL_CLIENTE,
  STORE_CLIENTE_BY_ID
}
