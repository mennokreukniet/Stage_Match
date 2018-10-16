<template>
    <div class="container"> 
        <div class="main">

            <prompt v-show="prompt_list.edit.render" v-bind:prompt="prompt_list.edit" @close="prompt_list.edit.render = false" @value="edit"/>
            <confirm v-show="confirm.remove.render" v-bind:confirm="confirm.remove" @close="confirm.remove.render = false" @trigger="remove"/>

            <div class="title">
                <i class="material-icons">security</i>
                <span class="title">Admin Settings</span>
            </div>

            <div class="card">
                <span class="title">Create Skill</span>

                <status v-show="status_list.create.render" v-bind:status="status_list.create"/>

                <input class="classic margin-bottom" placeholder="New skill name" v-model="new_skill" type="text">
                <button class="classic" v-on:click="create()">Create skill</button>
            </div>


            <div class="card">
                <span class="title">Skills ({{this.skills.length}})</span>

                <div class="skills margin-top">
                    <status v-show="status_list.skills.render" v-bind:status="status_list.skills"/>

                    <input class="classic" v-model="search" type="text" placeholder="Zoeken naar vaardigheden">
                    
                    <div v-if="this.skills.length === 0" class="neutral margin-top">There are no skills, add one!</div>
                    
                    <template v-for="(value, index) in this.skills">
                        <div v-bind:key="value.id" class="skill">
                            <span>{{value.name}}</span>
                            <button class="edit" v-on:click="prompt('edit', `New name for ${value.name}`, {id: value.id, name: value.name})">
                                <i class="material-icons">edit</i>
                            </button>    
                            <button class="remove" v-on:click="confirm_box('remove', 'This action deletes all skill entries which might exist on a user', { id: value.id, index: index })">
                                <i class="material-icons">delete</i>
                            </button>    
                        </div>
                    </template>
                </div>
            </div>
        </div> 
    </div>   
</template>

<script>
import Http from '../../core/http';

import Prompt from '../../components/Prompt.vue';
import Status from '../../components/Status.vue';
import Confirm from '../../components/Confirm.vue';

export default {
    name: "admin",
    components: {
      Prompt,
      Status,
      Confirm
    },
    created () {
        this.get_all_skills();  
    },
    data() {
        return {
            skills: [],
            new_skill: "",
            search: "",
            prompt_list: {
                edit: {
                    render: false,
                    title: "",
                    properties: {}
                }
            },
            status_list: {
                create: {
                    render: false,
                    message: "",
                    type: ""
                },
                skills: {
                    render: false,
                    message: "",
                    type: ""
                }
            },
            confirm: {
                remove: {
                    render: false,
                    title: "",
                    properties: {}
                }
            }
        }
    },
    watch: {
        search (value) {
            console.log(value)
            if (value === "") {
                this.get_all_skills();
            }

            new Http().get(`user/skill/${value}`).then(res => {
                this.skills = res.data.result;
            });
        }
    },
    methods: {
        prompt(type, title, properties = {}) {
            this.prompt_list[type] = {
                render: true,
                title: title,
                properties: properties
            }
        },
        confirm_box(type, title, properties = {}) {
            this.confirm[type] = {
                render: true,
                title: title,
                properties: properties
            }
        },

        get_all_skills () {
            new Http().get(`admin/skill`).then(res => {this.skills = res.data.result})
        },

        remove (remove)  {
            this.status_list.skills.render = false;
            const name = this.skills[remove.properties.index].name;
            new Http().delete(`admin/skill/${remove.properties.id}`).then(res => {
                this.skills.splice(remove.properties.index, 1);
                this.status_list.skills = {
                            render: true,
                            message: `${name} removed`,
                            type: "success"
                        }
                })
        },

        edit (edit) {
            this.status_list.skills.render = false;

            const id = edit.properties.id;
            const name = edit.value;

            if (name === "") {
                return this.status_list.skills = {
                    render: true,
                    message: "Name can not be empty",
                    type: "error"
                }
            }

            if (edit.properties.name === name) {
                return this.status_list.skills = {
                    render: true,
                    message: `This skill is already called ${name}`,
                    type: "error"
                }
            }

            new Http().put(`admin/skill/${id}`, { name: name }).then(res => {
                for (let i = 0; i < this.skills.length; i++) {
                    if(this.skills[i].id === id) {
                        this.status_list.skills = {
                            render: true,
                            message: `${edit.properties.name} renamed to ${name}`,
                            type: "success"
                        }
                        
                        this.skills[i].name = name;
                        break;
                    }
                }
            }).catch(err => {
                this.status_list.skills = {
                    render: true,
                    message: `There already is a skill named ${name}`,
                    type: "error"
                }
            })
        },

        create () {

            if (this.new_skill === "") {
                

                return;
            } 

            new Http().post(`admin/skill`, { name: this.new_skill }).then(res => {
                this.skills.push(res.data.result[0]);
                this.new_skill = "";
               
            }).catch(err => {
                
            })
        }
    }
}
</script>
