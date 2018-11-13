<template>
    <div class="card">
        <modal v-if="showDeleteModal" @confirm="destroyInternship" @close="showDeleteModal = false"
               title="Confirm Deletion" :body="`Delete the internship '${internship.title}'?`"/>
        <slot></slot>
        <div class="error" v-if="error">{{ error }}</div>
        <div class="form">
            <!--stage-match-input type="text" v-model="internship.mentor"/-->
            <span class="label">Mentor</span>
            <input v-model="internship.mentor" class="classic" type="text">
            <span class="label">Title</span>
            <input v-model="internship.title" class="classic" type="text">
            <span class="label">Body</span>
            <textarea v-model="internship.body" class="w3-input w3-border" type="text" rows="8"></textarea>
            <span class="label">Start datum</span>
            <input v-model="internship.start_date" class="classic" type="date">
            <span class="label">Eind datum</span>
            <input v-model="internship.end_date" class="classic" type="date">
            <span class="label">Image</span>

            <input @change="imageHandler" id="image" class="w3-hide" type="file" accept="image/*">
            <template v-if="uploadedFile">
                <label for="image" class="w3-button w3-border">{{ uploadedFile.name }}</label>
                <img v-if="imageDataURL" :src="imageDataURL"/>
            </template>
            <template v-else-if="internship.image && !uploadedFile">
                <label for="image" class="w3-button w3-border">{{ internship.image.name }}</label>
                <img :src="internship.image.url">
            </template>
            <label v-else for="image" class="w3-button w3-border">Select Image</label>

            <div class="w3-panel">
                <button class="w3-button w3-blue" @click="submit">Submit</button>
                <button v-if="internship.id" class="w3-button w3-red w3-right" @click="showDeleteModal = true">Delete</button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import Http from '../../core/http';
    import Modal from './Modal';

    export default {
        name: 'internship-form',
        components: {
            Modal
        },
        props: {
            internship: {
                type: Object,
                default: () => ({})
            },
            httpMethod: {
                type: String,
                required: true
            },
            httpUrl: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                uploadedFile: null,
                imageDataURL: null,
                error: null,

                showDeleteModal: false,
            }
        },
        methods: {
            imageHandler: function (event) {
                if (this.uploadedFile = event.target.files[0]) {
                    let reader = new FileReader();
                    reader.readAsDataURL(this.uploadedFile);
                    reader.addEventListener('load', () => this.imageDataURL = reader.result);
                }
            },

            submit: function () {
                this.submitInternship().then((resolve) => {
                    let promise = this.uploadedFile
                        ? this.submitImage(resolve.data.id)
                        : Promise.resolve();//{response: {data: {message:'no image added'}}});
                    promise.then(() => {
                        this.$notify(resolve.data.message);
                        this.$router.push('/internship');
                    }, reject => this.error = reject.response.data.message)
                }, reject => this.error = reject.response.data.message);
            },

            submitInternship: function () {
                return new Http()[this.httpMethod](this.httpUrl, this.internship);
            },

            submitImage: function (id) {
                let formData = new FormData();
                formData.append('image', this.uploadedFile);

                return axios.post(`/api/internship/${id}/image`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Authorization': `Bearer ${localStorage.getItem("accessToken")}`
                    }
                });
            },
            destroyInternship: function () {
                new Http().delete(this.httpUrl).then(resolve => {
                    this.$notify({text: resolve.data.message, type: 'warn'});
                    this.$router.back();
                });
            }
        }
    };
</script>