<template>
  <q-layout view="hHh Lpr lFf" class="shadow-2 rounded-borders">
    <q-header elevated color="pink">
      <q-toolbar class="bg-primary text-white">
        <q-toolbar-title>
          <img src="statics/icons/1.png">
        </q-toolbar-title>
        <q-tabs>
          <q-route-tab
            icon="home"
            to="/"
            :active="$route.name == 'account'"
          >
          <q-tooltip content-class="bg-pink" content-style="font-size: 16px" :offset="[10, 10]">
            Ir para home!
          </q-tooltip>
          </q-route-tab>
          <q-route-tab
            icon="library_books"
            to="/posts"
            :active="$route.name == 'users'"
          >
          <q-tooltip content-class="bg-pink" content-style="font-size: 16px" :offset="[10, 10]">
            Exibir todos os posts!
          </q-tooltip>
          </q-route-tab>
          <q-route-tab
            icon="library_add"
            to="/post/create"
            :active="$route.name == 'users'"
          >
          <q-tooltip content-class="bg-pink" content-style="font-size: 16px" :offset="[10, 10]">
            Criar novo post!
          </q-tooltip>
          </q-route-tab>
        <q-btn-dropdown auto-close stretch flat icon="sentiment_very_satisfied" dropdown-icon="keyboard_arrow_down">
          <q-list>
            <q-item clickable v-close-popup>
              <q-item-section>
                <q-item-label>Photos</q-item-label>
              </q-item-section>
            </q-item>
          </q-list>
        </q-btn-dropdown>
        </q-tabs>
      </q-toolbar>
    </q-header>
    <q-page-container>
      <router-view></router-view>
      <q-ajax-bar
      ref="bar"
      position="bottom"
      color="info"
      size="10px"
    />
    </q-page-container>
  </q-layout>
</template>

<script>
import { axiosInstance } from 'boot/axios'

export default {
  name: 'MyLayout',
  mounted () {
  },
  data () {
    return {
      loading: false,
      header: null,
    }
  },
  methods: {
  }
}
</script>

<style lang="stylus">
</style>
