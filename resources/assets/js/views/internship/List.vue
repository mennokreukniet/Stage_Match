<template>
<div>
    <modal v-show="modal_remove.render" v-bind:modal="modal_remove" @close="modal_remove.render = false">
        <div slot="title">You are about to remove an internship</div>
        <div slot="content">Are you sure you want to remove the internship titled "{{remove.title}}"</div>
        <div slot="actions" slot-scope="{ close }">
            <button v-on:click="close" class="button text">Close</button>
            <button v-on:click="remove_internship" class="button text">Remove</button>
        </div>
    </modal>

    <modal v-show="modal_internship.render" v-bind:modal="modal_internship" @close="modal_internship.render = false">
        <div slot="title">You are about to remove an internship</div>
        <div slot="content">Are you sure you want to remove the internship titled "{{remove.title}}"</div>
        <div slot="actions" slot-scope="{ close }">
            <button v-on:click="close" class="button text">Close</button>
            <button v-on:click="remove_internship" class="button text">Remove</button>
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
        
        <!-- <paginate :current-page="pagination.current_page" :last-page="pagination.last_page" @input="load"/> -->

        <!-- <router-link :to="'/internship/' + internship.id" v-for="internship in internships" :key="internship.id"
             tag="div" class="card"
        > -->
        <div class="card elevated" style="position: relative" v-for="internship in internships" :key="internship.id"> 
            <img v-if="internship.image" :src="internship.image.url" class="right"/>
            <options class="options right">
                <template slot-scope="{close}">
                    <router-link :to="'/internship/' + internship.id" tag="div" class="item">Edit</router-link>
                    <div class="item" v-on:click="close();open_remove(internship)">Delete</div>
                </template>
            </options>
            <div class="font h6 high">{{ internship.title }}</div>
            <div class="font body2 spacing bottom2">{{ internship.mentor }} ({{ internship.start_date | formatDate }} - {{ internship.end_date | formatDate }})</div>
            <div class="font body1">{{ internship.body }}</div>
            <p></p>
            
        </div>
            
        <!-- </router-link> -->

        <div class="center small">
            <pagination :meta="pagination" :current-index="currentIndex" @pageChange="load" @fillerClick="currentIndex = $event"/>
        </div>
    </div>
</div>

</template>

<script>
    import http from '@/core/http';
    import Modal from '../../components/Modal';
    import Options from '../../components/Options';
    import Pagination from '../../components/Pagination';

export default {
    components: {
        Pagination,
        Options,
        Modal
    },
    name: "list_internship",
    data() {
        return {
            pagination: {},
            internships: [],
            currentIndex: 1,
            remove: {},
            status: {},
            modal_remove: {
                render: false
            },
            modal_internship: {
                render: false
            },
            modal_status: {
                render: false
            }
        }
    },
    methods: {
        open_remove(remove) {
            this.remove = remove;
            this.modal_remove.render = true;
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
                    content: `Internship with title "${this.remove.title}" has been removed`
                }
            });
        },

        load: function (page) {
            page = page || this.$parent.page;
            http.get("internship?page=" + (page || 1)).then(response => {
                this.internships = response.data.data;
                delete response.data.data;
                this.pagination = response.data;
                this.$parent.page = this.pagination.current_page;
            });
        }
    },
    created () {
        this.load();
    },
    updated () {
        if (this.pagination.current_page > this.pagination.last_page)
            this.load(this.pagination.last_page);
    }
}
</script>