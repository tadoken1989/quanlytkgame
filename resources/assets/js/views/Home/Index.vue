<template>
	<div class="row">
		<div class="col-md-4" v-for="post in posts">
			<router-link class="recipe__inner" :to="`/post/${post.alias}`">
				<img :src="`${post.image}`" class="img-responsive" v-if="post.image">
			</router-link>
            <h3 class="title">{{post.title}}</h3>
            <p class="recipe__name">{{post.description}}</p>
		</div>
	</div>
</template>
<script type="text/javascript">
	import { get } from '../../helpers/api'
	export default {
		data() {
			return {
				posts: []
			}
		},
		created() {
			get('/api/posts')
				.then((res) => {
					this.posts = res.data.posts
				})
		}
	}
</script>
