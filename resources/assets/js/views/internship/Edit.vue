<template>
    <div>
        <modal v-if="showDeleteModal" @confirm="destroyInternship" @close="showDeleteModal = false"
               title="Confirm Deletion" :body="`Delete the internship '${internship.title}'?`"
        />
        <internship-form :internship="internship" @submit="update" @delete="showDeleteModal = true">

            <span class="title">Edit internship</span>
            <div class="error" v-if="error.show">{{error.message}}</div>
        </internship-form>
    </div>
</template>

<script>
    import Http from '../../core/http';
    import Modal from './Modal';
    import Form from './InternshipForm';
    import axios from 'axios';

    export default {
        components: {
            'internship-form': Form,
            Modal,
        },
        data() {
            return {
                showDeleteModal: false,
                internship: {},
                error: {}
            }
        },
        created() {
            new Http().get(this.$route.path.replace('/', '')).then(res => {
                this.internship = res.data;
            })
        },
        methods: {
            update: function (upload) {
                console.log(upload);
                if (upload) {
                    Promise.all([this.updateInternship(), this.uploadInternshipImage(upload)])
                    .then(() => {
                        this.$router.back();
                    }, reject => {
                        this.error = {
                            show: true,
                            message: reject.response.data.message
                        }
                    });
                } else {
                    this.updateInternship().then(() => this.$router.back());
                }
            },
            updateInternship: function () {
                return new Http().put(this.$route.path.replace('/', ''), this.internship).then(() => {
                    this.$notify(`Internship '${this.internship.title}' successfully updated`);
                });
            },
            uploadInternshipImage: function (image) {
                let formData = new FormData();
                formData.append('image', image);

                return axios.post(`/api/internship/${this.internship.id}/image`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Authorization': `Bearer ${localStorage.getItem("accessToken")}`
                    }
                }).then(() => {
                    this.$notify(`'${image.name}' successfully uploaded`);
                });
            },
            destroyInternship: function () {
                new Http().delete(this.$route.path.replace('/', '')).then(() => {
                    this.$notify({text: `Internship '${this.internship.title}' successfully deleted`, type: 'warn'});
                    this.$router.push('/internship');
                });
            },
        }
    }
</script>
