<template>
    <div class="container expand">
        <div class="center small spacing bottom top2">
            <span class="font high subtitle1 ">Register</span>
        </div>
            <div class="card">

            <div class="form">

                <div class="error" v-if="error.show">{{error.message}}</div>

                <div class="form-group">
                    <div class="input outlined">
                        <input @keyup.enter="register" class="classic" v-model="user.name" type="text" required>
                        <label>Name</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input outlined">
                        <input @keyup.enter="register" class="classic" id="email" v-model="user.email" type="text" required>
                        <label>Email</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input outlined">
                        <input @keyup.enter="register" class="classic" v-model="user.password" type="password" required>
                        <label>Password</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input outlined">
                        <input @keyup.enter="register" class="classic" v-model="user.confirm_password" type="password" required>
                        <label>Confirm Password</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input outlined">
                        <input @keyup.enter="register" class="classic" v-model="user.city" type="text" required>
                        <label>City</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input outlined">
                        <input @keyup.enter="register" class="classic" v-model="user.street" type="text" required>
                        <label>Street</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input outlined">
                        <input @keyup.enter="register" class="classic" v-model="user.house_number" type="text" required>
                        <label>House number</label>
                    </div>
                </div>

                <div v-if="user.role === '1'" class="form-group">
                    <div class="input outlined">
                        <input  @keyup.enter="register" class="classic" v-model="user.school" type="text" required>
                        <label >School</label>
                    </div>
                </div>

                <div v-if="user.role === '1'" class="form-group">
                    <div class="input outlined">
                        <input @keyup.enter="register" class="classic" v-model="user.date_of_birth" type="text" required>
                        <label >Date of birth</label>
                    </div>
                </div>

                    <span v-if="user.role === '1'" class="label">Gender</span>
                    <select v-if="user.role === '1'" class="classic margin-bottom" v-model="user.gender">
                        <option value="male" selected="true">Male</option>
                        <option value="female">Female</option>
                    </select>

                <div v-if="user.role === '2'" class="form-group">
                    <div class="input outlined">
                        <input @keyup.enter="register" class="classic" v-model="user.description" type="text" required>
                        <label >Description</label>
                    </div>
                </div>



                <span class="label">Role</span>
                <select class="classic" v-model="user.role">
                <option value="1" selected="true">Student</option>
                <option value="2">Company</option>
                <option value="3">Admin</option>
                </select><br>

                <div class="place right spacing right2">
                    <button class="button text spacing right" v-on:click="login">Login</button>
                    <button class="button contained" v-on:click="register">Register</button>
                </div>
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