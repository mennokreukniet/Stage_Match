<template>
    <div id="main">
        <div class="card">
            <span class="title">Admin </span>
            <div class="error" v-if="error.show">{{error.message}}</div>
            <div class="success" v-if="success.show">{{success.message}}</div>
            <span class="title">Skills</span>


            <div class="skills">
                <span v-if="this.skills.length === 0">There are no skills, add one!</span>
                <template v-for="(value, index) in this.skills" class="skill">
                    <div v-bind:key="value.id" class="skill">
                        <button v-on:click="remove(value.id, index)">remove</button>    
                        <button v-on:click="edit(value.id)">edit</button>    
                        <span>{{value.name}}</span>
                    </div>
                </template>
            </div>
    <br><br>
            <span class="title">Create Skill</span>
            <input v-model="new_skill" type="text">
            <br>
            <button v-on:click="create()">Create skill</button>
        </div>
    </div>    
</template>

<script>
import Http from '../../core/http';

export default {
    name: "admin",
    created () {
        new Http().get(`admin/skill`).then(res => {this.skills = res.data.result})
    },
    data() {
        return {
            skills: [],
            new_skill: "",
            error: {
                show: false,
                message: ""
            },
            success: {
                show: false,
                message: ""
            },
        }
    },
    methods: {
        remove (id, index)  {
            this.error.show = this.success.show = false;
            if (!confirm("This action deletes all skill entries which might exist on a user")) return;
            new Http().delete(`admin/skill/${id}`).then(res => {
                this.skills.splice(index, 1);
                this.success = {
                    show: true,
                    message: `Removed skill`
                }
            })
        },

        edit (id) {
            this.error.show = this.success.show = false;
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
                        this.success = {
                            show: true,
                            message: `Skill "${this.skills[i].name}" edited to "${name}"`
                        }
                        this.skills[i].name = name;
                        break;
                    }
                }
            }).catch(err => {
                this.error = {
                    show: true,
                    message: "There is already a skill with this name"
                }
            })
        },

        create () {
            this.error.show = this.success.show = false;
            if (name === "") {
                this.error = {
                    show: true,
                    message: `Please enter a name`
                }

                return;
            } 

            new Http().post(`admin/skill`, { name: this.new_skill }).then(res => {
                this.skills.push(res.data.result[0]);
                this.new_skill = "";
                this.success = {
                    show: true,
                    message: "Skill created"
                }
            }).catch(err => {
                this.error = {
                    show: true,
                    message: "There is already a skill with this name"
                }
            })
        }
    }
}
</script>
