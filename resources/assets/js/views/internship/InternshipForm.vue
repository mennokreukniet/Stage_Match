<template>
    <div>

        <div v-if="errors.message" class="error">{{ errors.message }}</div>
        <div v-if="errors.exception" class="error">{{ errors.exception }}</div>

        <h3>{{ id ? "Edit: " + internship.title : "Create new internship"}}</h3>

        <form @submit.prevent="submit">

        <my-input v-for="input in form" :key="input.name"
                  v-bind="input"        :errors="errors[input.name]"
                  v-model="internship[input.name]"/>

            <!--skillpicker v-model="internship.skills"/-->

        </form>

    </div>
</template>

<script>
import http from '@/core/http';
import Skillpicker from '@/views/internship/Skillpicker';
import MyInput from '@/views/internship/components/MyInput';

export default {
    name: 'internshipForm',
    components: {
        Skillpicker,
        MyInput
    },
    props: ['id', "lol"],
    created() {
        console.log(this.lol)
        http.interceptors.response.use(undefined, error => {
            this.errorHandler(error.response);
            throw error;
        });
        if (this.id) { //if form is showing an existing internship
            this.httpUrl += "/" + this.id;
            this.httpMethod = "put";
            http.get(this.httpUrl).then(response => {
                this.internship = response.data.data;
            });
        }
    },
    watch: {
        lol: function(newVal, oldVal) { // watch it
          console.log('Prop changed: ', newVal, ' | was: ', oldVal)
        }
    },
    data() {
        return {
errors: {}, //objects with arrays of errors : {mentor: ["The mentor field is required."], title: ["The title field is required"]}
internship: {}, // i
form: [ //input objects
    {name: "title", label: "Titel", required: true},
    {name: "body", label: "Body", type: "textarea", required: true},
    {name: "mentor", label: "Mentor", required: true},
    {name: "start_date", label: "Start datum", type: "date", required: true,},
    {name: "end_date", label: "Eind datum", type: "date", required: true},
    {name: "image", label: "Afbeelding", type: "imagepicker", required: true},
],


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
                (this.internship.image instanceof File // post image if image was uploaded
                    ? this.postImage(`internship/${response.data.id}/image`) // get internship id from server
                    : Promise.resolve()) // else resolve promise and emit submit event
                .then(() => {
                    this.$emit('submit', response.data.message);
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