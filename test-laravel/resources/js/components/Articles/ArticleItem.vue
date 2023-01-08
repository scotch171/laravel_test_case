<template>
    <div class="col">
        <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

            <div class="card-body">
                <p class="card-text">{{ header }}</p>
                <div class="article-text">{{text}}</div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a :href="'/articles/' + id"
                           class="btn btn-sm btn-outline-secondary">View</a>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div>
                    <small class="text-muted">{{ created_at }}</small>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ArticleItem",
    props: {
        id: {
            type: Number,
            required: true,
        },
        header: {
            type: String,
            required: true,
        },
        view: {
            type: Number,
            required: true,
        },
        likes: {
            type: Number,
            required: true,
        },
        created_at: {
            type: String,
            required: true,
        },
        text: {
            type: String,
            required: true,
        }
    }
}
</script>

<style scoped>
    .article-text {
        height: 50px;
        overflow: hidden;
        margin: 10px 0;
    }
</style>
