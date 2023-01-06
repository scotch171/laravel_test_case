<template>
    <div>
        <spinner v-if="loading" />
        <div class="article px-4 py-5 my-5 text-center" v-else>
            <div class="article-header">
                <h1>{{ header }}</h1>
            </div>
            <div class="article-body lead mb-4">
                <p>
                    {{ text }}
                </p>
            </div>

            <div class="article-footer">
                <div @click="changeLikes()" class="likes"><i :class="like ? 'bi-heart-fill' : 'bi-heart'"  class="bi "></i><div>{{ likes }}</div></div>
                <div class="viewes"><i class="bi bi-eye"></i><div>{{ view }}</div></div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import spinner from "../Spinner";

export default {
    name: "ArticlePage",
    components: {
        spinner,
    },

    data:() => ({
        header: '',
        text: '',
        likes: 0,
        view: 0,
        loading: true,
        like: false,
    }),
    props: {
        id: {
            type: Number,
        }
    },
    mounted() {
        this.fetchData();

        let chanel = Echo.channel('article-chanel.' + this.id);
        chanel.listen('ArticleAction', data => this.likes = data.likes);
    },
    methods: {
        async fetchData() {
            axios.get('/api/articles/' + this.id)
            .then(res => {
                if (res.status === 200) {
                    const article = res.data.article

                    this.header =  article.header;
                    this.text = article.text;
                    this.likes = article.likes;
                    this.view = article.view

                    this.loading = false;

                }
            })
        },

        changeLikes(){
            this.like = !this.like;

             axios.post('/api/articles/' + this.id +'/act', {
                action: this.like ? 'like-increment' : 'like-decrement',
            });
        }
    }
}
</script>

<style scoped>
    .article div {
        margin: 20px;
    }

    .article-footer, .article-footer div {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }

    .article .article-footer div {
        margin-top: 0;
        margin-bottom: 0;
    }

    .article-footer .likes {
        cursor: pointer;
    }

</style>
