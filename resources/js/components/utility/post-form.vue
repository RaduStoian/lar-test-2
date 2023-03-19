<template>

	<section class="form-section">

		<form v-on:submit.prevent="onSubmit">

            <h2>Add Post</h2>
            <p class="section-head">Add image</p>
            <h4 class="form-message">{{errors.imageError}}</h4>
            <div class="image-container">
				<div class="image-preview"></div>
				<div class="image-input">
					<label for="image">Choose Image</label>
					<input id="image" type="file" name="image" accept="image/*" @change="onFileChange()"/>
				</div>
			</div>

            <p class="section-head">Add Text</p>
            <textarea class="input-field textarea" rows="5" placeholder="content" v-model="inputs.text"></textarea>

			<button class="button blue" type="submit">Create Post</button>

			<h4 class="form-message">{{errors.apiError}}</h4>
			<p class="form-message">{{errors.apiErrorExtra}}</p>

            <template v-if="this.post">
			    <router-link :to="'/post/'+post.id" class="button blue" type="submit">Go To This Specific Post</router-link>
            </template>

		</form>
	</section>

</template>


<script>
import { required, minLength, between } from 'vuelidate/lib/validators'
import { mapGetters, mapActions } from 'vuex';

export default {

	name: 'post-form',
    data: function() {

        return {
            post: false,
            inputs:{
                text:'',
                file:'',
            },
            imageUrl:'',
            errors:{
                apiError:'',
                apiErrorExtra:'',
                imageError:'',
            },
        }
    },
    methods:{
        ...mapActions({
            setSpinner: 'spinner/setSpinner',
        }),
        onSubmit() {
			let self = this;

            let fileInput = document.getElementById('image').files[0];

			if (!this.inputs.text || !fileInput) {
				this.errors.apiError = 'Fill all fields'
				return;
			}
            this.errors.apiError = ''
            this.errors.apiErrorExtra = ''

			let formData = new FormData();

			this.setSpinner(true);

			formData.append("text", this.inputs.text);
			formData.append("image", fileInput);

            // CREATE POST
            axios.post('/api/post/create-post', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                self.errors.apiError = response.data.message;
                self.setSpinner(false);

                if (response.data.post) {
                    this.post = response.data.post;
                }

            // The image error is triggered dependant on server config
            }).catch(error => {
                self.setSpinner(false);
                self.errors.apiError = error.response.data.message;
                if(error.response.data.errors.image[0]) {
                    self.errors.apiErrorExtra = error.response.data.errors.image[0];
                }
                else if (!self.errors.apiError){
                    let imageFile = document.getElementById('image').files[0];
                    if (imageFile.size > 2000000) {
                        self.errors.apiError = 'Please do not add Image larger than 2 MB';
                    }
                }
            });

        },
        onFileChange(e) {
            let self = this;
            if (document.getElementById('image').files) {
                let imageFile = document.getElementById('image').files[0];
                this.imageUrl = URL.createObjectURL(imageFile);

                let imagePreview = document.querySelector('.image-preview ');
                imagePreview.style.background="url("+this.imageUrl+")";

                if (imageFile.size > 2000000) {
                    self.errors.apiError = 'Please do not add Image larger than 2 MB';
                    self.errors.imageError = 'Please do not add Image larger than 2 MB';
                }
                else {
                    self.errors.apiError = '';
                }
            }

		},
	},
}
</script>

<style lang="scss" scoped>
@import '../../../sass/variables.scss';
.form-section {
    padding:3rem;
    max-width: 400px;
    margin: auto;

    h2 {
        color:$primary;
    }

    p.section-head {
        margin:0;
        font-weight: 700;
        margin-top:2rem;
        font-size: 0.8rem;

    }

	.image-container {
		display: grid;
		grid-template-columns: 6rem auto;
        grid-gap: 1rem;

		.image-preview {
			border:1px solid $primary-strong;
			background-position: center !important;
			background-size: cover !important;
			background-repeat: no-repeat !important;
            height:6rem;
            width:6rem;
		}
		.image-input {
			input {
				display:block;
                border:none;
			}
		}
	}

    .textarea {
        width:100%;
    }

    button {
        display:block;
        background:$primary;
        border-radius: 5px;
        color:white;
        margin-top: 2rem;
        width: 100%;
        padding: 5px;
    }
    .form-message {
        color:red;
    }
}
</style>
