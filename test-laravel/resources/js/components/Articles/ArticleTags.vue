<template>
    <div>
        <spinner v-if="loading" />
        <div v-else>
            <h3>Tags</h3>
            <div class="article-tags-body">
                <span v-for="tag in tags" class="badge text-bg-primary">
                    <a :href="'/tags/' + tag.id">
                        {{ tag.label }}
                    </a>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import spinner from "../Spinner";

export default {
    name: "ArticleTags",
    components: {
        spinner,
    },

    data: () => ({
        tags: [],
        loading: true,
    }),
    props: {
        id: {
            type: Number,
            required: true,
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios.get('/api/tags/getAllForArticle/' + this.id).then((res) =>
            {
                res.data.forEach((tag, index)=> {
                    this.$set(this.tags, index, tag);
                });
                this.loading = false;
            })
        }
    }
}
</script>

<style scoped>
    .article-tags-body span {
        margin: 10px;
    }
    .article-tags-body span a {
        font-size: 16px;
        color: white;
        text-decoration: none;
    }
</style>
