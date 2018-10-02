<template>
    <div id="main">
        <div class="card">
            <span class="title">Admin </span>
            <span class="title">Skills</span>
            <div class="skills">
                <span v-if="this.skills.length === 0">There are no skills, add one!</span>
                <template v-for="(value, index) in this.skills" class="skill">
                    <div v-bind:key="value.id" class="skill">
                        <button v-on:click="remove(value.id, index)">remove</button>    
                        <span>{{value.name}}</span>
                    </div>
                </template>
            </div>
    <br><br>
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
        axios.get(`${window.location.origin}/api/admin/skill`, { headers: { Authorization: "Bearer " + localStorage.getItem("accessToken") } }).then(res => {this.skills = res.data})
    },
    data() {
        return {
            skills: [],
            new_skill: ""
        }
    },
    methods: {
        remove (id, index)  {
            axios.delete(`${window.location.origin}/api/admin/skill/${id}`, { headers: { Authorization: "Bearer " + localStorage.getItem("accessToken") } }).then(res => {
                this.skills.splice(index, 1);
            })
        },

        create () {
            axios.post(`${window.location.origin}/api/admin/skill`, {"name": this.new_skill}, { headers: { Authorization: "Bearer " + localStorage.getItem("accessToken") } }).then(res => {
                this.skills.push(res.data.result[0]);
                this.new_skill = "";
            })
        }
    }
}
</script>
