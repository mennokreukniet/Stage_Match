<template>
    <div id="main">
       This is the index <br>Version: 0.01 (ÜBER ALPHA)

       <button v-on:click="admin">Admin</button>
    </div>    
</template>

<script>
export default {
    name: "index",
    methods: {
        admin() {
            this.$router.push("admin")
        }
    }
}
</script>

<style>

</style>
