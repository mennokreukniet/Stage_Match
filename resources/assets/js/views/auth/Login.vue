<template>
    <div id="login" class="auth">
        <div class="card">
            <div class="form">
                <span class="title">Login</span>

                <div class="error" v-if="error.show">{{error.message}}</div>

                <span class="label">Email</span>
                <input @keyup.enter="login" v-model="credentials.email" id="email" class="classic" type="text" placeholder="Email">
                
                <span class="label">Password</span>
                <input @keyup.enter="login" v-model="credentials.password"  class="classic" type="password" placeholder="Password">
                
                <button class="submit margin-bottom" v-on:click="login">Login</button>

                <button style="background: #207c7e; display: block;" class="margin-top submit" v-on:click="register">Register</button>
            </div>
        </div>
    </div>
</template>

<script>
import Http from '../../core/http';

export default {
    name: "login",
    data () {
        return {
            credentials: {
                email: "",
                password: ""
            },
            error: {
                show: false,
                message: ""
            },
        }
    },
    methods: {
        login() {
            if (this.credentials.email === "" || this.credentials.password === "") {
                return this.error = {
                    show: true,
                    message: "Fields can not be empty"
                }
            }

            this.error.show = false;

            new Http().post(`auth/login`, this.credentials)
                .then(res => {
                    localStorage.setItem("accessToken", res.data.token);
                    this.$parent.set_role();
                    this.$router.push({ name: "main" });
                })
                .catch(err => {
                    this.error = {
                    show: true,
                    message: "Invalid credentials"
                }
            })
        },

        register() {
            this.$router.push({ name: "register" })  
        }
    }
}
</script>
