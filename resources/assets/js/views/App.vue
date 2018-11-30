
<template>
    <div>
        <div id="scrim" class="scrim transparent hidden"></div>
        <nav id="nav" v-if="show_menu">
            <div class="fab float"></div>
            <div id="navContainer">
                <div class="navBar">
                    <button v-on:click="toggle_menu" class="button icon">
                        <i class="material-icons">menu</i>
                    </button>
                </div>
                <div id="insetContainer">
                    <svg mlns="http://www.w3.org/2000/svg" height="56" width="82">
                    <mask id="mskInset">
                        <rect x="0" y="0" width="82" height="56" fill="white"/>
                        <circle id="insetCircle" cx="41" cy="0" r="36"/>
                        <path id="insetLeftWing" d="M0 0 Q5 0 5 5 L 5 0 L 0 0"/>
                        <path id="insetRightWing" d="M82 0 Q77 0 77 5 L 77 0 L 82 0"/>
                    </mask>
                    <rect x="-5" y="0" fill="#2196F3" width="92" height="56" mask="url(#mskInset)" />
                </svg>
                </div>
                <div id="nav-right" class="navBar"></div>
            </div>
        </nav> 

        <div v-on:click="toggle_menu" v-if="navigation_drawer && show_menu" id="scrim"></div>

        <div v-if="show_menu" id="navigation-drawer" >
            <button class="fab"> <i class="material-icons">home</i> hey</button>
            <template v-for="item in this.menu_items">
                <router-link v-if="item.location !== undefined && item.role === undefined ? true : auth.role == item.role" v-bind:key="item.name" tag="button" class="button navigation" v-bind:to="item.location">
                    <i class="material-icons">{{item.icon}}</i>
                    <span>{{item.name}}</span>
                </router-link>

                <!-- <template v-if="item.children !== undefined && item.location === undefined && item.role === undefined ? true : auth.role == item.role" >
                    <button v-on:click="item.expanded === false ? item.expanded = true : item.expanded = false" v-bind:key="item.name" class="button navigation" >
                        <i class="material-icons menu">{{item.expanded === true ? "arrow_drop_down" : "arrow_right" }}</i>
                        <i class="material-icons">{{item.icon}}</i>
                        <span>{{item.name}}</span>
                    </button>
                    <div v-bind:key="item.name" v-if="item.children !== undefined && item.expanded === true">
                        <template v-for="child in item.children">
                            <router-link v-bind:key="child.name" tag="button"  class="button navigation child" v-bind:to="child.location">{{child.name}}</router-link>
                        </template>
                        <div class="divider"></div>
                    </div>
                </template> -->
            </template>
        </div>
            
        <router-view></router-view>
    </div>
</template>

<script>
import { roles, environment } from '../config';
    export default { 
        name: 'main-app',
        data() {
            return {
                auth: {},
                show_menu: true,
                menu_items: [
                    {
                        name: "Home",
                        icon: "home",
                        location: "/main"
                    },
                    {
                        name: "Internships",
                        icon: "assignment_ind",
                        location: "/internship",
                        role: roles.company
                    },
                    {
                        name: "Settings",
                        icon: "settingss",
                        location: "/settings"
                    },
                    {
                        name: "Admin",
                        icon: "security",
                        role: roles.admin,
                        location: "/admin/skills",
                        expanded: false,
                        children: [
                            {
                                name: "Skills",
                                location: "/admin/skills"
                            }
                        ]
                    },
                    {
                        name: "About",
                        icon: "information",
                        location: "/about"
                    },
                    {
                        name: "Logout",
                        icon: "exit_to_app",
                        location: "/logout"
                    },

                ],
                navigation_drawer: false
            }
        },
        created() {
            if (environment === "dev") {
                this.menu_items.splice(this.menu_items.length - 1, 0, 
                    {
                        name: "Demo",
                        icon: "apps",
                        location: "/demo"
                    }
                );
            }
            this.read_token();
        },
        methods: {
            toggle_menu() {
                this.navigation_drawer = !this.navigation_drawer;
            },
            read_token() {
                
                const token = localStorage.getItem("accessToken");
                if (token !== null) {
                    this.auth = JSON.parse(atob(token.split(".")[1]));
                    this.show_menu = true;
                    return;
                }
                this.show_menu = false;
            }
        }
     }
</script>