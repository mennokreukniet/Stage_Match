<template>
    <div class="w3-card w3-white w3-panel">

        <modal v-if="showDeleteModal"
               @confirm="destroyInternship" @close="showDeleteModal = false"
               title="Confirm Deletion" :body="`Delete the internship '${internship.title}'?`"/>

       
        <div v-if="errors.message" class="error">{{ errors.message }}</div>
        <div v-if="errors.exception" class="error">{{ errors.exception }}</div>
        <h3>{{ id ? "Edit: " + internship.title : "Create new internship"}}</h3>
        


        <div class="form">
            <custom-input v-model="internship.title" :errors="errors.title" label="Titel *" required/>
            <custom-input type="textarea" v-model="internship.body" :errors="errors.body" label="Body"/><!--type=wysiwyg or markdown-->
            <custom-input v-model="internship.mentor" :errors="errors.mentor" label="Mentor"/>
            <custom-input type="date" v-model="internship.start_date" :errors="errors.start_date" label="Start datum" />
            <custom-input type="date" v-model="internship.end_date" :errors="errors.end_date" label="Eind datum"/>

            <skillpicker v-model="internship.skills"/>

        <form @submit.prevent="submit">

            <my-input v-for="input in form" :key="input.name"
                      v-model="internship[input.name]" :errors="errors[input.name]"
                      v-bind="input"/>

            <skillpicker :skills="internship.skills" @skillAdded="add_skill" @setLevel="set_level" @delete="delete_skill"/>

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
baseURL: window.location.origin + '/api/', headers: {
        Authorization: 'Bearer ' + localStorage.getItem("accessToken")
    }
});
import Skillpicker from '@/views/internship/Skillpicker';
import Modal from '@/views/internship/components/Modal';
import MyInput from '@/views/internship/components/MyInput';
import Imagepicker from "@/views/internship/components/Imagepicker";

export default {
    name: 'internship-form',
    components: {
        Skillpicker,
        Imagepicker,
        Modal,
        MyInput
    },
    props: {
        id: String // === $routes.params.id
    },
    created() {
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
    data() {
        return {
            internship: {},
            form: [ //input objects
                {name: "title", label: "Titel", required: true},
                {name: "body", label: "Body", type: "textarea", required: true},
                {name: "mentor", label: "Mentor", required: true},
                {name: "start_date", label: "Start datum", type: "date", required: true,},
                {name: "end_date", label: "Eind datum", type: "date", required: true},
                {name: "image", label: "Afbeelding", type: "imagepicker", required: true},
            ],

            errors: {}, //objects with arrays of errors : {mentor: ["The mentor field is required.", "The mentor must be a string."]}
            showDeleteModal: false,

            httpUrl: "internship",
            httpMethod: "post",
            skill: "",
            skills: [],
        }
    },
    methods: {
        submit: function () {
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

        created () {
            if (this.id) {
                this.httpMethod = "put";
                this.httpUrl += "/" + this.id;
                http.get(this.httpUrl).then(response => {
                    this.internship = response.data.data;
                }, reject => {
                    this.errors = reject.response.data;
                });
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
                        //this.$router.push('/internship');
                    }, reject => this.errors = reject.response.data.errors)
                }, reject => this.errors = reject.response.data.errors);
            },

            submitInternship: function () {
                return http[this.httpMethod](this.httpUrl, this.internship);
            },
            submitImage: function (id) {
                let formdata = new FormData();
                formdata.append('image', this.uploadedFile);

                return http.post(`internship/${id}/image`, formdata);
            },
            destroyInternship: function () {
                http.delete(this.httpUrl).then(resolve => {
                    this.$notify({text: resolve.data.message, type: 'warn'});
                    this.$router.back();
                });
            },
            add_skill:function(id) {
                 http.post(`internship/skill`, {skill_id:id, id: this.id} ).then(res => {
                    this.internship.skills = res.data.result;
                    console.log(res);
                })
            },
            set_level(skill_id, level, index) {
                http.post("internship/skill/level", {
                    skill_id: skill_id,
                    internship_id: this.internship.id,
                    level: level
                }).then(res => {
                    this.internship.skills[index].pivot.level = level;
                })
            },
            delete_skill: function (id, index) {
                http.delete(`internship/skill/${id}`, {data:{id: this.id}});
                this.internship.skills.splice(index, 1);
            },

        },
        set_level(skill_id, level) {
            http.post("internship/skill/level", {
                skill_id: id,
                internship_id: this.internship.id,
                level: level
            }).then(res => {
                this.internship.skills[index].pivot.level = level;
            })
        },
        delete_skill: function (id, index) {
            http.delete(`internship/skill/${id}`, {data:{id: this.id}});
            this.internship.skills.splice(index, 1);
        }

    },
    watch: {
        skill: function (value) {
            http.get(`skill/${value}`).then(res => {
                this.skills = res.data.result;
            });
        }
    }
}
</script>