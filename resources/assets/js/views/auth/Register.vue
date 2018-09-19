<template>
  <div id="register">
    <span class="title">Register</span>
    <input v-model="name" type="text" placeholder="Name">
    <input v-model="email" type="text" placeholder="Email">
    <input v-model="password" type="text" placeholder="Password">
    <input v-model="confirm_password" type="text" placeholder="Confirm Password">
    <select v-model="role">
      <option value="1" selected="true">Student</option>
      <option value="2">Company</option>
      <option value="3">Admin</option>
    </select>
    <button v-on:click="register">Register</button>
  <br><br>
    <button v-on:click="login">Login</button>
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
      role: "1"
    }
  },

  methods: {
    register() {
      console.log(1)
      if (this.name === "" || this.email === "" || this.password === "" || this.confirm_password === "" || this.role === "") {
        console.log(this.name, this.email, this.password, this.confirm_password, this.role)
        return alert("Not all fields are filled in");
      }

      if (this.password !== this.confirm_password) {
        return alert("Passwords are not the same!");
      }
      axios.post(`http://localhost:8000/api/auth/register`, { "name": this.name, "email": this.email, "password": this.password, "role": this.role }).then(res => {
        localStorage.setItem("accessToken", res.data.token);
        this.$router.push('../') 
      })
    },

    login() {
      this.$router.push('login') 
    }
  }
}
</script>