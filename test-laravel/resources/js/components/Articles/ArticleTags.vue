<template>
    <div>
        <spinner v-if="loading" />
        <div v-else class="card mb-4">
            <div class="article-tags-body">
                <h3>Tags</h3>

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
            axios.get('/api/articles/' + this.id + '/getTags').then((res) =>
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
        padding: 10px;
    }
    .article-tags-body span a {
        font-size: 16px;
        color: white;
        text-decoration: none;
    }
    .article-tags-body {
        padding: 20px;
    }
</style>
