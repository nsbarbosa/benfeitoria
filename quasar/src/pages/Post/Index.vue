<template>
<q-page padding class="flex-center">
    <q-breadcrumbs class="q-pl-md" gutter="xs">
        <template v-slot:separator>
          <q-icon
            size="1.2em"
            name="arrow_forward"
          ></q-icon>
        </template>
        <q-breadcrumbs-el icon="home" to="/" />
        <q-breadcrumbs-el to="/posts" label="Posts" icon="library_books" />
    </q-breadcrumbs>
  <div class="row q-pa-md">
    <div class="col-8">
      <div class="text-h4">Postagens</div>
    </div>
  </div>
  <div class="row items-center">
    <div class="q-pa-md col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3" v-for="post in data" v-bind:key="post.id">
        <q-card class="classCard" @click="show(post.slug)">
            <q-img
            :src="post.image"
            basic
            >
                <div class="absolute-bottom">
                    <div class="text-h6">
                        {{post.title}}
                    </div>
                    <div class="text-subtitle2">
                        Escrito por: {{post.author}}
                    </div>
                </div>
            </q-img>
            <q-card-section class="bg-primary text-white">
            {{post.content.substring(0,50)}}...
            </q-card-section>
            <q-separator ></q-separator>
    </q-card>
    </div>
  </div>
</q-page>
</template>

<style>
.classCard {
    width: 100%;
    max-width: 400px
}
</style>

<script>

export default {
  name: 'Posts',
  mounted () {
    this.fetch()
  },
  data () {
    return {
        data: ''
    }
  },
  methods: {
    fetch () {
      this.$auth.getPosts().then((response) => {
        console.log('fetch data', response)
        this.data = response.data.posts
      }).catch((error) => {
        console.log(error)
      }).finally(() => {
        this.loadingItems = false
      })
    },
    show (slug) {
        console.log('slug', slug)
        this.$router.push('/post/' + slug)
    }
  }
}
</script>
