<template>
    <div>
        <modal v-show="settings.render" v-bind:modal="settings" @close="settings.render = false">
            <div slot="title">Personal Information</div>
            <div slot="content">
                <div class="form-group">
                    <div class="input outlined half">
                        <input v-bind:value="edited_user.name" required/>
                        <label>Name</label>
                        <span>Helper!</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input outlined">
                        <input v-bind:value="edited_user.email" required/>
                        <label>E-Mail</label>
                        <span>Helper!</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input outlined" style="flex: 3;">
                        <input v-bind:value="edited_user.street" required/>
                        <label>Street</label>
                        <span>Helper!</span>
                    </div>

                    <div class="input outlined">
                        <input v-bind:value="edited_user.house_number" required/>
                        <label>House Number</label>
                        <span>Helper!</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input outlined">
                        <input v-bind:value="edited_user.city" required/>
                        <label>City</label>
                        <span>Helper!</span>
                    </div>
                </div>
            </div>
            <div slot="actions" slot-scope="{ close }">
                <button v-on:click="close" class="button text">Cancel</button>
                <button v-on:click="edit" class="button text">Save</button>
            </div>
        </modal>

        <modal v-show="skills.render" v-bind:modal="skills" @close="skills.render = false">
            <div slot="title">Manage skills</div>
            <div slot="content">
                <div class="search">
                    <input v-model="search_skills" type="text" placeholder="Search through your skills or add one">
                    <div class="results">
                        <div class="list">
                            <template v-for="(key, value) in search_skills_result">
                                <div v-if="key.owns" class="item hover">{{key.name}}</div>
                                <div v-if="!key.owns" v-on:click="add_skill(key.id)" class="item hover">Add {{key.name}} to skills</div>
                            </template>
                        </div>
                    </div>
                </div>
                
                <div class="list">
                    <template v-for="(key, value) in user.skills">
                        <div class="item hover" v-bind:key = "value">
                            <span>
                            <span style="position: relative; top:7px"> {{key.name}}</span>
                            <span style="float: right">
                                <span v-on:click="set_level(value, key.id, 1)" :class="{active: key.level === 1}" class="chip choice">Medium</span>
                                <span v-on:click="set_level(value, key.id, 2)" :class="{active: key.level === 2}" class="chip choice">Good</span>
                                <span v-on:click="set_level(value, key.id, 3)" :class="{active: key.level === 3}" class="chip choice">Expert</span>
                            </span>
                            </span>
                            <options class="options special" >
                                <template slot-scope="{close}">
                                    <div class="item" v-on:click="delete_skill(key.id, value);close();">Remove</div>
                                </template>
                            </options>
                        </div>
                        
                    </template>
                </div>
            </div>
            <div slot="actions" slot-scope="{ close }">
                <button v-on:click="close" class="button text">Close</button>
            </div>
        </modal>

        <div class="container">
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

            <template v-if="user.role === '1'">
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
            </template>

        
        </div>  
    </div>
</template>

<script>
import Http from '../../core/http';

import Modal from '../../components/Modal.vue';
import Options from '../../components/Options';
export default {
    name: "settings",
    components: {
        Modal,
        Options
    },
    created() {
        new Http().get("user").then(res => {
            this.user = res.data.user;
            this.edited_user = this.user;
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
                role: 0,
                skills: []
            },

            edited_user: {},
            ignore: [
                "id",
                "theme",
                "student_id",
                "skills",
                "role"
            ],
            search_skills: "",
            search_skills_result: [],

            settings: {
                render: false,
                size: "huge",
                safe_exit: true
            },
            skills: {
                render: false,
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
        search_skills: function (skillname) {
            // if (skillname === "") return this.skills.show = false;

            new Http().get(`user/skill/${skillname}`).then(res => {
                
                const result = res.data.result;
                for (let result_i = 0; result_i < result.length; result_i++) {
                    for (let skill_i = 0; skill_i < this.user.skills.length; skill_i++) {
                        // console.log(this.user.skills[skill_i].id)
                        if (result[result_i].id == this.user.skills[skill_i].id) {
                            console.log(result[result_i].id, this.user.skills[skill_i].id)
                            result[result_i]["owns"] = true;
                            break;
                        } else {
                            result[result_i]["owns"] = false;
                        }
                    }
                }
                this.search_skills_result = result;
                console.log(result);
                // if (res.data.result.length < 1) {
                //     // return this.skills.show = false;
                // }
                // this.skills = {
                //     show: true,
                //     list: res.data.result
                // }
                
            });
        }
    },
    methods: {
        set_level(index, id, level) {
            new Http().post("user/skill/level", { id: id, level: level}).then(res => {
                this.user.skills[index].level = level;
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


            new Http().post(`user/edit`, this.edited_user)
            .then(res => {
                localStorage.setItem("accessToken", res.data.token);
                this.status_list.settings = {
                    render: true,
                    type: "success",
                    message: `Settings saved!`
                }
            }).catch(err => {
                this.status_list.settings = {
                    render: true,
                    type: "error",
                    message: `Something went wrong`
                }
            });
        },

        add_skill(id) {
            this.search_skills_result = [];
            new Http().post("user/skill", {id: id}).then(res => {
                const result = res.data.result;
                result.level = 1;
                this.user.skills.push(result);
                this.search_skills = "";
            })
        },

        delete_skill(id, index) {
            new Http().delete(`user/skill/${id}`).then(res => {
                // this.skills.show = false;
                // this.skill = "";
                // this.status_list.skills = {
                //     render: true,
                //     type: "success",
                //     message: `skill removed!`
                // }

                this.user.skills.splice(index, 1);
            })
        }
    }
}
</script>
