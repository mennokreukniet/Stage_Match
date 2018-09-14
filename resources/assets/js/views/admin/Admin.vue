<template>
    <div id="main">
        <div class="card">
            <span class="title">Admin </span>
            
            <div class="skills">
                <template v-for="(value, index) in this.skills" class="skill">
                    <div v-bind:key="value.id" class="skill">
                        <button v-on:click="remove(value.id)">remove</button>    
                        <span>{{value.name}}</span>
                    </div>
                </template>
            </div>
        </div>
    </div>    
</template>

<script>
const axios = require("axios");
export default {
    name: "admin",
    created () {
        axios.get("http://localhost:8000/api/admin/skill").then(res => {this.skills = res.data})
    },
    data() {
        return {
            skills: []
        }
    },
    methods: {
        remove: (id, index) => {
            axios.delete(`http://localhost:8000/api/admin/skill/${id}`).then(res => {
                skills.splice(index, 1);
            })
        },

        create: (name) => {
            
        }
    }
}
</script>

<style>
    .card {
        background: white;
        border-radius: 20px;
        padding: 20px 30px;
    }

    div.card > span.title {
        letter-spacing: 2px;
        display: block;
        font-size: 23px;
        margin-bottom: 40px;
    }
</style>
