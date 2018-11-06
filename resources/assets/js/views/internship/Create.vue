<template>
    <div>
        <div class="card">
            <span class="title">Create internship</span>

            <div class="error" v-if="error.show">{{error.message}}</div>
            <div class="success" v-if="success.show">{{success.message}}</div>

            <div class="form">
                <span class="label">Mentor</span>
                <input v-model="internship.mentor" class="classic" type="text">
                <span class="label">Title</span>
                <input v-model="internship.title" class="classic" type="text">
                <span class="label">Body</span>
                <textarea v-model="internship.body" class="classic" type="text"></textarea>
                <span class="label">Start datum</span>
                <input v-model="internship.start_date" class="classic" type="date">
                <span class="label">Eind datum</span>
                <input v-model="internship.end_date" class="classic" type="date">

                <button class="submit" v-on:click="create">Create</button>
            </div>
        </div>
    </div>    
</template>

<script>
import Http from '../../core/http';

export default {
    name: "create_internship",
    data() {
        return {
            internship: {
                title: "",
                body: "",
                mentor: "",
                start_date: "",
                end_date: ""
            },
            error: {
                show: false,
                message: ""
            },
            success: {
                show: false,
                message: ""
            } 
        }
    },
    methods: {
        create() {
            new Http().post("internship", this.internship).then(data => {
                this.success = {
                    show: true,
                    message: "Internship created"
                }
            }).catch(error =>{
                //console.log(error.response.data.errors);
                this.error = {
                    show: true,
                    message: error.response.data.errors
                }
            })
        }
    }
}
</script>
