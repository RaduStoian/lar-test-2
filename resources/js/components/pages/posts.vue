<template>
    <div class="posts-page">
        <h2>All Posts</h2>
        <router-link class="post-main" :to="'/post/'+item.id" v-for="item in posts" :key="item.id">

            <div class="image-container">
                <img class="image" v-if="item.image" :src="item.image" :alt="item.name" />
            </div>

            <div class="post-text">
                {{ item.text }}
            </div>
        </router-link>


    </div>

</template>

<script>
export default {
    name: 'posts',

    data: function() {
        return {
            name:'posts',
            posts:[],
        }
    },
    metaInfo() {
        return {
            title: 'Posts-page',
        }
    },

    methods: {
        getPosts() {
            axios.get('/api/post/get-posts',
                ).then(response => {
                    this.posts = response.data;
            })
        }
    },
        mounted() {
           this.getPosts();
    },
}
</script>

<style lang="scss" scoped>
@import '../../../sass/variables.scss';
.posts-page {
    background-color: $color-off-white;
    padding:2rem;
    .post-main {
        display:block;
        margin:2rem 0;
        max-width:400px;
        padding: 2rem;
        border-radius: 15px;
        background: white;
        text-decoration: none;
        img {
            max-width:100%;
        }
        .post-text {
            white-space: pre-wrap;
            color:black;
            text-decoration: none;
        }
    }

}

</style>

