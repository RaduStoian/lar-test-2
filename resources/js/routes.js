import home from './components/pages/home';
import posts from './components/pages/posts';
import post from './components/pages/post';

export default [
    {
        path: '/',
        component: home,
        name: 'home'
    },
    {
        path: '/posts',
        component: posts,
        name: 'posts'
    },
    {
        path: '/post/:id',
        component: post,
        name: 'post'
    }
]
