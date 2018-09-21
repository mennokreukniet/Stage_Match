<template>
    <router-view></router-view>
</template>

<style>
    html, body { height: 100%;
     }
body {
  overflow: hidden;
}

#login, #register {
    width: 100vw;
    display: flex;
    flex-direction: column;
    justify-content: center
}

.container {
    width: 100%;
}

span.title {
    letter-spacing: 2px;
        display: block;
        font-size: 23px;
        margin-bottom: 40px;
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
    transition: 400ms;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(0,0,0,0.08);
}


#loading {
    position: relative;
    animation: move_down 1s 1, move_up 1s 4s 1;
    display: none;
}

.dots {
    position: absolute;
    transform: translate(-50%, 0);
    left: 50%;
    top: 30px;
    z-index: 1000;
}

.dot {
    top: 0;
    display: inline-block;
    margin-right: 15px;
    left: 0;
    width:15px;
    height: 15px;
    z-index: 999; 
    position: relative;
    border-radius: 15px;
    background: #018786;
}

.active {
    z-index: 1000;
    border-radius: 10px;
    width: 15px;
    position: absolute;
    background: #03DAC6;
    animation: dot_size 3.5s infinite, dot_move 3.5s infinite;
}

@keyframes move_down {
    0% {
        top: -190px;
    }

    100% {
        top: 0px;
    }
}

@keyframes move_up {
    0% {
        top: 0px;
    }

    100% {
        top: -190px;
    }
}

@keyframes dot_size {
    0% {
        width: 15px;
    }

    12.5% {
        width: 50px;
    }

    25% {
        width: 15px;
    }
    
    37.5% {
        width: 50px;
    }

    50% {
        width: 15px;
    }

    62.5% {
        width: 50px;
    }

    75% {
        width: 15px;
    }

    87.5% {
        width: 117px;
    }

    100% {
        width: 15px;
    }
}

@keyframes dot_move {

    0% {
        margin-left: 0px;
    }

    12.5% {
        margin-left: 0px;
    }

    25% {
        margin-left: 35px;
    }
    
    37.5% {
        margin-left: 35px;
    }

    50% {
        margin-left: 68px;
    }

    62.5% {
        margin-left: 68px;
    }

    75% {
        margin-left: 102px;
    }

    87.5% {
        margin-left: 0px;
    }

    100% {
        margin-left: 0px;
    }
}

.dot:last-child {
    margin-right: 0;
}

.ocean { 
  height: 30px;
  width: 100%;
  padding: 0 20px;
  position:absolute;
  top:-8px;
  left:-8px;
  background: #202124;
  transform: rotate(180deg);
}

.wave {
  background: url('../../../svg/wave.svg') repeat-x; 
  position: absolute;
  top: -195px;
  width: 6400px;
  height: 198px;
  animation: wave 7s cubic-bezier( 0.36, 0.45, 0.63, 0.53) infinite;
  transform: translate3d(0, 0, 0);
}

.wave:nth-of-type(2) {
  top: -175px;
  animation: wave 7s cubic-bezier( 0.36, 0.45, 0.63, 0.53) -.125s infinite, swell 7s ease -1.25s infinite;
  opacity: 1;
}

@keyframes wave {
  0% {
    margin-left: 0;
  }
  100% {
    margin-left: -1600px;
  }
}

@keyframes swell {
  0%, 100% {
    transform: translate3d(0,-25px,0);
  }
  50% {
    transform: translate3d(0,5px,0);
  }
}
</style>



<script>
    export default { name: 'auth' }
</script>