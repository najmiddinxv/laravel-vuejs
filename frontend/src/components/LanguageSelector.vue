<script setup>
import { ref } from "vue";
import { useLanguageStore } from "@/store/language";

const languageStore = useLanguageStore();
const selectedLanguage = ref(languageStore.language);

const changeLanguage = () => {
  languageStore.setLanguage(selectedLanguage.value);
};
</script>
<template>
  <div class="language-selector">
    <select class="form-select" v-model="selectedLanguage" @change="changeLanguage">
      <option value="uz">Uz</option>
      <option value="ru">Ru</option>
      <option value="en">En</option>
      <!-- Add more languages as needed -->
    </select>
  </div>
</template>
<style scoped>
.language-selector .form-select{
    width: 70px;
}
</style>