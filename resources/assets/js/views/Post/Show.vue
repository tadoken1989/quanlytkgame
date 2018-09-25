<template>
	<div class="recipe__show">
		<div class="recipe__row">
			<div class="recipe__image col-md-3">
				<div class="recipe__box">
					<img :src="`${article.image}`" class="img-responsive" v-if="article.image">
				</div>
			</div>
			<div class="recipe__details col-md-9">
				<div class="recipe__details_inner">
					<small>Submitted by: {{article.author.name}}</small>
					<h1 class="recipe__title">{{article.title}}</h1>
					<p class="recipe__description">{{article.description}}</p>
					<div v-if="authState.api_token && authState.user_id === article.author_id">
						<router-link :to="`/posts/${article.id}/edit`" class="btn btn-primary">
							Edit
						</router-link>
						<button class="btn btn__danger" @click="remove(this)" :data-id="article.id" :disabled="isRemoving">Delete</button>
					</div>
				</div>
			</div>
		</div>
		<div class="recipe__row">
			<div class="recipe__ingredients">
				<div class="recipe__box">
					<h3 class="recipe__sub_title">Locations</h3>
					<ul>
						<li v-for="location in article.locations">
							<span>{{location.name}}</span>
						</li>
					</ul>
				</div>
			</div>
			<div class="recipe__directions">
				<div class="recipe__directions_inner">
					<h3 class="recipe__sub_title">Tag</h3>
					<ul>
						<li v-for="tag in article.tags">
							<p>
								{{tag.name}}
							</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			{{article.content}}
		</div>
	</div>
</template>
<script type="text/javascript">
	import Auth from '../../store/auth'
	import Flash from '../../helpers/flash'
	import { get, del } from '../../helpers/api'
	export default {
		data() {
			return {
				authState: Auth.state,
				isRemoving: false,
				article: {
					user: {},
					locations: [],
					tags: []
				}
			}
		},
		created() {
			get(`/api/posts/${this.$route.params.alias}`)
				.then((res) => {
					console.log(res.data.article)
					this.article = res.data.article
				})
		},
		methods: {
			remove(btn) {
				this.isRemoving = false
				del(`/api/posts/${this.article.id}`)
					.then((res) => {
						if(res.data.deleted) {
							Flash.setSuccess('You have successfully deleted recipe!')
							this.$router.push('/')
						}
					})
			}
		}
	}
</script>
