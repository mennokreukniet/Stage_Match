<template>
    <div id="main">
        <div class="card">
            <span class="title">Admin </span>
            
            <div class="skills">
                <template v-for="(value, index) in this.skills" class="skill">
                    <div v-bind:key="value.id" class="skill">
                        <button v-on:click="remove(value.id, index)">remove</button>    
                        <span>{{value.name}}</span>
                    </div>
                </template>
            </div>
    <br>
            <span class="title">Create Skill</span>
            <input v-model="new_skill" type="text">
            <br>
            <button v-on:click="create()">create skill</button>
        </div>
    </div>    
</template>

<script>
const axios = require("axios");
export default {
    name: "admin",
    created () {
        axios.get("http://159.65.199.115/api/admin/skill").then(res => {this.skills = res.data})
    },
    data() {
        return {
            skills: [],
            new_skill: ""
        }
    },
    methods: {
        remove (id, index)  {
            axios.delete(`http://159.65.199.115/api/admin/skill/${id}`).then(res => {
                this.skills.splice(index, 1);
            })
        },

        create () {
            axios.post(`http://159.65.199.115/api/admin/skill`, {"name": this.new_skill}).then(res => {
                this.skills.push(res.data.result[0]);
                this.new_skill = "";
            })
        }
    }
}
</script>

<style>
    .card {
        background: white;
        border-radius: 20px;
        padding: 20px 30px;
        margin: 15px;
        box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(0,0,0,0.08);

    }

    div.card > span.title {
        letter-spacing: 2px;
        display: block;
        font-size: 23px;
        margin-bottom: 40px;
    }
</style>
