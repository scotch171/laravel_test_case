<template>
    <list :count="15" :pagination="false"></list>
</template>

<script>
import List from "../components/Articles/List";

export default {
    name: "Show",
    components: {
        List
    }
}
</script>

<style scoped>

</style>
