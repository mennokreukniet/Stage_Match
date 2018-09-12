<template>
    <div>
        <!-- <h1>Vue Router Demo App</h1>

        <p>
            <router-link :to="{ name: 'home' }">Home</router-link> |
            <router-link :to="{ name: 'hello' }">Hello World</router-link>
        </p> -->

        <div class="container">
            <router-view></router-view>

            <!-- <div class='box'>
                <div class='wave -one'></div>
                <div class='wave -two'></div>
                <div class='wave -three'></div>

            </div> -->
        </div>
    </div>
</template>

<style>

html {
  background: #eeeeee;
  font-family: 'Roboto', sans-serif;
}
</style>

<script>
    export default { name: 'main-app' }
</script>