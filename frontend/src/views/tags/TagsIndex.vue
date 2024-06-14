<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import TagService from '@/services/TagService';
import TagsMenuComponent from '@/components/TagsMenuComponent.vue';
import TagsListComponent from '@/components/Tags/TagsListComponent.vue';

const tags = ref([]);

const loadTags = async () => {
  try {
    const response = await TagService.getTags();
    tags.value = response.data.tags;
  } catch (error) {
    console.error('Error fetching tags:', error);
  }
};

const handleDeleteTag = (id) => {
  console.log(`Delete tag with ID: ${id}`);
  // Add your delete logic here if needed
};

const onLanguageChange = () => {
  loadTags();
};

onMounted(() => {
  loadTags();
  document.addEventListener('language-changed', onLanguageChange);
});

onUnmounted(() => {
  document.removeEventListener('language-changed', onLanguageChange);
});

</script>

<template>
  <div class="tags-index">
    <tags-menu-component></tags-menu-component>
    <h1>Tags List</h1>
   
    <TagsListComponent
      :tags="tags"
      @deleteDataItem="handleDeleteTag"
    />
  </div>
</template>

<style scoped>
/* Add your styles here */
</style>
