<template>
    <div class="tags-routes">
        <nav>
            <router-link :to="{ name: 'tagsIndex' }">
                Index
            </router-link> |
            <router-link :to="{ name: 'tagsShow', params: { id: 1 } }">
                Show
            </router-link>
        </nav>
    </div>
</template>
<style>
.tags-routes nav{
    padding: 0;
}
.tags-routes nav a {
  font-size: 14px;
}
</style>