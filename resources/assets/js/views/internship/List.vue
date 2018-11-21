<template>
    <div>

        <paginate :current-page="pagination.current_page" :last-page="pagination.last_page" @input="load"/>

        <router-link :to="'/internship/' + internship.id" v-for="internship in internships" :key="internship.id"
             tag="div" class="card"
        >
            <img v-if="internship.image" :src="internship.image.url" class="right"/>
            <h4>{{ internship.title }}</h4>
            <p>{{ internship.mentor }}</p>
            <p>{{ internship.body }}</p>
            <p>{{ internship.start_date }} - {{ internship.end_date }}</p>
        </router-link>

        <paginate :meta="pagination" @input="load"/>

    </div>
</template>

<script>
    import axios from 'axios';

    const HTTP = axios.create({
        baseURL: window.location.origin + '/api/',
        headers: {
            Authorization: `Bearer ${localStorage.getItem("accessToken")}`
        }
    });
    import Paginate from './Paginate';

export default {
    components: {
        Paginate,
    },
    name: "list_internship",
    data() {
        return {
            pagination: {},
            internships: []
        }
    },
    methods: {
        load: function (page) {
            page = page || this.$parent.page;
            HTTP.get("internship?page=" + (page || 1)).then(response => {
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

<style scoped>
    .card:hover {
        box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
        cursor: pointer;
    }
    .card {
        overflow: auto;
    }
    .right {
        float: right;
        width: 50%;
    }
</style scoped>
