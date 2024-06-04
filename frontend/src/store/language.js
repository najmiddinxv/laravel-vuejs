import { ref } from 'vue';

const currentLanguage = ref('uz');

const setLanguage = (lang) => {
  currentLanguage.value = lang;
};

export default {
  currentLanguage,
  setLanguage
};
