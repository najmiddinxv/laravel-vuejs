<script setup>
import { defineProps, defineEmits } from 'vue';

defineProps({
  tags: {
    type: Array,
    required: true
  }
});

defineEmits(['deleteDataItem']);
</script>

<template>
  <div class="tags-list-component">
    <ul class="list-group">
      <li v-for="(tag, index) in tags" :key="tag.id" class="list-group-item">
        <span>{{ index + 1 }}. 
          <!-- <router-link :to="{ name: 'tagsShow', params: { id: tag.id } }">
            {{ tag.name }}
          </router-link> -->
          <router-link :to="`/tags/${tag.id}`">{{ tag.name }}</router-link>
        </span>
        <button @click="$emit('deleteDataItem', tag.id)" class="btn btn-danger">Delete</button>
      </li>
    </ul>
  </div>
</template>

<style scoped>
.list-group-item{
  display: flex;
  justify-content: space-between;
}
</style>
