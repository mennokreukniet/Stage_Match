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
        <nav v-if="$route.name !== 'auth'">
            <div class="bg">
                <div class="circle"></div>
                <div class="menu"></div>
                <div class="menu2"></div>
            </div>

            <div class="buttons">
                <div class="left">
                    <button class="item"><i class="material-icons">menu</i></button>
                </div>
                <router-link to="/">
                    <button class="circle"><i class="material-icons">filter_none</i></button>
                </router-link>
                <div class="right">
                    <router-link to="/settings"><button v-on:click="alert('Please implement me')" class="item"><i class="material-icons">settings</i></button></router-link>
                </div>
                
                
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
    transform: translate(-50%, -34%);
    height: 80px;
    width: 80px;
    border-radius: 80px;
    border: solid 1px #bebebe;
}

nav > div.bg > div.menu {
    background: white;
    width: 100%;
    height: 50px;
    border: solid 1px #bebebe;
}

nav > div.bg > div.menu2 {
    background: white;
    width: 100%;
    height: 50.5px;
    position: absolute;
    left: 0;
    bottom: 0;
}

nav > div.buttons {
    position: relative;
    width: 100%;
}

nav > div.buttons button.circle {
    width: 60px;
    border: none;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(0,0,0,0.08);
    height: 60px;
    background: #03DAC6;
    border-radius: 60px;
    position: absolute;
    left: 50%;
    color:white;
    padding-top: 5px;
    transform: translate(-50%, -114%);
    transition: 400ms;
}


nav > div.buttons > button.circle:hover {
    transition: 400ms;
    box-shadow: 0 3px 8px 0 rgba(0,0,0,0.2), 0 0 0 1px rgba(0,0,0,0.08);
}

nav > div.buttons > button.circle:focus {
    background: #02c4b2;
}

nav > div.buttons > div.left {
    display: flex;
    width: calc(50% - 40px);
    position: absolute;
    bottom: 0px;
    left: 0;
    height: 50px;
    display: flex;
}

nav > div.buttons > div.right {
    display: flex;
    width: calc(50% - 40px);
    position: absolute;
    bottom: 0px;
    right: 0;
    height: 50px;
    display: flex;
}


nav > div.buttons > div.left button, 
nav > div.buttons > div.right button {
    border: none;
    background: none;
    position: absolute;
    left: 0;
    top:0;
    color: #03DAC6;
    width: 100%;
    height: 100%;
    flex: 1;
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