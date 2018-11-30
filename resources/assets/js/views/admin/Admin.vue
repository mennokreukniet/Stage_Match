<template>
    <router-view></router-view>
</template>

<script>
import Http from '../../core/http';

// import Prompt from '../../components/Prompt.vue';
import Status from '../../components/Status.vue';
import Confirm from '../../components/Confirm.vue';

export default {
    name: "admin",
    components: {
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
            this.status_list.create.render = false;
            if (this.new_skill === "") {
                this.status_list.create = {
                    render: true,
                    type: "error",
                    message: "Skillname can't be empty"
                }

                return;
            } 

            new Http().post(`admin/skill`, { name: this.new_skill }).then(res => {
                this.skills.push(res.data.result[0]);
                this.new_skill = "";
                this.status_list.create = {
                    render: true,
                    type: "success",
                    message: "Skill created"
                }
            }).catch(err => {
                this.status_list.create = {
                    render: true,
                    type: "error",
                    message: "Skill with this name already exists"
                }
            })
        }
    }
}
</script>
template