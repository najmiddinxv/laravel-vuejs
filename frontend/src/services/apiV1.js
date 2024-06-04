// services/apiV1.js
import axios from 'axios';
import languageStore from '@/store/language';

const baseURL = 'http://localhost:8000/api/v1';

const apiV1 = axios.create({
  baseURL,
});

apiV1.interceptors.request.use((config) => {
  config.headers['Accept-Language'] = languageStore.currentLanguage.value;
  return config;
}, (error) => {
  return Promise.reject(error);
});

export default apiV1;
