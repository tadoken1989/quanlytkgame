<template>
	<div class="row">
		<div class="recipe__header col-md-12">
			<h3>{{action}}</h3>
			<div>
				<button class="btn btn__primary" @click="save" :disabled="isProcessing">Save</button>
				<button class="btn" @click="$router.back()" :disabled="isProcessing">Cancel</button>
			</div>
		</div>
        <div class="clearfix"></div>
		<div class="recipe__row row">
			<div class="col-md-12">
				<div class="recipe__box">
					<div class="form__group">
					    <label>Name</label>
					    <input type="text" class="form__control" v-model="form.title">
					    <small class="error__control" v-if="error.name">{{error.title[0]}}</small>
					</div>
					<div class="form__group">
					    <label>Description</label>
					    <textarea class="form__control form__description" v-model="form.description"></textarea>
					    <small class="error__control" v-if="error.description">{{error.description[0]}}</small>
					</div>
					<div class="form__group">
						<label>Content</label>
						<!--<textarea class="form__control form__description" v-editor v-model="form.content"></textarea>-->
                        <Ckeditor v-model="form.content" ></Ckeditor>
						<small class="error__control" v-if="error.description">{{error.content[0]}}</small>
					</div>
                    <div class="form__group">
                        <label>Category</label>
                        <select v-model="form.category">
                            <option  v-for="c in category" :value="c.id">{{c.name}}</option>
                        </select>
                        <small class="error__control" v-if="error.name">{{error.categorys[0]}}</small>
                    </div>
				</div>
			</div>
		</div>
        <div class="recipe__row row">
            <div class="col-md-4">
                <div class="form-group recipe__box">
                    <h3 class="recipe__sub_title">Locations</h3>
                    <div v-for="(location, index) in form.locations" class="recipe__form">
                        <input type="text" class="form__control" v-model="location.name"
                               :class="[error[`locations.${index}.name`] ? 'error__bg' : '']">
                        <button @click="remove('locations', index)" class="btn btn__danger">&times;</button>
                    </div>
                    <button @click="addLocation" class="btn">Add Location</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group recipe__box">
                    <h3 class="recipe__sub_title">Tags</h3>
                    <div v-for="(tag, index) in form.tags" class="recipe__form">
                        <input type="text" class="form__control form__margin" v-model="tag.name"
                               :class="[error[`tags.${index}.name`] ? 'error__bg' : '']" />
                        <button @click="remove('tags', index)" class="btn btn__danger">&times;</button>
                    </div>
                    <button @click="addTag" class="btn">Add Tag</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group recipe__box">
                    <image-upload v-model="form.image"></image-upload>
                    <small class="error__control" v-if="error.image">{{error.image[0]}}</small>
                </div>
            </div>
        </div>
	</div>
</template>
<script type="text/javascript">
	import Vue from 'vue'
	import Flash from '../../helpers/flash'
	import { get, post } from '../../helpers/api'
	import { toMulipartedForm } from '../../helpers/form'
	import ImageUpload from '../../components/ImageUpload.vue'
	import Ckeditor from '../../components/Ckeditor.vue'

	export default {
		components: {
			ImageUpload,
			Ckeditor,
		},
		data() {
			return {
				form: {
					tags: [],
					locations: []
				},
                category:{},
				error: {},
				isProcessing: false,
				initializeURL: `/api/posts/create`,
				storeURL: `/api/posts`,
				action: 'Create'
			}
		},
		created() {
			if(this.$route.meta.mode === 'edit') {
				this.initializeURL = `/api/posts/${this.$route.params.id}/edit`
				this.storeURL = `/api/posts/${this.$route.params.id}?_method=PUT`
				this.action = 'Update'
			}
			get(this.initializeURL)
				.then((res) => {
					Vue.set(this.$data, 'form', res.data.form)
					Vue.set(this.$data, 'category', res.data.category)
				})
		},
		methods: {
			save() {
				const form = toMulipartedForm(this.form, this.$route.meta.mode)
                console.log(form)
				post(this.storeURL, form)
				    .then((res) => {
				        if(res.data.saved) {
				            Flash.setSuccess(res.data.message)
				            this.$router.push(`/post/${res.data.alias}`)
				        }
				        this.isProcessing = false
				    })
				    .catch((err) => {
				        if(err.response.status === 422) {
				            this.error = err.response.data
				        }
				        this.isProcessing = false
				    })
			},
			addLocation() {
				this.form.locations.push({
					name: ''
				})
			},
			addTag() {
				this.form.tags.push({
					name: '',
				})
			},
			remove(type, index) {
				if(this.form[type].length > 1) {
					this.form[type].splice(index, 1)
				}
			}
		}
	}
</script>