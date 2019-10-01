function isArrayOrString (variable) {
  if (typeof variable === typeof [] || typeof variable === typeof '') {
    return true
  }
  return false
}

export default ({ router, store, Vue }) => {
/*
  router.beforeEach((to, from, next) => {
  })
*/
  var helper = {}
  helper.posts = () => { return store.getters['auth/posts'] }
  helper.createPost = (data) => { return store.dispatch('auth/createPost', data) }
  helper.getPost = (slug) => { return store.dispatch('auth/getPost', slug) }
  helper.getPosts = () => { return store.dispatch('auth/getPosts') }

  Vue.prototype.$auth = helper
}
