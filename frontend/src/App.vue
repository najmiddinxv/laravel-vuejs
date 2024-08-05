<script setup>
import MainView from '@/views/MainView.vue'
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
</script>
<template>
  <div class="container">
    <MainView/>
    <router-view/>
  </div>
</template>
<style>
</style>
