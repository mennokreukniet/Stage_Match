<template>
    <div class="container">
        <div class="main">
            <div class="title">
                <i class="material-icons">settings</i>
                <span class="title">Account Settings</span>
            </div>

            
            <!-- <status v-show="status_list.create.render" v-bind:status="status_list.create"/> -->

            <div class="card">
                <span class="title">General Settings</span>

                <status v-show="status_list.settings.render" v-bind:status="status_list.settings"/> 

                <div class="form">
                    <span class="label">Name</span>
                    <input v-model="user.name" class="classic" type="text" placeholder="Name">

                    <span class="label">Email</span>
                    <input id="email" v-model="user.email" class="classic" type="text" placeholder="E-Mail">

                    <span class="label">City</span>
                    <input v-model="user.city" class="classic" type="text" placeholder="City">

                    <span class="label">House number</span>
                    <input v-model="user.house_number" class="classic" type="number" placeholder="House number">

                    <span class="label">Street</span>
                    <input v-model="user.street" class="classic" type="text" placeholder="Street">

                    <span v-if="this.$parent.auth.role === '1'" class="label">School</span>
                    <input v-if="this.$parent.auth.role === '1'" v-model="user.school" class="classic" type="text" placeholder="School">

                    <span v-if="this.$parent.auth.role === '2'" class="label">Description</span>
                    <input v-if="this.$parent.auth.role === '2'" v-model="user.description" class="classic" type="text" placeholder="Description">

                    <span class="label">Theme</span>
                    <select class="classic margin-bottom" v-model="user.theme">
                        <option value="1" selected="true">Light</option>
                        <option value="2">Dark</option>
                    </select>

                    <button class="submit" v-on:click="edit">Edit profile</button>
                </div>
            </div>

            <div  v-if="this.$parent.auth.role === '1'" class="card">
                <span class="title">Skill Management</span>
                <status v-show="status_list.skills.render" v-bind:status="status_list.skills"/> 
                <span class="title2">Add Skill</span>
                <input class="classic" type="text" placeholder="Search for skills" v-model="skill"> 
                <div v-if="skills.show" style="max-height: 200px;overflow: auto;background: #eee; width: calc(100% - 40px);margin-top:-2px;border-bottom-right-radius: 2px;border-bottom-left-radius:2px;padding: 15px 20px">
                    <template v-for="value in this.skills.list" class="skill">
                        <div v-bind:key="value.id" class="skill">
                            <button class="classic" style="display:block;margin-bottom: 5px;" v-on:click="add_skill(value.id)">{{value.name}}</button>
                        </div>
                    </template>
                </div>

                <span class="title2 margin-top">My Skills</span>
                <div class="skills">  
                    <div v-if="this.skills_.length === 0" class="neutral">There are no skills, add one!</div>
                    <template v-for="(value, index) in this.skills_">
                        <div v-bind:key="value.id" class="skill settings">
                            <span>{{value.name}}</span>
                            <button v-bind:class="{ selected: value.level == '1' }" class="classic moderate" v-on:click="set_level(index, value.id, 1)">
                                Moderate
                            </button>   
                            <button v-bind:class="{ selected: value.level == '2' }" class="classic good" v-on:click="set_level(index, value.id, 2)">
                                Good
                            </button>   
                            <button v-bind:class="{ selected: value.level == '3' }" class="classic expert" v-on:click="set_level(index, value.id, 3)">
                                Expert
                            </button>
                            <button v-on:click="delete_skill(value.id, index)">
                                Delete
                            </button>
                        </div>
                    </template>
                </div>
            </div>

            <div class="card">
                <span class="title">Account Management</span>
                <button class="classic danger">(not working)Permanently deactivate account</button>
            </div>
        </div>  
    </div>  
</template>

<script>
import Http from '../../core/http';
import Status from '../../components/Status';

export default {
    name: "settings",
    components: {
        Status
    },
    created() {
        new Http().get("user").then(res => {
            this.user = res.data.user;
            this.skills_ = res.data.user.skills;
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
                skills: []
            },
            skills_: [],
            skill: "",
            skills: {
                show: false,
                list: []
            },
            status_list: {
                settings: {
                    render: false,
                    message: "",
                    type: ""
                },
                skills: {
                    render: false,
                    message: "",
                    type: ""
                }
            }
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
            this.status_list.settings.render = false;
            
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (this.user.name === "" || this.user.email === "") { 
                this.status_list.settings = {
                    render: true,
                    type: "error",
                    message: `Inputs can't be empty`
                }

                return;
            }

            if (!re.test(this.user.email.toLowerCase())) {
                this.status_list.settings = {
                    render: true,
                    type: "error",
                    message: `Invalid Email`
                }

                return;
            }


            new Http().post(`user/edit`, this.user)
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
            new Http().post("user/skill", {id: id}).then(res => {
                this.skills.show = false;
                this.skill = "";
                this.status_list.skills = {
                    render: true,
                    type: "success",
                    message: `${res.data.result.name} added!`
                }

                this.skills_.push(res.data.result);
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
