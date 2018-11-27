<template>
    <div class="w3-card w3-white w3-panel">

        <modal v-if="showDeleteModal"
               @confirm="destroyInternship" @close="showDeleteModal = false"
               title="Confirm Deletion" :body="`Delete the internship '${internship.title}'?`"/>

        <!--------------------------------------------------------------------->
        <div v-if="errors.message" class="error">{{ errors.message }}</div>
        <div v-if="errors.exception" class="error">{{ errors.exception }}</div>
        <h3>{{ id ? "Edit: " + internship.title : "Create new internship"}}</h3>
        <!--------------------------------------------------------------------->


        <form @submit.prevent="submit" @reject="errorHandler">

            <my-input v-for="input in form" :key="input.name"
                      v-model="internship[input.name]" :errors="errors[input.name]"
                      v-bind="input"/>

            <div class="w3-section">
                <button class="w3-button w3-blue" type="submit">Submit</button>
                <a v-if="id" class="w3-button w3-red w3-right" @click="showDeleteModal = true">Delete</a>
            </div>

        </form>

    </div>
</template>

<script>
import axios from 'axios';

const http = axios.create({
    baseURL: window.location.origin + '/api/',
    headers: {
        Authorization: 'Bearer ' + localStorage.getItem("accessToken")
    }
});
import Modal from '@/views/internship/components/Modal';
import MyInput from '@/views/internship/components/MyInput';
import Imagepicker from "@/views/internship/components/Imagepicker";

export default {
    name: 'internship-form',
    components: {
        Imagepicker,
        Modal,
        MyInput
    },
    props: {
        id: String // === $routes.params.id
    },
    created () {
        http.interceptors.response.use(undefined, error => {
            this.errorHandler(error.response);
            throw error;
        });
        if (this.id) { //if form is showing an existing internship
            this.httpUrl += "/" + this.id;
            this.httpMethod = "put";
            http.get(this.httpUrl).then(response => {
                this.internship = response.data;
            });
        }
    },
    data () {
        return {
            internship: {},
            form: [ //input objects
                {name: "title",     label: "Titel",                             required: true},
                {name: "body",      label: "Body",          type: "textarea",   required: true},
                {name: "mentor",    label: "Mentor"},
                {name: "start_date",label: "Start datum",   type:"date",        required: true,},
                {name: "end_date",  label: "Eind datum",    type:"date"},
                {name: "image",     label: "Afbeelding",    type:"imagepicker"},
            ],

            errors: {}, //objects with arrays of errors : {mentor: ["The mentor field is required.", "The mentor must be a string."]}
            showDeleteModal: false,

            httpUrl: "internship",
            httpMethod: "post",
        }
    },

    methods: {
        submit: function (event) {
            // post or put internship data
            http[this.httpMethod](this.httpUrl, this.internship).then(response => {
                // if post/put succeeds then post image if uploaded
                (this.internship.image instanceof File
                    ? this.postImage(`internship/${response.data.id}/image`)
                    : Promise.resolve())
                .then(() => {
                    this.$notify(response.data.message);
                    this.$router.push('/internship');
                })
            });
        },
        postImage: function (url) {
            let formData = new FormData();
            formData.append('image', this.internship.image);
            return http.post(url, formData)
        },
        errorHandler: function (errorResponse) {
            this.errors = errorResponse.data.errors || errorResponse.data || errorResponse;
        },
        destroyInternship: function () {
            http.delete(this.httpUrl).then(response => {
                this.$notify({text: response.data.message, type: 'warn'});
                this.$router.push('/internship');
            }, () => this.showDeleteModal = false);
        }
    },

};
</script>