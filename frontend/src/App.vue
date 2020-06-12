<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app temporary>

      <v-list dense>
        <v-list-item link v-for="link of links" :key="link.title" :to="link.url">
          <v-list-item-action>
            <v-icon>{{ link.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>{{ link.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

    </v-navigation-drawer>
    <v-app-bar app color="indigo" dark>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>
        <router-link to="/" tag="span" class="pointer">Shop</router-link>
      </v-toolbar-title>
      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-heart</v-icon>
      </v-btn>

      <v-btn icon>
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>
    </v-app-bar>

    <v-content>

        <router-view></router-view>

    </v-content>
    <v-footer color="indigo" app>
      <span class="white--text">&copy; 2020</span>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  name: 'App',

  props: {
    source: String
  },

  components: {},

  data: () => ({
    drawer: null,
    links: [
      { title: 'Login', icon: 'key', url: '/login' },
      { title: 'Registration', icon: 'mdi-email', url: '/registration' },
      { title: 'Orders', icon: 'mdi-email', url: '/orders' },
      { title: 'New ad', icon: 'mdi-email', url: '/new' },
      { title: 'My ad', icon: 'mdi-email', url: '/list' }
    ]
  })
}
</script>

<style scoped>
  .pointer {
    cursor: pointer;
  }
</style>
