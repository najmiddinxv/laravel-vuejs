<!-- src/components/Tags/TagCreateComponent.vue -->
<script setup>

import TagsMenuComponent from "@/components/TagsMenuComponent.vue"
import { ref } from 'vue';
// import { useRouter } from 'vue-router';
import TagService from '@/services/TagService';

const tagNames = ref({
    uz: '',
    ru: '',
    en: ''
});
// const router = useRouter();
const successMessage = ref('');
const errorMessage = ref('');

const createTag = async () => {
  try {
    // const response = await TagService.createTag(tagNames.value);
    const response = await TagService.createTag({ name: tagNames.value });
    if (response.success) {
        successMessage.value = response.message;
        tagNames.value = {uz:'',ru:'',en:''}
        //   setTimeout(() => {
        //     router.push('/');
        //   }, 2000);
    }
  } catch (error) {
    console.error('Error creating tag:', error);
    if (error.response && error.response.data) {
      errorMessage.value = error.response.data.message || 'Failed to create tag';
    } else {
      errorMessage.value = 'An unexpected error occurred';
    }
  }
};
</script>
<template>
  <div class="tag-create">
    <tags-menu-component></tags-menu-component>
    <h2>Tags create</h2>
    <div v-if="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ successMessage }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div v-if="errorMessage" class="alert alert-danger" role="alert">
      {{ errorMessage }}
    </div>
    <form @submit.prevent="createTag" class="form-group">
        <div class="form-group">
            <label for="name_uz">Name (uz)</label>
            <input type="text" name="name" id="name_uz" class="form-control" v-model="tagNames.uz" placeholder="" required />
        </div>
        <div class="form-group">
            <label for="name_ru">Name (ru)</label>
            <input type="text" name="name" id="name_ru" class="form-control" v-model="tagNames.ru" placeholder="" />
        </div>
        <div class="form-group">
            <label for="name_en">Name (en)</label>
            <input type="text" name="name" id="name_en" class="form-control" v-model="tagNames.en" placeholder="" />
        </div>
       <div>
        <div class="mt-2"> 
            <button type="submit" class="btn btn-primary">Create Tag</button>
        </div>
       </div>
    </form>
  </div>
</template>
<style scoped>
.tag-create {
  margin: 20px;
}
</style>
