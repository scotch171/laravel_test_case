<template>
    <nav class="pagination-navigation">
        <ul class="pagination" >
            <li class="page-item" v-for="link in links" :class="{'active': link.active}">
                <a class="page-link" @click.prevent="updatePage(link.url)">{{ link.label }}</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: "Pagination",
    props: {
        links: {
            type: Array,
        },
    },
    methods: {
        updatePage(url){
            this.$emit('updateParent', {
                url,
            })
        },
    },
}
</script>

<style scoped>
    .pagination {
        margin: 20px auto;
    }
    .pagination-navigation {
        display: flex;
    }
</style>
