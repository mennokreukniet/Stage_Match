<template>
    <div>

        <paginate :meta="pagination" @input="load"/>

        <router-link :to="'/internship/' + internship.id" v-for="internship in internships" :key="internship.id"
             tag="div" class="card"
        >
            <img v-if="internship.image" :src="internship.image.url" class="right"/>
            <h4>{{ internship.title }}</h4>
            <p>{{ internship.mentor}}</p>
            <p>{{ internship.body }}</p>
            <p>{{ internship.start_date }} - {{ internship.end_date }}</p>
        </router-link>

        <paginate :meta="pagination" @input="load"/>

    </div>
</template>
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

<script>
import Http from '../../core/http';
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
            new Http().get("internship?page=" + (page || 1)).then(response => {
                this.internships = response.data.data;
                delete response.data.data;
                this.pagination = response.data;
                this.$parent.page = this.pagination.current_page;
            });
        }
    },
    created() {
        this.load();
    }
}
</script>
