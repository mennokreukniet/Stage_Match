<template>

    <div id="main">

        <prompt v-show="prompt.edit.render" v-bind:title="prompt.edit.title" @value="edit"/>

        <div class="card">
            <span class="title">Admin</span>
        </div>

        <div class="card">
            <span class="title">Create Skill</span>

            <status v-show="status.create.render" v-bind:status="status.create"/>

            <input class="classic margin-bottom" placeholder="New skill name" v-model="new_skill" type="text">
            <button class="classic" v-on:click="create()">Create skill</button>
        </div>


        <div class="card">
            <span class="title">Skills ({{this.skills.length}})</span>

            <status v-show="status.skills.render" v-bind:status="status.create"/>

            <div class="skills">
                <input class="classic" v-model="search" type="text" placeholder="Zoeken naar vaardigheden">
                   
                <div v-if="this.skills.length === 0" class="neutral margin-top">There are no skills, add one!</div>
                
                <template v-for="(value, index) in this.skills">
                    <div v-bind:key="value.id" class="skill">
                        <span>{{value.name}}</span>
                        <button class="edit" @click="isModalVisible = true">
                            <i class="material-icons">edit</i>
                        </button>    
                        <button class="remove" v-on:click="remove(value.id, index)">
                            <i class="material-icons">delete</i>
                        </button>    
                    </div>
                </template>
            </div>
        </div>
    </div>    
</template>

<script>
import Http from '../../core/http';

import Prompt from '../../components/Prompt.vue';
import Status from '../../components/Status.vue';

export default {
    name: "admin",
    components: {
      Prompt,
      Status
    },
    created () {
        this.get_all_skills();  
    },
    data() {
        return {
            skills: [],
            new_skill: "",
            search: "",
            prompt: {
                edit: {
                    render: true,
                    title: "Hey"
                }
            },
            status: {
                create: {
                    render: false,
                    message: "Hey",
                    type: "success"
                },
                skills: {
                    render: false,
                    message: "Hey",
                    type: "success"
                }
            },
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
        get_all_skills () {
            new Http().get(`admin/skill`).then(res => {this.skills = res.data.result})
        },
        remove (id, index)  {
            if (!confirm("This action deletes all skill entries which might exist on a user")) return;
            new Http().delete(`admin/skill/${id}`).then(res => {
                this.skills.splice(index, 1);
                
            })
        },
        edit (id) {
            console.log(id);
            return;
            
            const name = prompt("How should this skill be named?");
            
            if (name === "") {
                this.error = {
                    show: true,
                    message: `Please enter a name`
                }

                return;
            } 

            new Http().put(`admin/skill/${id}`, { name: name }).then(res => {
                for (let i = 0; i < this.skills.length; i++) {
                    if(this.skills[i].id === id) {
                        
                        this.skills[i].name = name;
                        break;
                    }
                }
            }).catch(err => {
                
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
