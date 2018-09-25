<template>
    <div id="main">
       <div class="card">
           <span class="title">Index</span>
            <strong>Version:</strong> 0.01 (ÜBER ALPHA)

            <button v-if="this.claims.role === '3'" v-on:click="admin">Admin</button>
            <br>
            <span><strong>Current user role:</strong> {{role}} </span>
            <br><br>
            <button v-on:click="logout">Log Out</button>
       </div>
    </div>    
</template>

<script>
export default {
    name: "index",
    created() {
        //Read claims
        this.claims = JSON.parse(atob(localStorage.getItem("accessToken").split(".")[1]));
        
        //Set role in property
        if (this.claims.role === "1") 
            this.role = "Student"
        else if (this.claims.role === "2")
            this.role = "Company"
        else 
            this.role = "Admin"
    },
    data() {
        return {
            //Binding models
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
.card {
        background: white;
        border-radius: 20px;
        padding: 20px 30px;
        margin: 10px;
    }div.card > span.title {
        letter-spacing: 2px;
        display: block;
        font-size: 23px;
        margin-bottom: 40px;
    }
</style>
