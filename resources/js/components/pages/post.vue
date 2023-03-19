<template>
    <div class="post-page">
        <h2>Post Page</h2>
        <div v-if="post">
            <div class="post-main" v-if="post.id">
                <div class="image-container">
                    <img class="image" v-if="post.image" :src="post.image" :alt="post.name" />
                </div>
                <div class="post-text">
                    {{ post.text }}
                </div>
            </div>
        </div>

        <div v-if="post">
            <p v-if="!post.id">NOT FOUND</p>
        </div>
    </div>

</template>

<script>
export default {
    name: 'posts',

    data: function() {
        return {
            name:'posts',
            post:false,
            queryID: (window.location.pathname).split("/")[2],
        }
    },
    metaInfo() {
        return {
            title: 'Posts-page',
        }
    },

    methods: {
        getPost() {
            axios.post('/api/post/get-post-data',{'id':this.queryID}
                ).then(response => {
                    this.post = response.data;
            })
        }
    },
        mounted() {
           this.getPost();
    },
}
</script>

<style lang="scss" scoped>
@import '../../../sass/variables.scss';
.post-page {
    background-color: $color-off-white;
    padding:2rem;
    .post-main {
        margin:2rem 0;
        max-width:400px;
        padding: 2rem;
        border-radius: 15px;
        background: white;
        img {
            max-width:100%;
        }
        .post-text {
            white-space: pre-wrap;
        }
    }

}

</style>

