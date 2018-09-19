<template>
    <div id="main">
       This is the index <br>Version: 0.01 (ÜBER ALPHA)

       <button v-if="this.claims.role === '3'" v-on:click="admin">Admin</button>
       <br>
       <span>Current user role: {{role}} </span>

       <br><br>
       <button v-on:click="logout">Log Out</button>
    </div>    
</template>

<script>
export default {
    name: "index",
    created() {
        this.claims = JSON.parse(atob(localStorage.getItem("accessToken").split(".")[1]));
        if (this.claims.role === "1") 
            this.role = "Student"
        else if (this.claims.role === "2")
            this.role = "Company"
        else 
            this.role = "Admin"
    },
    data() {
        return {
            claims: {},
            role: ""
        }
    },
    methods: {
        admin() {
            this.$router.push("admin")
        },
        logout () {
            localStorage.clear();
            this.$router.push("/admin")
        }
    }
}
</script>

<style>

</style>
