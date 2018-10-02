<template>
    <div id="main">
        <div class="card">
            <span class="title">Account Settings</span>

            <div class="error" v-if="error.show">{{error.message}}</div>
            <div class="success" v-if="success.show">{{success.message}}</div>

            <div class="form">
                <span class="label">Name</span>
                <input v-model="name" class="classic" type="text" placeholder="Name">
                <span class="label">Email</span>
                <input id="email" v-model="email" class="classic" type="text" placeholder="E-Mail">
                
                <button class="submit" v-on:click="edit">Edit profile</button>
            </div>
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
            email: "",
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
    watch: {
        // whenever question changes, this function will run
        email: function (new_email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (!re.test(this.email.toLowerCase())) {
                document.getElementById("email").classList.remove("valid");
                document.getElementById("email").classList.add("invalid");
            } else {
                document.getElementById("email").classList.remove("invalid");
                document.getElementById("email").classList.add("valid");
            }
        }
    },
    methods: {
        edit() {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (this.name === "" || this.email === "") { 
                this.success.show = false;
                this.error = {
                    show: true,
                    message: "Inputs can't be empty!"
                }

                return;
            }

            if (!re.test(this.email.toLowerCase())) {
                this.success.show = false;
                this.error = {
                    show: true,
                    message: "Email invalid!"
                }

                return;
            }

            axios.post(`${window.location.origin}/api/user/edit`, { "name": this.name, "email": this.email }, { headers: { Authorization: "Bearer " + localStorage.getItem("accessToken") } })
            .then(res => {
                this.error.show = false;

                this.success = {
                    show: true,
                    message: "Data saved!"
                }
            }).catch(err => {
                this.success.show = false;
                
                this.error = {
                    show: true,
                    message: "Something went wrong!"
                }
            });
        }
    }
}
</script>
