<script setup>
import { ref, onMounted,watch } from 'vue';
import TagService from '@/services/TagService';
import TagsMenuComponent from '@/components/TagsMenuComponent.vue';
import TagsListComponent from '@/components/Tags/TagsListComponent.vue';
import languageStore from '@/store/language';

const tags = ref([]);

const getTags = async () => {
  try {
    const response = await TagService.getTags();
    if (response.success && response.code === 200) {
      tags.value = response.data.tags;
      console.log([...tags.value]);
    } else {
      console.error('Failed to fetch tags:', response.message);
    }
  } catch (error) {
    console.error('Error fetching tags:', error);
  }
};

const handleDeleteTag = (id) => {
  console.log(`Delete tag with ID: ${id}`);
  // Add your delete logic here if needed
};

onMounted(() => {
  getTags();
});
watch(() => languageStore.currentLanguage, () => {
  getTags();
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
