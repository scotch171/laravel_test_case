<template>
    <div class="album py-5 bg-light">
        <div class="container">
            <spinner v-if="loading" />
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" v-else>
                <article-item
                    v-for="article in articles"
                    :id="article.id"
                    :header="article.header"
                    :created_at="article.created_at"
                    :view="article.view"
                    :likes="article.likes"
                />
            </div>
        </div>
    </div>
</template>

<script>
import ArticleItem from "./ArticleItem";
import Spinner from "../Spinner";
import axios from 'axios';

export default {
    name: "List",
    components: {
        ArticleItem,
        Spinner,
    },
    data: () => ({
        articles: [],
        loading: true,
    }),
    props: {
        count: {
            type: Number,
            default: 15,
        },
        pagination: {
            type: Boolean,
            default: false,
        }
    },
    mounted() {
        this.fetchPosts();
    },
    methods: {
        fetchPosts() {
            axios.get('/api/articles/', {
                params: {
                    count: this.count
                }
            })
            .then(res => {
                if (res.status === 200) {
                    this.articles = res.data.data
                    this.loading = false;
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
