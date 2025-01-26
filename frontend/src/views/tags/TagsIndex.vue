<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import TagService from '@/services/TagService';
import TagsMenuComponent from '@/components/TagsMenuComponent.vue';
import TagsListComponent from '@/components/Tags/TagsListComponent.vue';



//============crud functions========================================
const tags = ref([]);
const showMessage = ref(false);
const showMessageTxt = ref('Tag deleted successfully!');

const pagination = ref({
  first_page_url: null,
  last_page_url: null,
  prev_page_url: null,
  next_page_url: null,
  current_page: 1,
  from: 1,
  last_page: 1,
  path: '',
  per_page: 20,
  to: 1,
  total: 0
});
const currentPage = ref(1);


// const loadTags = async () => {
//   const response = await TagService.getTags();
//   tags.value = response.data.tags;
//   pagination.value = response.data.pagination || pagination.value; // Use existing pagination if not provided
//   currentPage.value = pagination.value.current_page;
// };

const loadTags = async (page = 1) => {
  try {
    const response = await TagService.getTags(page);
    tags.value = response.data.tags;
    pagination.value = response.data.pagination || pagination.value;
    currentPage.value = response.data.pagination.current_page;
  } catch (error) {
    console.error('Error loading tags:', error);
  }
};

const nextPage = () => {
  if (pagination.value.next_page_url) {
    const nextPage = new URL(pagination.value.next_page_url).searchParams.get('page');
    loadTags(nextPage);
  }
};

const prevPage = () => {
  if (pagination.value.prev_page_url) {
    const prevPage = new URL(pagination.value.prev_page_url).searchParams.get('page');
    loadTags(prevPage);
  }
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

    <div class="pagination-controls">
      <button class="btn btn-primary" @click="prevPage" :disabled="!pagination.prev_page_url">Previous</button>
      <span>Page {{ pagination.current_page }} of {{ pagination.last_page }}</span>
      <button class="btn btn-primary" @click="nextPage" :disabled="!pagination.next_page_url">Next</button>
    </div>

  </div>
</template>
<style scoped>

</style>
