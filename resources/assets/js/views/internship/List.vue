<template>
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
</template>

<script>
    import http from '@/core/http';
    import Options from '../../components/Options';
    import Pagination from '../../components/Pagination';

export default {
    components: {
        Pagination,
        Options
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