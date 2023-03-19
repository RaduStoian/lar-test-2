<template>
    <header>
        <nav>

            <router-link class="logo" to="/">LOGO</router-link>

            <div class="right-side">
                <router-link :class="{'active': currentPage == '/'}" to="/"><span>Home</span></router-link>
                <router-link :class="{'active': currentPage == '/posts'}"  to="/posts"><span>Posts</span></router-link>
            </div>
        </nav>
    </header>

</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    name: 'app-header',
    data: function() {
        return {
            showAccountDropdown: false,
            currentPage: window.location.pathname,
        }
    },
    computed: {
        user() {
            return this.$store.state.user.user;
        },
    },
    watch:{
        $route (to, from){
            this.currentPage = window.location.pathname;
        }
    },
    methods: {
        ...mapActions({
            setUser: 'user/setUser',
            setSpinner: 'spinner/setSpinner',
        }),
        logout() {
            this.showAccountDropdown = false;
            this.setSpinner(true);
            axios.post('/logout').then(() => {

                axios.get('/auth/init').then( response => {
                    this.setUser(response.data.user);
                    this.setSpinner(false);
                    this.$router.push('/');
                })
            })
        },
        hideAccountDropdown($url) {
            this.showAccountDropdown = false;
            this.$router.push($url)
        }
    }
}
</script>

<style lang="scss" scoped>
@import '../../../sass/variables.scss';

header {
    background-color: white;
    color: $my-grey;
    width: 100%;
    z-index: 20;
    position: static;
    min-height: 4.5rem;
    top:0;
    box-shadow: 0 1px 5px 0 rgb(0 0 0 / 30%);

    nav {
        position: relative;
        max-width: 1500px;
        margin: auto;

        .logo {
            color:$primary-strong;
            font-family: sans-serif;
            font-weight: 100;
            font-size: 2.3rem;
            text-decoration: none;
            padding: 0 20px;
            padding-left:15px;
            position: relative;
            top: 13px;
            @media #{$tablet-down} {
                display:none
            }
        }

        .right-side {
            position: absolute;
            right: 0px;
            top: 22px;
            display:grid;
            grid-template-columns: 1fr 1fr;
            text-align: center;
            @media #{$tablet-down} {
                left:0;
                max-width: 400px;
                margin: auto;
            }
            a {
                color: $my-grey;
                font-weight: 500;
                text-decoration: none;
                display: inline-block;
                padding:10px 10px;
                font-size: 0.8rem;
                text-transform: uppercase;
                font-family: sans-serif;
                font-weight: 100;
                letter-spacing: 0.7px;
                cursor: pointer;

                &.active {
                    position:relative;

                    span {
                        position:relative;
                        &::after {
                            content : "";
                            position : absolute;
                            width : 100%;
                            height : 2px;
                            background-color: $primary;
                            bottom: -3px; //to place it in bottom
                            left: 0px;
                        }
                    }
                }

                &.account-name {
                    overflow: hidden;
                    text-overflow: ellipsis;
                    max-width: 100px;
                    color: $primary;
                }
            }
            .account-dropdown {
                display: none;
                background:$primary;
                color: white;
                font-weight: 500;
                position: absolute;
                top: 2.2rem;
                right: 0px;
                z-index: 999;
                border-radius: 4px;

                &.show {
                    display:block;
                }

                ul {
                    list-style: none;
                    padding-left: 0.6rem;
                    margin: 0;
                    padding: 0;
                    li {
                        text-align: end;

                        a {
                            color:white;
                            font-weight: 100;
                            &:hover {
                                color:$primary-soft;
                            }
                        }
                    }
                }
            }
        }
    }
}

</style>
