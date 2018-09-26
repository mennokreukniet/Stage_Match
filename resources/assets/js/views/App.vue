<template>
    <div>
        <div class="container">
            <router-view></router-view>
        </div>
        <nav v-if="$route.name !== 'auth'">
            <div class="left">
                <button class="primary"><i class="material-icons">menu</i></button>
            </div>
            <div class="center">
                <router-link to="/"><button class="circle"><i class="material-icons">filter_none</i></button></router-link>
            </div>
            <div class="right">
                <router-link tag="button" to="/foo"><i class="material-icons">star</i></router-link>

                <router-link class="primary" tag="button" to="/settings"><i class="material-icons">settings</i></router-link>
                <router-link tag="button" to="/logout"><i class="material-icons">power_settings_new</i></router-link>
            </div>
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
    /* box-shadow: 0 3px 8px 0 rgba(0,0,0,0.2), 0 0 0 1px rgba(0,0,0,0.08); */
    transition: 200ms;
}

input:focus, button:focus {
    /* box-shadow: 0 3px 8px 0 rgba(0,0,0,0.2), 0 0 0 1px rgba(0,0,0,0.08); */
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
    height: 50px;
    background: white;
}

nav > div.center {
    transform: translate(-50%, -33%);
    position: absolute;
    left: 50%;
}

nav > div.center button {
    background: #03DAC6;
    border: none;
    width: 60px;
    height: 60px;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(0,0,0,0.08);
    border-radius: 60px;
    padding-top: 5px;
    color:white;
}

nav > div.left {
    display: flex;
    width: calc(50% - 40px);
    position: absolute;
    bottom: 0px;
    left: 0;
    height: 50px;
}

nav > div.right {
    display: flex;
    width: calc(50% - 40px);
    position: absolute;
    bottom: 0px;
    right: 0;
    height: 50px;
}

nav > div.left button.primary, 
nav > div.right button.primary {
    display: unset
}

nav > div.left button, 
nav > div.right button {
    border: none;
    background: none;
    position: absolute;
    left: 0;
    top:0;
    display: none;
    width: 100%;
    height: 100%;
    color: #03DAC6;
    flex: 1;
    transition: 200ms;
}

nav > div.left button:hover, 
nav > div.right button:hover {
    background: #f4f4f4;
    transition: 200ms;
}

nav > div.left button.router-link-active, 
nav > div.right button.router-link-active {
    background: #eeeeee;
}

nav > div.left button.router-link-active > i, 
nav > div.right button.router-link-active > i {
    color: #03DAC6;
}

@media only screen and (min-width: 600px) {
    nav {
        position: fixed;
        width: 80px;
        overflow: hidden;
        top: 0;
        left: 0;
        height: 100%;
        background: white;
        display: block;
        /* background: #043145; */
    }

    nav > div.left,
    nav > div.right {
        width: 50px;
        position: relative;
        top: 10px;
        left: 20px;
        height: 50px;
    }

    nav > div.right {
        height: 100%;
        margin-top: 20px;
        display: inline-block;
    }

    nav > div.center {
        order: 2;
        transform: translate(0,0);
        position: relative;
        height: 50px;
        width: 50px;
        left: 15px;
        top: 0px;
        margin-top: 20px;
    }

    nav > div.center button {
        width: 50px;
        height: 50px;
    }

    nav > div.center button i {
        font-size: 20px;
    }

    nav > div.left button, 
    nav > div.right button {
        border: none;
        background: none;
        color: #018786;
        max-width: 40px;
        position: relative;
        height: 40px;
        display: unset;
        padding-top: 3px;
        margin-bottom: 15px;
        border-radius: 40px;
    }

    nav > div.left button > i, 
    nav > div.right button > i { 
        font-size: 20px;
    }
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