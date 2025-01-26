<script setup>
import LanguageSelector from '@/components/LanguageSelector.vue';
</script>

<template>
  <div class="main-view">
    <div class="language-component">
      <LanguageSelector />
    </div>
    <nav class="default-routers">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link> |
      <router-link to="/tags">Tags</router-link>
    </nav>

  </div>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  /* text-align: center; */
  color: #2c3e50;
}

.default-routers {
  padding: 30px;
}

nav a {
  font-size: 18px;
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}

.default-routers {
  margin: 30px 0 30px 0;
  padding: 0;
}

.main-view {
  text-align: center;
}
.main-view .language-component {
  display: flex;
  justify-content: end;

}
</style>
