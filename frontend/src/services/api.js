import axios from 'axios';

const apiV1 = axios.create({
  baseURL: 'http://localhost:8000/api/v1',
});

const setAxiosLanguageHeader = (language) => {
  apiV1.defaults.headers.common['Accept-Language'] = language;
};

export { 
  apiV1, 
  setAxiosLanguageHeader 
};