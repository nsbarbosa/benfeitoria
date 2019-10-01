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
        <q-breadcrumbs-el label="Ver post" icon="remove_red_eye" />
    </q-breadcrumbs>
  <div class="row q-pa-md">
    <div class="col-8">
      <div class="text-h4">Post</div>
    </div>
  </div>
  <q-card class="show-post">
    <q-img
        :src="post.image"
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
        <div class="row">
            <div class="col-12">
                {{post.content}}
            </div>
        </div>
    </q-card-section>
    </q-card>
</q-page>
</template>

<style>
.show-post {
    width: 100%;
    max-width: 500px;
}
</style>

<script>

export default {
  name: 'Posts',
  mounted () {
    this.slug = this.$route.params.slug
    this.fetch()
  },
  data () {
    return {
        slug: '',
        post: ''
    }
  },
  methods: {
    fetch () {
        console.log('slug',this.slug)
      this.$auth.getPost(this.slug).then((response) => {
        console.log('fetch post', response)
        this.post = response.data.post[0]
      }).catch((error) => {
        console.log(error)
      })
    }
  }
}
</script>
