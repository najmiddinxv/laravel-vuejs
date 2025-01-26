<script setup>
import TagsMenuComponent from "@/components/TagsMenuComponent.vue"
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import TagService from '@/services/TagService';
import TagsItemComponent from "@/components/Tags/TagsItemComponent.vue";

const tagItem = ref(null);
const route = useRoute();

const loadTagDetail = async () => {
    const tagId = route.params.id;
    const response = await TagService.getTagsItem(tagId);
    tagItem.value = response.data;
};

onMounted(() => {
  loadTagDetail();
});
</script>
<template>
    <div class="tags-show">
        <tags-menu-component></tags-menu-component>
        <h2>Tags item show</h2>
        <TagsItemComponent :tag="tagItem"/>
    </div>
</template>
<style scoped>
</style>