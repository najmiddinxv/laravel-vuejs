<script setup>
import { defineProps,  } from 'vue';
defineProps({
  tags: {
    required: true,
    type: Array
  }
})

// const emit = defineEmits([
//   'deleteDataItem'
// ]);

</script>
<template>
  <div class="tags-list-component" v-if="tags.length != 0">
    <li v-for="(tag, index) in tags" :key="tag.id" class="list-group-item">
      <button @click="$emit('deleteDataItem', tag.id)" class="btn btn-danger">Delete</button>
      {{ index + 1 }}
      <p>{{ tag.name }}</p>
    </li>
  </div>
</template>
<style scoped></style>