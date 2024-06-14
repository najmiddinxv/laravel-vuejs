<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import TagService from '@/services/TagService';
import TagsMenuComponent from '@/components/TagsMenuComponent.vue';
import TagsListComponent from '@/components/Tags/TagsListComponent.vue';



//============crud functions========================================
const tags = ref([]);

const loadTags = async () => {
  const response = await TagService.getTags();
  tags.value = response.data.tags;
};

const handleDeleteTag = (id) => {
  console.log(`Delete tag with ID: ${id}`);
  
};
//================================================================
onMounted(() => {
  loadTags();
  document.addEventListener('language-changed', function() {
    loadTags()
  });
});

onUnmounted(() => {
  document.addEventListener('language-changed', function() {
    loadTags()
  });
});
</script>
<template>
  <div class="tags-index">
    <tags-menu-component></tags-menu-component>
    <h1>Tags List</h1>
    <TagsListComponent :tags="tags" @deleteDataItem="handleDeleteTag" />
  </div>
</template>
<style scoped>
</style>
