<template>
  <div id="register">
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
        <span class="label">Role</span>
        <select v-model="user.role">
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