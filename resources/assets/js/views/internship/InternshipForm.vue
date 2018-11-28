<template>
    <div class="card">
        <modal v-if="showDeleteModal"
            @confirm="destroyInternship" @close="showDeleteModal = false"
            title="Confirm Deletion" :body="`Delete the internship '${internship.title}'?`"/>

        <div v-if="errors.message" class="error">{{ errors.message }}</div>

        <div class="form">
            <custom-input v-model="internship.title" :errors="errors.title" label="Titel *" required/>
            <custom-input type="textarea" v-model="internship.body" :errors="errors.body" label="Body"/><!--type=wysiwyg or markdown-->
            <custom-input v-model="internship.mentor" :errors="errors.mentor" label="Mentor"/>
            <custom-input type="date" v-model="internship.start_date" :errors="errors.start_date" label="Start datum" />
            <custom-input type="date" v-model="internship.end_date" :errors="errors.end_date" label="Eind datum"/>

            <skillpicker :skills="internship.skills" @skillAdded="add_skill" @setLevel="set_level"/>



            <!--custom-input v-model="internship.image"        :errors="errors.image"      label="Afbeelding"  type="imagepicker" /-->

            <span class="label">Image</span>

            <input @change="imageHandler" id="image" class="w3-hide" type="file" accept="image/*">
            <template v-if="uploadedFile">
                <label for="image" class="w3-button w3-border">{{ uploadedFile.name }}</label>
                <div class="w3-card-2">
                    <img v-if="imageDataURL" :src="imageDataURL"/>
                </div>
            </template>
            <template v-else-if="internship.image && !uploadedFile">
                <label for="image" class="w3-button w3-border">{{ internship.image.name }}</label>
                <img :src="internship.image.url">
            </template>
            <label v-else for="image" class="w3-button w3-border">Select Image</label>

            <div class="w3-margin-top">
                <button class="w3-button w3-blue" @click="submit">Submit</button>
                <button v-if="this.id" class="w3-button w3-red w3-right" @click="showDeleteModal = true" :disabled="disabled">Delete</button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    const http = axios.create({
        baseURL: window.location.origin + '/api/',
        headers: {
            Authorization: `Bearer ${localStorage.getItem("accessToken")}`
        }
    });
    import Modal from './Modal';
    import MyInput from './MyInput';
    import Skillpicker from "./Skillpicker";

    export default {
        name: 'internship-form',
        components: {
            Skillpicker,
            Modal,
            customInput: MyInput
        },
        props: {
            id: String
        },
        data () {
            return {
                internship: {

                    image: null
                },
                disabled: false,
                errors: {},
                showDeleteModal: false,

                httpMethod: "post",
                httpUrl: "internship",
                skill: "",
                skills: [],

                //--------------------------------------------------------------------------------------------/>
                uploadedFile: null, //TODO remove this and put in Imagepicker.vue <my-input type="imagepicker"/>
                imageDataURL: null, //this too
            }
        },
        created () {
            if (this.id) {
                this.httpMethod = "put";
                this.httpUrl += "/" + this.id;
                http.get(this.httpUrl).then(response => {
                    this.internship = response.data;
                    console.log(this.internship);
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
                        this.$router.push('/internship');
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
            set_level(skill_id, level) {

                console.log(index, id);
                http.post("internship/skill/level", { skill_id: id, internship_id: this.internship.id, level: level}).then(res => {
                    this.internship.skills[index].pivot.level = level;
                })
            },
        },
        watch: {
            skill: function (value) {
                http.get(`skill/${value}`).then(res => {
                    this.skills = res.data.result;

                });
            }
        }
    };
</script>