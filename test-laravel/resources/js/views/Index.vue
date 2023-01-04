<template>
<div>
    <list :count="15"></list>

    <div class="alert alert-danger">Говно</div>
</div>

</template>

<script>
import List from "../components/Articles/List";

export default {
    name: "Index",
    components: {
        List,
    }
}
</script>

<style scoped>

</style>
