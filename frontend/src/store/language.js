import { defineStore } from 'pinia';
import { ref, watch } from 'vue';
import { setAxiosLanguageHeader } from '@/services/api';

export const useLanguageStore = defineStore('language', () => {
  const language = ref('uz'); // Default language

  const setLanguage = (newLanguage) => {
    language.value = newLanguage;
    setAxiosLanguageHeader(newLanguage);
  };

  // Initialize with the default language
  setAxiosLanguageHeader(language.value);

  // Watch for changes in the language and take appropriate action
  watch(language, (newLang) => {
    // Notify other parts of your application that the language has changed
    document.dispatchEvent(new CustomEvent('language-changed', { detail: newLang }));
  });

  return {  
    language,
    setLanguage,
  };
});
