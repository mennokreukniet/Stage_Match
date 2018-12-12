<template>
    <div>

        <modal v-show="modal.render" v-bind:modal="modal" @close="modal.render = false" @value="edit">
            <div slot="title">Create Skill</div>
            <div slot="content">
                <div style="margin-bottom: 16px;" v-if="error !== ''">{{error}} <br></div>
                <div class="input outlined">
                    <input v-model="new_skill" required/>
                    <label>Skillname</label>
                    <span>Helper!</span>
                </div>
            </div>
            <div slot="actions" slot-scope="{ close }">
                <button v-on:click="close()" class="button text">Close</button>
                <button v-on:click="create_skill()" class="button text">Create</button>
            </div>
        </modal>

         <modal v-show="modal_edit.render" v-bind:modal="modal_edit" @close="modal_edit.render = false" @value="edit">
            <div slot="title">Edit Skill</div>
            <div slot="content">
                <div style="margin-bottom: 16px;" v-if="error !== ''">{{error}} <br></div>
                <div class="input outlined">
                    <input v-model="edit_skill" required/>
                    <label>Skillname</label>
                    <span>Helper!</span>
                </div>
            </div>
            <div slot="actions" slot-scope="{ close }">
                <button v-on:click="close()" class="button text">Close</button>
                <button v-on:click="create_skill()" class="button text">Create</button>
            </div>
        </modal>

        <modal v-show="modal_status.render" v-bind:modal="modal_status" @close="modal_status.render = false" @value="edit">
            <div slot="title">Status changed</div>
            <div slot="content">
                <div>{{modal_status.warning}}</div>
            </div>
            <div slot="actions" slot-scope="{ close }">
                <button v-on:click="close()" class="button text">Close</button>
            </div>
        </modal>

        <modal v-show="modal_remove.render" v-bind:modal="modal_remove" @close="modal_remove.render = false" @value="edit">
            <div slot="title">You are about to remove a skill</div>
            <div slot="content">
                <div>Are you sure you want to remove {{remove.name}}</div>
            </div>
            <div slot="actions" slot-scope="{ close }">
                <button v-on:click="close()" class="button text">Close</button>
                <button v-on:click="remove_skill(remove.id)" class="button text">Create</button>
            </div>
        </modal>

        <div class="container"> 
            <div class="center small">
                <button v-on:click="modal.render = true" class="button contained spacing top2">create skill</button>
                <div class="search resultless spacing top2" >
                    <input v-model="search_skills" type="text" placeholder="Search through your skills or add one">
                    
                </div>
                <div class="list" style="margin-bottom: 90px;">
                    <template v-for="(value, index) in this.skills">
                        <div v-bind:key="value.id" class="item hover">
                            <span>{{value.name}}</span>
                            <options class="options">
                                <template slot-scope="{close}">
                                    <div class="item" v-on:click="open_edit(value)">Edit</div>
                                    <div class="item" v-on:click="open_remove(value)">Delete</div>
                                </template>
                            </options>
                        </div>
                    </template>
                </div>
            </div>
        </div>   
    </div>
</template>

<script>
import http from '../../core/http';
import Options from '../../components/Options';
import Modal from '../../components/Modal.vue';

export default {
    name: "admin_skills",
    components: {
        Options,
        Modal
    },
    created () {
        this.get_all_skills();  
    },
    data() {
        return {
            skills: [],
            modal: {
                render: false
            },
            modal_remove: {
                render: false
            },
            modal_edit: {
                render: false,
                size: "",
            },
            edit_skill: {},
            error: "",
            new_skill: "",
            search_skills: "",
            remove: {}
        }
    },
    watch: {
        search (value) {
            console.log(value)
            if (value === "") {
                this.get_all_skills();
            }

            http.get(`user/skill/${value}`).then(res => {
                this.skills = res.data.result;
            });
        }
    },
    methods: {
        open_remove() {
            modal_remove.render = true;
        },

        open_edit(edit) {
            modal_edit.render = true;
            edit_skill = edit;
        },

        get_all_skills () {
            http.get(`admin/skill`).then(res => {this.skills = res.data.result})
        },

        remove (remove)  {
            alert("remove me!");
            // this.status_list.skills.render = false;
            // const name = this.skills[remove.properties.index].name;
            // new Http().delete(`admin/skill/${remove.properties.id}`).then(res => {
            //     this.skills.splice(remove.properties.index, 1);
            //     this.status_list.skills = {
            //                 render: true,
            //                 message: `${name} removed`,
            //                 type: "success"
            //             }
            //     })
        },

        edit (edit) {
            alert("edit me!");
            // this.status_list.skills.render = false;

            // const id = edit.properties.id;
            // const name = edit.value;

            // if (name === "") {
            //     return this.status_list.skills = {
            //         render: true,
            //         message: "Name can not be empty",
            //         type: "error"
            //     }
            // }

            // if (edit.properties.name === name) {
            //     return this.status_list.skills = {
            //         render: true,
            //         message: `This skill is already called ${name}`,
            //         type: "error"
            //     }
            // }

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

        create_skill () {
            if (this.new_skill === "") {
                // this.status_list.create = {
                //     render: true,
                //     type: "error",
                //     message: "Skillname can't be empty"
                // }

                alert("Skillname is empty")

                return;
            } 

            http.post(`admin/skill`, { name: this.new_skill }).then(res => {
                this.skills.push(res.data.result[0]);
                this.new_skill = "";
                this.modal.render = false;
                // this.status_list.create = {
                //     render: true,
                //     type: "success",
                //     message: "Skill created"
                // }
            }).catch(err => {
                this.error = "Skill with this name already exists"
                // this.status_list.create = {
                //     render: true,
                //     type: "error",
                //     message: "Skill with this name already exists"
                // }
            })
        }
    }
}
</script>
