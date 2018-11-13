<template>
    <div class="card">
        <slot></slot>
        <div class="form">

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

            <input @change="imageHandler" id="image" class="w3-hide" type="file">

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
                <button class="w3-button w3-blue" @click="submit">Edit</button>
                <button class="w3-button w3-red w3-right" @click="$emit('delete')">Delete</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            internship: {
                type: Object,
                default: () => ({})
            }
        },
        data() {
            return {
                uploadedFile: null,
                imageDataURL: null,
            }
        },
        methods: {
            submit: function () {
                this.$emit('submit', this.uploadedFile);
            },
            imageHandler: function (event) {
                if (this.uploadedFile = event.target.files[0]) {
                    let reader = new FileReader();
                    reader.readAsDataURL(this.uploadedFile);
                    reader.addEventListener('load', () => this.imageDataURL = reader.result);
                }
            },
            uploadInternshipImage: function () {
                let formData = new FormData();
                formData.append('image', this.internship.image);

                let promise =  axios.post(`/api/internship/${this.internship.id}/image`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Authorization': `Bearer ${localStorage.getItem("accessToken")}`
                    }
                }).then(() => {
                    this.$notify(`'${this.internship.image.name}' successfully uploaded`);
                });
                this.$emit('upload', promise);
            },
        }
    };
</script>