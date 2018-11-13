<template>
    <div class="container">
        <div class="center small spacing bottom top2">
            <span class="font high subtitle1 ">Login</span>
        </div>
        <div class="card">
            <div class="form">
                <div class="error" v-if="error.show">{{error.message}}</div>
            <div class="form-group">
                <div class="input outlined">
                    <input @keyup.enter="login" v-model="credentials.email" id="email" class="classic" type="text" placeholder="Email">
                    <label>Email</label>
                </div>
</div>
                <div class="form-group">
                <div class="input outlined">
                    <input @keyup.enter="login" v-model="credentials.password"  class="classic" type="password" placeholder="Password">
                    <label>Password</label>
                </div>
                </div>
                <div class="spacing bottom top2">

                <button class="button contained" v-on:click="login">Login</button>
                </div>
                <button class="button outlined" v-on:click="credentials = {email: 's@s.s', password: '123456'};login()">Login as Student</button>
                <button class="button outlined" v-on:click="credentials = {email: 'c@c.c', password: '123456'};login()">Login as Company</button>
                <button class="button outlined" v-on:click="credentials = {email: 'a@a.a', password: '123456'};login()">Login as Admin</button>

                <div class="spacing bottom top2">
                <button class="button text" v-on:click="register">Register</button>
                </div>
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
                    this.$parent.read_token();
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
