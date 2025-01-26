<template>
    <div class="tags-routes">
        <nav>
            <router-link :to="{ name: 'tagsIndex' }">
                Index
            </router-link> |
            <router-link :to="{ name: 'tagsCreate'}">
                Create
            </router-link>
        </nav>
    </div>
</template>
<style>
.tags-routes{
    text-align: center;
}
.tags-routes nav{
    padding: 0;
}
.tags-routes nav a {
  font-size: 14px;
}
</style>