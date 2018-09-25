import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from '../views/Auth/Login.vue'
import Register from '../views/Auth/Register.vue'
import Home from '../views/Home/Index.vue'
import PostShow from '../views/Post/Show.vue'
import PostForm from '../views/Post/Form.vue'
import NotFound from '../views/NotFound.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'history',
	routes: [
		{ path: '/', component: Home },
		{ path: '/post/create', component: PostForm, meta: { mode: 'create' }},
		{ path: '/post/:alias/edit', component: PostForm, meta: { mode: 'edit' }},
		{ path: '/post/:alias', component: PostShow },
		{ path: '/register', component: Register },
		{ path: '/login', component: Login },
		{ path: '/not-found', component: NotFound },
		{ path: '*', component: NotFound }
	]
})

export default router
