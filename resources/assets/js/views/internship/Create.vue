<template>
    <div id="main">
        <div class="card">
            <span class="title">Create internship</span>

            <div class="error" v-if="error.show">{{error.message}}</div>
            <div class="success" v-if="success.show">{{success.message}}</div>

            <div class="form">
                <span class="label">Company</span>
                <input v-model="internship.company" class="classic" type="text">
                <span class="label">Mentor</span>
                <input v-model="internship.mentor" class="classic" type="text">
                <span class="label">Period</span>
                <input v-model="internship.period" class="classic" type="text">
                
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
            })
        }
    }
}
</script>
