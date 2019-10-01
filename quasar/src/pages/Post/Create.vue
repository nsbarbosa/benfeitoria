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
        <q-breadcrumbs-el label="Criar" icon="create"/>
    </q-breadcrumbs>
    <div class="q-pa-md">
        <q-stepper
            v-model="step"
            ref="stepper"
            color="primary"
            header-nav
            animated
            alternative-labels
        >
            <q-step
            :name="1"
            title=""
            icon="face"
            :error="errorStep(1)"
            :done="step > 1"
            >
            <div class="q-pa-md text-center text-h4">
                Vamos começar escolhendo um título e uma imagem para sua postagem!
            </div>
            <div class="row q-col-gutter-y-md">
                <div class="col-12">
                    <q-input
                      label="Título"
                      v-model.trim="data.title"
                      type="text"
                      :standout="standout_color"
                    />
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <template v-if="file !== null">
                        <q-img
                            v-if="file !== null"
                            :src="tempImage"
                            :ratio="1"
                            style="width: 150px"
                            placeholder-src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAACWBAMAAADOL2zRAAAAG1BMVEXMzMyWlpaqqqq3t7fFxcW+vr6xsbGjo6OcnJyLKnDGAAAACXBIWXMAAA7EAAAOxAGVKw4bAAABAElEQVRoge3SMW+DMBiE4YsxJqMJtHOTITPeOsLQnaodGImEUMZEkZhRUqn92f0MaTubtfeMh/QGHANEREREREREREREtIJJ0xbH299kp8l8FaGtLdTQ19HjofxZlJ0m1+eBKZcikd9PWtXC5DoDotRO04B9YOvFIXmXLy2jEbiqE6Df7DTleA5socLqvEFVxtJyrpZFWz/pHM2CVte0lS8g2eDe6prOyqPglhzROL+Xye4tmT4WvRcQ2/m81p+/rdguOi8Hc5L/8Qk4vhZzy08DduGt9eVQyP2qoTM1zi0/uf4hvBWf5c77e69Gf798y08L7j0RERERERERERH9P99ZpSVRivB/rgAAAABJRU5ErkJggg=="
                        />
                        <q-btn @click="data.image=null; tempImage = null; file = null;" color="negative" icon="delete">
                            <q-tooltip>
                                Remover Imagem
                            </q-tooltip>
                        </q-btn>
                    </template>
                    <q-btn v-else color="primary" icon="add_box" label='Selecione uma imagem' >
                        <input ref="file" type="file" name="file" class="input-file" v-on:change="setImage">
                    </q-btn>
                  </div>
              </div>
            </q-step>
            <q-step
            :name="2"
            title="Conteúdo"
            icon="perm_identity"
            :error="errorStep(2)"
            :done="step > 2"
            >
              <div class="row q-col-gutter-x-md">
                  <div class="col-12">
                    <q-input
                      label="Conteúdo"
                      v-model.trim="data.content"
                      type="text"
                      bottom-slots
                      autogrow
                      :standout="standout_color"
                    />
                  </div>
              </div>
            </q-step>
            <q-step
            :name="3"
            title="Dados"
            icon="face"
            :error="errorStep(3)"
            :done="step > 3"
            >
                <div class="q-pa-md text-center text-h4">
                    Insira seu nome para ser registrado como o autor do post!
                </div>
                <div class="row q-col-gutter-x-md">
                    <div class="col-12">
                        <q-input
                        label="Nome"
                        v-model.trim="data.author"
                        type="text"
                        bottom-slots
                        :standout="standout_color"
                        />
                    </div>
                </div>
            </q-step>
            <q-step
            :name="4"
            title="Prévia da Postagem"
            icon="healing"
            >
              <div class="row items-center">
                  <div class="col-auto">
                    <q-card class="classCard">
                        <q-img
                        :src="tempImage"
                        basic
                        >
                        <div class="absolute-bottom">
                            <div class="text-h6">
                                {{data.title}}
                            </div>
                            <div class="text-subtitle2">
                                Escrito por: {{data.author}}
                            </div>
                        </div>
                        </q-img>
                    <q-card-section class="bg-primary text-white">
                        {{data.content.substring(0,50)}}...
                    </q-card-section>
                    <q-separator ></q-separator>
                    </q-card>
                  </div>
              </div>
            </q-step>
            <template v-slot:navigation>
            <q-stepper-navigation>
                <q-btn v-if="step < 4" @click="$refs.stepper.next()" color="primary" label="Avançar" ></q-btn>
                <q-btn v-if="step === 4" @click="submit()" color="primary" label="Criar Post" :loading="loading"></q-btn>
                <q-btn v-if="step > 1" flat color="primary" @click="$refs.stepper.previous()" label="Voltar" class="q-ml-sm" ></q-btn>
            </q-stepper-navigation>
            </template>
        </q-stepper>
    </div>
  </q-page>
</template>
<style>
.q-field__prefix{
  font-weight: 700 !important
}
.input-file {
    opacity: 0;
    width: 100%;
    height: 36px;
    position: absolute;
    cursor: pointer;
  }
.classCard {
    width: 100%;
    max-width: 400px
}
</style>
<script>
export default {
  name: 'Post',
  mounted () {
  },
  data () {
    return {
      loading: false,
      step: 1,
      standout_color: 'bg-primary text-white',
      tempImage: null,
      file: null,
      form: '',
      data: {
        author: '',
        title: '',
        content: '',
        image: null
      }
    }
  },
  methods: {
    submit () {
        this.setForm()
        this.loading = true
        this.$auth.createPost(this.form).then((response) => {
          this.$q.notify({
            color: 'positive',
            message: 'Post criado com sucesso!'
          })
        }).catch((error) => {
          console.log(error)
          this.$q.notify({
            color: 'negative',
            message: 'Desculpe, aconteceu algum erro!'
          })
        }).finally(() => {
        this.loading = false
        this.$router.push('/posts')
      })
    },
    setForm() {
        this.form = new FormData()
        this.form.append('image', this.file)
        this.form.append('author', this.data.author)
        this.form.append('title', this.data.title)
        this.form.append('content', this.data.content)
    },
    setImage () {
      this.file = this.$refs.file.files[0]
      this.tempImage = URL.createObjectURL(this.$refs.file.files[0])
    },
    errorStep (step) {
      switch (step) {
        case 1:
            if (this.data.title.length > 0 && this.tempImage !== null)
                return false
            else
                return true
        case 2:
            if (this.data.content.length > 0)
                return false
            else
                return true
        case 3:
            if (this.data.author.length > 0)
              return false
            else
              return true
      }
    }
  }
}
</script>
