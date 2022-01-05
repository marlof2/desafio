<template>
  <component :is="resolveLayout">
    <router-view></router-view>
  </component>
</template>

<script>
import { computed } from '@vue/composition-api'
import { useRouter } from '@/utils'
import LayoutBlank from '@/layouts/Blank.vue'
import LayoutContent from '@/layouts/Content.vue'
// import {mapActions, mapGetters} from "vuex"
// import storeAuth from "@/modules/auth/_store"

export default {
  components: {
    LayoutBlank,
    LayoutContent,
  },
  // async mounted() {
  //   await this.me()
  // },
  // methods: {
  //   ...mapActions({
  //     me: '$_auth/me',
  //   }),
  // },
  // computed: {
  //   ...mapGetters({
  //   })
  // },
  // beforeCreate() {
  //   const STORE_AUTH = '$_auth';
  //   if (!(STORE_AUTH in this.$store._modules.root._children))
  //     this.$store.registerModule(STORE_AUTH, storeAuth)
  // },
  setup() {
    const { route } = useRouter()

    const resolveLayout = computed(() => {
      // Handles initial route
      if (route.value.name === null) return null

      if (route.value.meta.layout === 'blank') return 'layout-blank'

      return 'layout-content'
    })

    return {
      resolveLayout,
    }
  },

}
</script>
