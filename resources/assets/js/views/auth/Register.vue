<template>
  <div id="register">
    <div v-if="loading" id="loading">
          <div class="dots">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
          </div>
        <div class="ocean">
            <div class="wave"></div>
            <div class="wave"></div>  
        </div>
    </div>
    <span class="title">Register</span>
    <input @keyup.enter="register" v-model="name" type="text" placeholder="Name">
    <input @keyup.enter="register" v-model="email" type="text" placeholder="Email">
    <input @keyup.enter="register" v-model="password" type="password" placeholder="Password">
    <input @keyup.enter="register" v-model="confirm_password" type="password" placeholder="Confirm Password">
    <select v-model="role">
      <option value="1" selected="true">Student</option>
      <option value="2">Company</option>
      <option value="3">Admin</option>
    </select>
    <button class="classic" v-on:click="register">Register</button>
  <br><br>
    <button class="classic" v-on:click="login">Login</button>
  </div>
  
</template>

<script>
const axios = require("axios");

export default {
  data () {
    return {
      name: "",
      email: "",
      password: "",
      confirm_password: "",
      role: "1",
      loading: false
    }
  },

  methods: {
    register() {
      if (this.name === "" || this.email === "" || this.password === "" || this.confirm_password === "" || this.role === "") {
        console.log(this.name, this.email, this.password, this.confirm_password, this.role)
        return alert("Not all fields are filled in");
      }

      if (this.password !== this.confirm_password) {
        return alert("Passwords are not the same!");
      }
      this.loading = true;
      axios.post(`${window.location.origin}/api/auth/register`, { "name": this.name, "email": this.email, "password": this.password, "role": this.role }).then(res => {
        localStorage.setItem("accessToken", res.data.token);
        this.$router.push('../') 
      }).catch(err => {
        console.log(err);
        this.loading = false;
      })
    },

    login() {
      this.$router.push('login') 
    }
  }
}
</script>