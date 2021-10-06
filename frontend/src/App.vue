<template>
  <div id="app">
    <Navbar v-if="authenticated"></Navbar>
   <!-- <div id="nav">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link> |
      <router-link to="/login">Login</router-link>
    </div> -->
    <router-view/>
  </div>
</template>
<script>
import Navbar from './components/NavbarComponent.vue'
import {mapGetters} from 'vuex' 

export default {
  name: 'App',
  components:{
    Navbar
  },
  computed: {
    ...mapGetters([
      'authenticated'
    ])
  }
  
}
</script>
<style>
body{
  margin: 0;
  background-color: #383838;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
