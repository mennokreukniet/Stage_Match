<template>
    <div>
        <div class="card">
            <span class="title">Create internship</span>

            <div class="error" v-if="error.show">{{error.message}}</div>
            <div class="success" v-if="success.show">{{success.message}}</div>

            <div class="form">
                <span class="label">Mentor</span>
                <input v-model="internship.mentor" class="classic" type="text">
                <span class="label">Start datum</span>
                <input v-model="internship.start" class="classic" type="date">
                <span class="label">Eind datum</span>
                <input v-model="internship.end" class="classic" type="date">

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
                company: "",
                mentor: "",
                period: ""
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
