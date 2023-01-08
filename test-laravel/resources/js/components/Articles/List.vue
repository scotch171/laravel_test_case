<template>
    <div class="album py-5 bg-light">
        <div class="container">
            <spinner v-if="loading" />
            <div v-else>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <article-item
                        v-for="article in articles"
                        :id="article.id"
                        :header="article.header"
                        :created_at="article.created_at"
                        :view="article.view"
                        :likes="article.likes"
                        :text="article.text"
                    />
                </div>

                <Pagination
                    v-if="pagination && paginationLinks.length"
                    @updateParent="fetchPosts" :links="paginationLinks"
                />
            </div>
        </div>

    </div>
</template>

<script>
import ArticleItem from "./ArticleItem";
import Spinner from "../Spinner";
import axios from 'axios';
import Pagination from "../Pagination";

export default {
    name: "List",
    components: {
        ArticleItem,
        Spinner,
        Pagination,
    },
    data: () => ({
        articles: [],
        loading: true,
        paginationLinks: [],
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
        this.fetchPosts({url: '/api/articles/'});
    },
    methods: {
        fetchPosts(props) {
            this.loading = true

            axios.get(props.url, {
                params: {
                    count: this.count
                }
            })
            .then(res => {
                if (res.status === 200) {
                    this.articles = res.data.data
                    res.data.links.forEach((item, index) => {
                        item.label = item.label.replace('&laquo;', '');
                        item.label = item.label.replace('&raquo;', '');
                        this.$set(this.paginationLinks, index, item);
                    });
                }
                this.loading = false;
            });
        }
    }
}
</script>

<style scoped>

</style>
