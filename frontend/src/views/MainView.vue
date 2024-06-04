<script setup>

import languageStore from '@/store/language';
const changeLanguage = (lang) => {
  languageStore.setLanguage(lang);
};

</script>

<template>
  <div class="main-view">
    <div>
      <button @click="changeLanguage('en')">English</button>
      <button @click="changeLanguage('uz')">Uzbek</button>
    </div>
    <nav class="default-routers">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link> |
      <router-link to="/tags">Tags</router-link> |
      <router-link to="/categories">Categoris</router-link>
    </nav>

  </div>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
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
</style>
