<template>
    <div>
        <modal v-show="settings.render" v-bind:modal="settings" @close="settings.render = false">
            <div slot="title">Personal Information</div>
            <div slot="content">
                <div class="form-group">
                    <div class="input outlined half">
                        <input v-bind:value="user.name" required/>
                        <label>Firstname</label>
                        <span>Helper!</span>
                    </div>

                    <div class="input outlined half">
                        <input v-bind:value="user.lastname" required/>
                        <label>Lastname</label>
                        <span>Helper!</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input outlined">
                        <input v-bind:value="user.email" required/>
                        <label>E-Mail</label>
                        <span>Helper!</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input outlined" style="flex: 3;">
                        <input v-bind:value="user.street" required/>
                        <label>Street</label>
                        <span>Helper!</span>
                    </div>

                    <div class="input outlined">
                        <input v-bind:value="user.house_number" required/>
                        <label>House Number</label>
                        <span>Helper!</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input outlined">
                        <input v-bind:value="user.city" required/>
                        <label>City</label>
                        <span>Helper!</span>
                    </div>
                </div>
            </div>
            <div slot="actions" slot-scope="{ close }">
                <button v-on:click="close" class="button text">Cancel</button>
                <button class="button text">Save</button>
            </div>
        </modal>

        <modal v-show="skills.render" v-bind:modal="skills" @close="skills.render = false">
            <div slot="title">Manage skills</div>
            <div slot="content">
                <input type="text">
                <template v-for="(key, value) in user.skills">
                    <div v-bind:key = "value">
                        {{key.name}}
                        <div class="selection-group inline right">
                            <span class="chip choice active">Medium</span>
                            <span class="chip choice">Good</span>
                            <span class="chip choice">Expert</span>
                        </div>
                    </div>
                    
                </template>
            </div>
            <div slot="actions" slot-scope="{ close }">
                <button v-on:click="close" class="button text">Close</button>
            </div>
        </modal>
        <div class="container">

        
                
                <!-- <status v-show="status_list.create.render" v-bind:status="status_list.create"/> -->
        <div class="center">
            <!-- <template v-for="(key, value) in user">
                <div v-bind:key = "value">
                    <div class="font high subtitle1">{{value}}</div>
                    <div class="font body1">{{key}}</div>
                    <div class="divider"></div>
                </div> 
            </template> -->

        </div>


            <div class="center small spacing bottom top2">
                <span class="font high subtitle1 ">Personal Information</span>
            </div>
                <div class="card elevated">


                    <template v-for="(key, value) in user">
                        <div v-if="ignore.indexOf(value) === -1" v-bind:key = "value">
                            <div class="font body2">{{value}}</div>
                            <div class="font high body1">{{key}}</div>
                            <br>
                        </div>
                    </template>

                    <button class="button outlined" v-on:click="settings.render = true;">Edit Settings</button>

                </div>
            <div class="center small spacing bottom top2">
                <span class="font high subtitle1 ">Skills</span>
            </div>
            <div class="card elevated">
                <div class="list">
                <template v-for="(key, value) in user.skills">
                    <div v-bind:key = "value">

                        <div class="item">{{key.name}}</div>


                    </div>
                </template>
                </div>
                <button class="button outlined" v-on:click="skills.render = true;">Manage skills</button>
            </div>


        
        </div>  
    </div>
</template>

<script>
import Http from '../../core/http';

import Modal from '../../components/Modal.vue';

export default {
    name: "settings",
    components: {
        Modal
    },
    created() {
        new Http().get("user").then(res => {
            const temp = this.user.skills
            this.user = res.data.user;
            this.user.skills = temp;
        })
    },
    data() {
        return {
            user: {
                name: "",
                email: "",
                city: "",
                house_number: "",
                street: "",
                theme: "1",
                skills: [
                    {
                        id: 1,
                        name: "JavaScript",
                        level: 2
                    },
                    {
                        id: 2,
                        name: "C++",
                        level: 3
                    }
                ]
            },

            ignore: [
                "id",
                "theme",
                "student_id",
                "skills",
                "role"
            ],

            settings: {
                render: false,
                size: "huge",
                safe_exit: true
            },
            skills: {
                render: true,
                size: "huge"
            }
            // skills_: [],
            // skill: "",
            // skills: {
            //     show: false,
            //     list: []
            // },
            // status_list: {
            //     settings: {
            //         render: false,
            //         message: "",
            //         type: ""
            //     },
            //     skills: {
            //         render: false,
            //         message: "",
            //         type: ""
            //     }
            // }
        }
    },
    watch: {
        email: function (email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (!re.test(email.toLowerCase())) {
                document.getElementById("email").classList.remove("valid");
                document.getElementById("email").classList.add("invalid");
            } else {
                document.getElementById("email").classList.remove("invalid");
                document.getElementById("email").classList.add("valid");
            }
        },
        skill: function (skillname) {
            if (skillname === "") return this.skills.show = false;

            new Http().get(`user/skill/${skillname}`).then(res => {
                if (res.data.result.length < 1) {
                    return this.skills.show = false;
                }
                this.skills = {
                    show: true,
                    list: res.data.result
                }
                
            });
        }
    },
    methods: {
        set_level(index, id, level) {
            new Http().post("user/skill/level", { id: id, level: level}).then(res => {
                this.skills_[index].level = level;
            })
        },

        edit() {
            
            // this.status_list.settings.render = false;
            
            // var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            // if (this.user.name === "" || this.user.email === "") { 
            //     this.status_list.settings = {
            //         render: true,
            //         type: "error",
            //         message: `Inputs can't be empty`
            //     }

            //     return;
            // }

            // if (!re.test(this.user.email.toLowerCase())) {
            //     this.status_list.settings = {
            //         render: true,
            //         type: "error",
            //         message: `Invalid Email`
            //     }

            //     return;
            // }


            // new Http().post(`user/edit`, this.user)
            // .then(res => {
            //     localStorage.setItem("accessToken", res.data.token);
            //     this.status_list.settings = {
            //         render: true,
            //         type: "success",
            //         message: `Settings saved!`
            //     }
            // }).catch(err => {
            //     this.status_list.settings = {
            //         render: true,
            //         type: "error",
            //         message: `Something went wrong`
            //     }
            // });
        },
        add_skill(id) {
            new Http().post(`user/skill/add`, {id:id} ).then(res => {
                this.skills.show = false;
                this.skill = "";
                this.status_list.skills = {
                    render: true,
                    type: "success",
                    message: `${res.data.result.name} added!`
                }

                this.skills_.push(res.data.result);
            }, reject => {
                this.status_list.skills = {
                    render: true,
                    type: "error",
                    message: reject.response.data.message
                }
            })
        },
        delete_skill(id, index) {
            new Http().delete(`user/skill/${id}`).then(res => {
                this.skills.show = false;
                this.skill = "";
                this.status_list.skills = {
                    render: true,
                    type: "success",
                    message: `skill removed!`
                }

                this.skills_.splice(index, 1);
            })
        }
    }
}
</script>
