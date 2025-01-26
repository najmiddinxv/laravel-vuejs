<!-- src/components/Tags/TagEditComponent.vue -->
<script setup>

import TagsMenuComponent from "@/components/TagsMenuComponent.vue"
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
// import { useRouter } from 'vue-router';
import TagService from '@/services/TagService';

// Initialize the tagNames object with default values
const tagNames = ref({
  uz: '',
  ru: '',
  en: ''
});

// const router = useRouter();
const route = useRoute();
const successMessage = ref('');
const errorMessage = ref('');

const loadTag = async () => {
  try {
    const response = await TagService.editTag(route.params.id);
    // console.log(response.data);
    
    tagNames.value = {
      uz: response.data.name_uz,
      ru:response.data.name_ru,
      en:response.data.name_en
    }
  } catch (error) {
    console.error('Error loading tag:', error);
    errorMessage.value = 'Failed to load tag data';
  }
};

const updateTag = async () => {
  try {
    const response = await TagService.updateTag(route.params.id, { name: tagNames.value });
    if (response.success) {
      successMessage.value = response.message;
      // setTimeout(() => {
      //   router.push('/');
      // }, 2000);
    }
  } catch (error) {
    console.error('Error updating tag:', error);
    if (error.response && error.response.data) {
      errorMessage.value = error.response.data.message || 'Failed to update tag';
    } else {
      errorMessage.value = 'An unexpected error occurred';
    }
  }
};

onMounted(() => {
  loadTag();
});
</script>

<template>
  <div class="tag-edit">
    <tags-menu-component></tags-menu-component>
    <h2>Tag edit</h2>
    <div v-if="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ successMessage }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div v-if="errorMessage" class="alert alert-danger" role="alert">
      {{ errorMessage }}
    </div>
    <form @submit.prevent="updateTag" class="form-group">
        <div class="form-group">
            <label for="name_uz">Name (uz)</label>
            <input type="text" name="name" id="name_uz" class="form-control" v-model="tagNames.uz" placeholder="Tag name uz" required />
        </div>
        <div class="form-group">
            <label for="name_ru">Name (ru)</label>
            <input type="text" name="name" id="name_ru" class="form-control" v-model="tagNames.ru" placeholder="Tag name ru" />
        </div>
        <div class="form-group">
            <label for="name_en">Name (en)</label>
            <input type="text" name="name" id="name_en" class="form-control" v-model="tagNames.en" placeholder="Tag name en" />
        </div>
       <div>
        <div class="mt-2"> 
            <button type="submit" class="btn btn-primary">Update tag</button>
        </div>
       </div>
    </form>
  </div>
</template>

<style scoped>

</style>
