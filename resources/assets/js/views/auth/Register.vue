<template>
    <div class="container auth">
        <div id="register" class="main auth">
            <div class="card">
            <div class="form">
                <span class="title">Register</span>

                <div class="error" v-if="error.show">{{error.message}}</div>

                <span class="label">Name</span>
                <input @keyup.enter="register" class="classic" v-model="user.name" type="text" placeholder="Name">

                <span class="label">Email</span>
                <input @keyup.enter="register" class="classic" id="email" v-model="user.email" type="text" placeholder="Email">

                <span class="label">Password</span>
                <input @keyup.enter="register" class="classic" v-model="user.password" type="password" placeholder="Password">

                <span class="label">Confirm Password</span>
                <input @keyup.enter="register" class="classic" v-model="user.confirm_password" type="password" placeholder="Confirm Password">

                <span class="label">City</span>
                <input @keyup.enter="register" class="classic" v-model="user.city" type="text" placeholder="City">

                <span class="label">Street</span>
                <input @keyup.enter="register" class="classic" v-model="user.street" type="text" placeholder="Street">

                <span class="label">House number</span>
                <input @keyup.enter="register" class="classic" v-model="user.house_number" type="text" placeholder="House number">

                <span v-if="user.role === '1'" class="label">School</span>
                <input v-if="user.role === '1'" @keyup.enter="register" class="classic" v-model="user.school" type="text" placeholder="School">

                <span v-if="user.role === '1'" class="label">Date of birth</span>
                <input v-if="user.role === '1'" @keyup.enter="register" class="classic" v-model="user.date_of_birth" type="text" placeholder="Date of birth">

                <span v-if="user.role === '1'" class="label">Gender</span>
                <select v-if="user.role === '1'" class="classic margin-bottom" v-model="user.gender">
                <option value="male" selected="true">Male</option>
                <option value="female">Female</option>
                </select>

                <span v-if="user.role === '2'" class="label">Description</span>
                <input v-if="user.role === '2'" @keyup.enter="register" class="classic" v-model="user.description" type="text" placeholder="Description">

                <span class="label">Role</span>
                <select class="classic" v-model="user.role">
                <option value="1" selected="true">Student</option>
                <option value="2">Company</option>
                <option value="3">Admin</option>
                </select><br>
                <button class="submit" v-on:click="register">Register</button>
                <br><br>
                <button style="background: #207c7e" class="submit" v-on:click="login">Login</button>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Http from '../../core/http';

    export default {
        name: "register",
        data () {
            return {
                user: {
                    name: "",
                    email: "",
                    password: "",
                    confirm_password: "",
                    city: "",
                    street: "",
                    house_number: "",
                    school: "",
                    date_of_birth: "",
                    gender: "male",
                    description: "",
                    role: "1",
                },
                error: {
                    show: false,
                    message: ""
                }
            }
        },

        watch: {
            user: {
                handler(val){
                    if (val.email) {
                        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                        if (!re.test(val.email.toLowerCase())) {
                            document.getElementById("email").classList.remove("valid");
                            document.getElementById("email").classList.add("invalid");
                        } else {
                            document.getElementById("email").classList.remove("invalid");
                            document.getElementById("email").classList.add("valid");
                        }
                    }
                },
                deep: true
            }
        },
        methods: {
            register() {
                this.error.show = false;
                if (this.user.name === "" || this.user.email === "" || this.user.password === "" || this.user.confirm_password === "") {
                    this.error = {
                        show: true,
                        message: "Fields can not be empty"
                    }

                    return;
                }

                if (this.user.password !== this.user.confirm_password) {
                    this.error = {
                        show: true,
                        message: "Passwords dont match"
                    }

                    return;
                }

                const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

                if (!re.test(this.user.email.toLowerCase())) {
                    this.error = {
                        show: true,
                        message: "Enter a valid Email address"
                    }
                    return;
                }

                if (this.user.password.length < 6) {
                    this.error = {
                        show: true,
                        message: "Password cant be shorter than 6 chars"
                    }

                    return;
                }

                new Http().post(`auth/register`, this.user)
                    .then(res => {
                        localStorage.setItem("accessToken", res.data.token);
                        this.$parent.read_token();
                        this.$router.push({ name: "main" })
                    }).catch(err => {
                    if (err.response.data.errors.email = "The email has already been taken.") {
                        this.error = {
                            show: true,
                            message: err.response.data.errors.email
                        }
                    } else {
                        this.error = {
                            show: true,
                            message: "Broken errorlogging, can't differenciate errors for now (:"
                        }
                    }


                    return;
                })
            },

            login() {
                this.$router.push({ name: "login" })
            }
        }
    }
</script>