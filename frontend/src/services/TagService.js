import { apiV1 } from './api';

const getTags = async () => {
  try {
    const response = await apiV1.get(`/tags`);
    return response.data;
  } catch (error) {
    console.error('Error fetching tags:', error);
    throw error;
  }
};

const getTagsItem = async (id) => {
  try {
    const response = await apiV1.get(`/tags/${id}`);
    return response.data;
  } catch (error) {
    console.error('Error fetching tags:', error);
    throw error;
  }
};

const createTag = async (tag) => {
  try {
    
    const response = await apiV1.post('/tags', tag);
    return response.data;
  } catch (error) {
    console.error('Error creating tag:', error);
    throw error;
  }
};


const editTag = async (id) => {
  try {
    const response = await apiV1.get(`/tags/edit/${id}`);
    return response.data;
  } catch (error) {
    console.error('Error fetching tags:', error);
    throw error;
  }
};


const updateTag = async (id, tag) => {
  try {
    const response = await apiV1.put(`/tags/${id}`, tag);
    return response.data;
  } catch (error) {
    console.error('Error updating tag:', error);
    throw error;
  }
};


const deleteTag = async (id) => {
  try {
    const response = await apiV1.delete(`/tags/${id}`);
    return response.data;
  } catch (error) {
    console.error('Error deleting tag:', error);
    throw error;
  }
};

export default {
  getTags,
  getTagsItem,
  createTag,
  editTag,
  updateTag,
  deleteTag
};
