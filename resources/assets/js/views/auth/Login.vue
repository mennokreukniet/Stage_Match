<template>
    <div class="container expand">
        <div class="center small spacing bottom top2">
            <span class="font high subtitle1 ">Login</span>
        </div>
        <div class="card">
            <div class="form">
                <div class="error" v-if="error.show">{{error.message}}</div>
            <div class="form-group">
                <div class="input outlined">
                    <input @keyup.enter="login" v-model="credentials.email" id="email" class="classic" type="text" required>
                    <label>Email</label>
                </div>
</div>
                <div class="form-group">
                <div class="input outlined">
                    <input @keyup.enter="login" v-model="credentials.password"  class="classic" type="password" required>
                    <label>Password</label>
                </div>
                </div>
                <div class="spacing bottom top2 right2 place right">
                    <button class="button text spacing right" v-on:click="register">Register</button>
                    <button class="button contained" v-on:click="login">Login</button>
                </div>

                <div class="place right spacing right2" v-if="development">
                    <button class="button outlined spacing right" v-on:click="credentials = {email: 's@s.s', password: '123456'};login()">Login as Student</button>
                    <button class="button outlined spacing right" v-on:click="credentials = {email: 'c@c.c', password: '123456'};login()">Login as Company</button>
                    <button class="button outlined" v-on:click="credentials = {email: 'a@a.a', password: '123456'};login()">Login as Admin</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import http from '@/core/http';
import Auth from '@/controllers/auth';
import { environment } from '@/config';
export default {
    name: "login",
    data () {
        return {
            development: environment === "dev" ? true : false,
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
            Auth.login(this.credentials);
        },

        register() {
            this.$router.push({ name: "register" })  
        }
    }
}
</script>
