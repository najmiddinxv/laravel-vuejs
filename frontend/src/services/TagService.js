import { apiV1 } from './api';

const getTags = async () => {
  try {
    const response = await apiV1.get('/tags');
    return response.data;
  } catch (error) {
    console.error('Error fetching tags:', error);
    throw error;
  }
};

export default {
  getTags,
};
