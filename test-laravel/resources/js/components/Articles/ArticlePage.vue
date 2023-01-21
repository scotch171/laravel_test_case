<template>
    <div>
        <spinner v-if="loading" />
        <div class="article px-4 py-5 my-5 text-center" v-else>
            <div class="card mb-4">
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

            <article-tags :id="id" />
            <article-comment :id="id" />
        </div>
    </div>
</template>

<script>
import axios from "axios";
import spinner from "../Spinner";
import ArticleTags from "./ArticleTags";
import ArticleComment from "./ArticleComment";

export default {
    name: "ArticlePage",
    components: {
        ArticleComment,
        spinner,
        ArticleTags
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
        },
        json: {
            type: Object
        }
    },
    mounted() {
        if (this.json) {
            this.setData(this.json)
        } else {
            this.fetchData();
        }

        let chanel = Echo.channel('article-chanel.' + this.id);
        chanel.listen('ArticleAction', data => this.likes = data.likes);
    },
    methods: {
        async fetchData() {
            axios.get('/api/articles/' + this.id)
            .then(res => {
                if (res.status === 200) {
                    this.setData(res.data.article);
                }
            })
        },

        setData(obj) {
            this.header =  obj.header;
            this.text = obj.text;
            this.likes = obj.likes;
            this.view = obj.view

            this.loading = false;
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
