<script setup>
import { defineProps } from 'vue';
defineProps({
  tag: {
    required: true,
    type: Object
  }
})


// const emit = defineEmits([
//   'deleteDataItem'
// ]);

</script>
<template>
  <div class="card">
        <div class="card-body">
            <div v-if="tag" class="tag-detail">
                <p>name : <span class="bold-txt">{{ tag.name }}</span></p>
                <p>ID: <span class="bold-txt">{{ tag.id }}</span></p>
                <p>tagsable_type: <span class="bold-txt">{{ tag.tagsable_type }}</span></p>
            </div>
            <div v-else>
                <p>Tags item is loading...</p>
            </div>
        </div>
    </div>

  <!-- <div class="tags-list-component" v-if="tags.length != 0">
    <li v-for="(tag, index) in tags" :key="tag.id" class="list-group-item">
      <button @click="$emit('deleteDataItem', tag.id)" class="btn btn-danger">Delete</button>
      {{ index + 1 }}
      <p>{{ tag.name }}</p>
    </li>
  </div> -->
</template>
<style scoped>
.tag-detail{
  text-align: left;
}
.bold-txt{
  font-weight: bold;
}
</style>