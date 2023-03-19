<template>
    <div class="home-page">

        <PostForm />

    </div>

</template>

<script>
import PostForm from '../utility/post-form';

import { mapGetters, mapActions } from 'vuex';

export default {
    name: 'home',

        components: {
            PostForm,
        },

    data: function() {
        return {
            name:'home',
        }
    },
    metaInfo() {
        return {
            title: 'Home-page',
        }
    },
    computed: {
        user() {
            return this.$store.state.user.user;
        },
    },

    methods: {
        ...mapActions({
            setUser: 'user/setUser',
            setSpinner: 'spinner/setSpinner',
            setOverlay: 'global_overlay/setOverlay',
        }),
    },
}
</script>

<style lang="scss" scoped>
@import '../../../sass/variables.scss';
.home-page {
    background-color: $color-off-white;
    .main {
        text-align: center;
        padding: 0;
    }

}

</style>

