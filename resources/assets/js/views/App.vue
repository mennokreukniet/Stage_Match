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

        <!-- <button id="menu">lol</button> -->
        <nav>
            <div class="bg">
                <div class="circle"></div>
                <div class="circle2"></div>
                <div class="menu"></div>
            </div>
            
            <!-- <button class="side">test</button>
            <button class="home">create</button>
            <button class="side">lol</button> -->
        </nav>
    </div>
</template>

<style>
* {
margin: 0; padding: 0;
}

html {
  background: #eeeeee;
  font-family: 'Roboto', sans-serif;
}

input {
    flex:1;
    margin: 10px;
    border-radius: 5px;
    height: 20px;
    font-size: 15px;
    letter-spacing: 1.2px;
    padding: 10px 15px;
    border: solid 1px #eee;
    transition: 200ms;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(0,0,0,0.08);
}

input:hover, button:hover {
    box-shadow: 0 3px 8px 0 rgba(0,0,0,0.2), 0 0 0 1px rgba(0,0,0,0.08);
    transition: 200ms;
}

input:focus, button:focus {
    box-shadow: 0 3px 8px 0 rgba(0,0,0,0.2), 0 0 0 1px rgba(0,0,0,0.08);
    outline: 0;
}

button.classic {
    border-radius: 5px;
    height: 40px;
    margin: 10px;
    flex: 1;
    font-size: 17px;
    color: white;
    letter-spacing: 2px;
    background: #23a6d5;
    border: none;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(0,0,0,0.08);
    transition: 400ms;
}

nav {
    position: fixed;
    width: 100%;
    bottom: 0;
}

nav > div.bg {
    position: relative;
}

nav > div.bg > .circle {
    background: white;
    position: absolute;
    left: 50%;
    transform: translate(-50%, -50%);
    height: 60px;
    width: 60px;
    border-radius: 60px;
    border: solid 1px #bebebe;
}

nav > div.bg > .circle2 {
    background: white;
    position: absolute;
    left: 50%;
    transform: translate(-50%, -30%);
    height: 60px;
    width: 60px;
    border-radius: 60px;
}

nav > div.bg > div.menu {
    background: white;
    width: 100%;
    height: 40px;
    border: solid 1px #bebebe;
}

/* nav > button.side {
    flex: 1;
}

nav > button.home {
    height: 60px;
    border-radius: 60px;
    width: 60px;
} */

/* div#menu {
    width: 60px; 
    height: 60px;
    position: fixed;
    right: 20px;
    bottom: 20px;
} */
</style>

<script>
    export default { name: 'main-app' }
</script>