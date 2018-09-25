<template>
  <div id="login">
      <div id="loading">
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
      <span class="title">Login</span>
      <input v-model="email" type="text" placeholder="Email">
      <input v-model="password" type="password" placeholder="Password">
      <button class="classic" v-on:click="login">Login</button>

      <br><br>
      <button class="classic" v-on:click="register">Register</button>
  </div>
</template>

<script>
const axios = require("axios");

export default {
  data () {
    return {
      email: "",
      password: ""
    }
  },

  methods: {
    login() {
<<<<<<< Updated upstream
      axios.post(`http://localhost:8000/api/auth/login`, { "email": this.email, "password": this.password }).then(res => {
=======
      if (this.email === "" || this.password === "") {
        return alert("Fields cannot be empty");
      }

      this.loading = true;
      axios.post(`${window.location.origin}/api/auth/login`, { "email": this.email, "password": this.password }).then(res => {
>>>>>>> Stashed changes
        localStorage.setItem("accessToken", res.data.token);
        this.$router.push('../') 
      }).catch(err => {
        console.log(err);
        this.loading = false;
      })
    },

    register() {
      this.$router.push('register') 
    }
  }
}
</script>
