<template>
    <div>
        <spinner v-if="loading" />
        <div v-else>
            <div id='header' class="position-relative overflow-hidden p-3 p-md-5 text-center bg-light">
                <div class="col-md-5 p-lg-5 mx-auto my-5">
                    <h1 class="display-4 fw-normal">{{header}}</h1>
                </div>

            </div>
            <div class="article text-center">
                <div class="card mb-4">
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

        this.incrementView();

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
        },

        async incrementView(){
            setTimeout(() => {
                axios.post('/api/articles/' + this.id +'/act', {
                    action: 'view-increment',
                }).then((res) => {
                    this.view = res.data.view
                });
            }, 5000);
        }
    }
}
</script>

<style scoped>
    .card.mb-4 {
        margin-top: 20px;
        padding: 20px;
    }
    .article-footer, .article-footer div {
        margin: 10px;
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
    #header {
        border-radius: 0.375rem;
        background-image: url('https://via.placeholder.com/1260x500');
    }


</style>
