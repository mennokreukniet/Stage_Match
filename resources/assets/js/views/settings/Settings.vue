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
                <span class="label">Skills</span>
                <input v-model="skill" class="classic" type="text" placeholder="Skillname">
                <div  style="background: green; width: calc(100% - 40px);border-radius: 2px;padding: 15px 20px" v-if="skills.show">
                    <template v-for="value in this.skills.list" class="skill">
                        <div v-bind:key="value.id" class="skill">
                            <button v-on:click="add_skill(value.id)">{{value.name}}</button>
                        </div>
                    </template>
                </div>
                <button class="submit" v-on:click="edit">Edit profile</button>
            </div>
        </div>
    </div>    
</template>

<script>
import Http from '../../core/http';

export default {
    name: "settings",
    created() {
        new Http().get("user").then(res => {
            this.name = res.data.name;
            this.email = res.data.email;
        })
    },
    data() {
        return {
            name: "",
            email: "",
            skill: "",
            skills: {
                show: false,
                list: []
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
    watch: {
        email: function (email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (!re.test(email.toLowerCase())) {
                document.getElementById("email").classList.remove("valid");
                document.getElementById("email").classList.add("invalid");
            } else {
                document.getElementById("email").classList.remove("invalid");
                document.getElementById("email").classList.add("valid");
            }
        },
        skill: function (skillname) {
            if (skillname === "") return this.skills.show = false;

            new Http().get(`user/skill/${skillname}`).then(res => {
                this.skills = {
                    show: true,
                    list: res.data.result
                }
            });
        }
    },
    methods: {
        edit() {
            this.success.show = false;
            this.error.show = false;
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

            new Http().post(`user/edit`, { "name": this.name, "email": this.email })
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
        },
        add_skill(id) {
            this.error = {
                show: true,
                message: "Adding skills is not implemented :(!"
            }
            // new Http().post("user").then(res => {
            //     this.name = res.data.name;
            //     this.email = res.data.email;
            // })
        }
    }
}
</script>
