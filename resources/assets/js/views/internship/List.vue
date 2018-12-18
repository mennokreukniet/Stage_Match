<template>
<div>

    <modal v-show="modal_remove.render" :modal="modal_remove" @close="modal_remove.render = false">
        <div slot="title">You are about to remove an internship</div>
        <div slot="content">Are you sure you want to remove the internship titled "{{remove.title}}"</div>
        <div slot="actions" slot-scope="{ close }">
            <button v-on:click="close" class="button text">Close</button>
            <button v-on:click="remove_internship" class="button text">Remove</button>
        </div>
    </modal>

    <modal v-if="modal_internship.render" :modal="modal_internship" @close="modal_internship.render = false">
        <div slot="title">Manage internship</div>
        <div slot="content">
            <internship-form :submitForm="is_submitted" :id="internship_id" @submit="show_status"/>
        </div>
        <div slot="actions" slot-scope="{ close }">
            <button v-on:click="close" class="button text">Close</button>
            <button v-on:click="submit" class="button text">Apply</button>
        </div>
    </modal>

    <modal v-show="modal_status.render" v-bind:modal="modal_status" @close="modal_status.render = false">
        <div slot="title">{{status.title}}</div>
        <div slot="content">{{status.content}}</div>
        <div slot="actions" slot-scope="{ close }">
            <button v-on:click="close" class="button text">Close</button>
        </div>
    </modal>

    <div class="container"> 

        <div class="center small spacing top2">
            <button @click="render_internship_modal()" class="button contained">Create Internship</button>

        </div>

        <div class="card image elevated" style="position: relative" v-for="internship in internships" :key="internship.id"> 
            <div class="header">
                <img v-if="internship.image" :src="internship.image.url" class="header"/>
            </div>

            <div class="content">
                <options class="options right">
                    <template slot-scope="{close}">
                            <div class="item" @click="close();render_internship_modal(internship.id)">Edit</div>
                        <div class="item" @click="close();open_remove(internship)">Delete</div>
                    </template>
                </options>
                <div class="font h6 high">{{ internship.title }}</div>
                <div class="font body2 spacing bottom2">{{ internship.mentor }} ({{ internship.start_date | formatDate }} - {{ internship.end_date | formatDate }})</div>
                <div class="font body1">{{ internship.body }}</div>
            </div>
        </div>

        <div class="center small">
            <pagination :meta="pagination" @pageChange="load"/>
        </div>
    </div>
</div>

</template>

<script>
    import http from '@/core/http';
    import Modal from '@/components/Modal';
    import Options from '@/components/Options';
    import Pagination from '@/components/Pagination';
    import InternshipForm from '@/views/internship/InternshipForm';
    import Skillpicker from '@/views/internship/Skillpicker';

export default {
    components: {
        Pagination,
        Options,
        Modal,
        InternshipForm,
        Skillpicker
    },
    name: "list_internship",
    data() {
        return {
            pagination: {},
            internships: [],
            internship_id: null,
            is_submitted: false,
            remove: {},
            status: {},
            type: 1,
            modal_remove: {
                render: false
            },
            modal_internship: {
                render: false,
                safe_exit: true,
                size: "huge"
            },
            modal_status: {
                render: false
            }
        }
    },
    methods: {
        submit () {
            this.is_submitted = true;
        },
        render_internship_modal(id) {
            this.internship_id = id;
            this.modal_internship.render = true;
        },
        show_status(message) {
            this.load();
            this.modal_internship.render = false;
            this.modal_status.render = true;
            this.status = {
                title: `Internship successfully submitted`,
                content: message
            }
        },
        open_remove(remove) {
            this.remove = remove;
            this.modal_remove.render = true;
        },

        open_edit(edit, type) {
            this.edit = edit;
            this.type = type;
            this.modal_internship.render = true;
        },

        remove_internship() {
            const index = this.internships.indexOf(this.remove);
            
            http.delete(`internship/${this.remove.id}`).then(response => {
                // this.$notify({text: response.data.message, type: 'warn'});
                // this.$router.back();
                this.internships.splice(index, 1);
                this.modal_remove.render = false;
                this.modal_status.render = true;
                this.status = {
                    title: `Internship removed`,
                    content: response.data.message
                }
            });
        },

        load: function (page = 1) {
            http.get("internship?page=" + page).then(response => {
                this.internships = response.data.data;
                this.pagination = response.data.meta;
            });
        }
    },
    created () {
        this.load();
    }
}
</script>