<template>
    <div id="main">
        <div class="card">
            <span class="title">Account Settings</span>

            <input v-model="name" type="text" placeholder="Name">
            <input v-model="email" type="text" placeholder="E-Mail">
            <button v-on:click="edit">Edit profile</button>
        </div>
    </div>    
</template>

<script>
const axios = require("axios");

export default {
    name: "settings",
    created() {
        axios.get(`${window.location.origin}/api/user`, { headers: { Authorization: "Bearer " + localStorage.getItem("accessToken") } }).then(res => {
            this.name = res.data.name;
            this.email = res.data.email;
        })
    },
    data() {
        return {
            name: "",
            email: ""
        }
    },
    methods: {
        edit() {
            if (this.name === "" || this.email === "") alert("Fields cannot be empty!");
            axios.post(`${window.location.origin}/api/user/edit`, { "name": this.name, "email": this.email }, { headers: { Authorization: "Bearer " + localStorage.getItem("accessToken") } }).then(res => {
                alert("Edited!");
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
        margin: 10px;
    }

    div.card > span.title {
        letter-spacing: 2px;
        display: block;
        font-size: 23px;
        margin-bottom: 40px;
    }
</style>
