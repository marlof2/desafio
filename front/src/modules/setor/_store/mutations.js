import Jwt from "../../../api/jwt";
import router from "../../../router"

const STORE_ALL_SETOR = (state, setores) => {
  state.setores = setores
}

const STORE_SETOR_BY_ID = (state, setor) => {
  state.setor = setor
}



export default{
  STORE_ALL_SETOR,
  STORE_SETOR_BY_ID
}
