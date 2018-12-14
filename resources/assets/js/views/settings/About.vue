<template>
    <div>
        <div  v-if="!show_easteregg" class="container">
            <div class="center">
                <div style="user-select: none;">
                    <div v-on:click="activate_easteregg" class="hover" style="padding: 16px;">
                        <div class="font high subtitle1">Version</div>
                        <div class="font body1">{{version}} <span v-if="this.clicks > 5">- Click {{10 - clicks}} more time(s)!</span></div>
                    </div>
                    
                    <div class="divider"></div>
                    
                    <div class="hover" style="padding: 16px;">
                        <div class="font high subtitle1">Environment</div>
                        <div class="font body1">{{environment}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div v-on:click="show_easteregg = false; audio.pause();" v-if="show_easteregg" style="z-index: 1000;position: absolute; top: 0; left: 0; width: 100%; height: 100%;" class="easteregg">
            <div style="display: inline-block;width: 711px;position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%)" >
                <img src="https://media.giphy.com/media/TeBpzQZRaBIC4/giphy.gif">
                <img src="https://media.giphy.com/media/TeBpzQZRaBIC4/giphy.gif">
                <img src="https://media.giphy.com/media/TeBpzQZRaBIC4/giphy.gif">	
            </div>  
        </div>
    </div>
</template>

<script>
    import { version, environment } from '../../config';
    export default { 
        name: 'about', 
        data() {
            return {
                version: "",
                environment: "",
                show_easteregg: false,
                clicks: 0,
                audio: new Audio(`${window.location.origin}/eg.mp3`)
            }
        },
        created() {
            this.version = version;
            this.environment = environment;
        },
        methods: {
            activate_easteregg: function () {
                if (this.clicks === 9) {
                    this.show_easteregg = true;
                    this.clicks = 0;
                    this.audio.currentTime=2;
                    this.audio.play();
                }
                this.clicks++;
            }
        }
    }
</script>

<style> 
.easteregg{
        background: url("https://66.media.tumblr.com/0afb013e99bddc8307f4ebdc75b8b1bd/tumblr_n40zbgcx2D1slwdxuo1_500.gif");
    }
    .easteregg:hover {
		cursor: url(http://cur.cursors-4u.net/nature/nat-2/nat120.cur), progress !important;
	}
    </style>