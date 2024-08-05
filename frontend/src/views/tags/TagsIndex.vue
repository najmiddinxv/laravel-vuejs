<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import TagService from '@/services/TagService';
import TagsMenuComponent from '@/components/TagsMenuComponent.vue';
import TagsListComponent from '@/components/Tags/TagsListComponent.vue';



//============crud functions========================================
const tags = ref([]);
const showMessage = ref(false);
const showMessageTxt = ref('Tag deleted successfully!');

const loadTags = async () => {
  const response = await TagService.getTags();
  tags.value = response.data.tags;
};

const handleDeleteTag = async (id) => {
  console.log(`Delete tag with ID: ${id}`);
  const response = await TagService.deleteTag(id);
  console.log(response);
  
  if (response.success) {
    tags.value = tags.value.filter(tag => tag.id !== id);
    showMessageTxt.value = response.message;
    showSuccessMessage();
  }
  return response;
};

const showSuccessMessage = () => {
  showMessage.value = true;
  setTimeout(() => {
    showMessage.value = false;
  }, 2000);
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
    <h2>Tags list</h2>
    <div v-if="showMessage" class="alert alert-success" role="alert">
      {{ showMessageTxt }}
    </div>
    <TagsListComponent :tags="tags" @deleteDataItem="handleDeleteTag" />
  </div>
</template>
<style scoped>

</style>
