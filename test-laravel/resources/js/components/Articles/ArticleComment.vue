<template>
    <spinner v-if="loading"/>
    <div v-else class="article-comments-body">
        <div class="article-comments-list">
            <div class="add-comment card mb-4">
                <h3>Add comment</h3>
                <form @submit.prevent="addComment" >
                    <div class="input-group mb-3">
                        <input v-model="formData.userName" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <input v-model="formData.text" type="text" class="form-control" placeholder="Text" aria-label="Text" aria-describedby="basic-addon1">
                    </div>
                    <button :disabled="sendForm || !formData.text.length || !formData.userName.length" type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>

            <div class="card mb-4" v-for="comment in comments">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row">
                            <p class="small mb-0">{{ comment.user_name }}</p>
                        </div>
                    </div>
                    <p>
                        {{ comment.text }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import spinner from "../Spinner";
import axios from "axios";

export default {
    name: "ArticleComment",
    components: {
        spinner
    },
    props: {
        id: {
            type: Number,
            required: true,
        }
    },
    data: () => ({
        loading: true,
        comments: [],
        formData: {
            userName: '',
            text: '',
            articleId: '',
        },
        sendForm: false,
    }),
    mounted(){
        axios.get('/api/articles/' + this.id + '/getComments').then((res) =>
        {
            res.data.forEach((tag, index)=> {
                this.$set(this.comments, index, tag);
            });
            this.loading = false;
        })
    },
    methods: {
        addComment() {
            this.sendForm = true;
            this.formData.articleId = this.id;
            axios.post('/api/article-comments',this.formData);

            this.$set(this.comments, this.comments.length, {
                user_name: this.formData.userName,
                text: this.formData.text
            });
            this.formData.text = '';
            this.sendForm = false;
        }
    }
}
</script>

<style scoped>
    .add-comment {
        padding: 20px;
    }
</style>
