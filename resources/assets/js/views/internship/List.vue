<template>
    <div>

        <div class="w3-center">
            <paginate
                    v-model="page"
                    :click-handler="paginateHandler"
                    :page-count="internships.last_page || 1"
                    :page-range="5"

                    :no-li-surround="true"
                    :hide-prev-next="true"

                    :container-class="'w3-bar'"
                    :page-link-class="'w3-button'"
                    :active-class="'w3-purple'"

                    :prev-text="'&laquo;'"
                    :prev-link-class="'w3-button'"
                    :next-text="'&raquo;'"
                    :next-link-class="'w3-button'"
            />
        </div>

        <div class="card w3-hover-blue"
             style="cursor:pointer"
             v-for="internship in internships.data"
             @click="clickHandler(internship.id)">

            <h4>{{ internship.title }}</h4>
            <p>{{ internship.mentor}}</p>
            <p>{{ internship.body }}</p>
            <p>{{ internship.start_date }} - {{ internship.end_date }}</p>
        </div>

    </div>
</template>

<script>
import Http from '../../core/http';
import Paginate from 'vuejs-paginate';

export default {
    components: {
        Paginate
    },
    name: "list_internship",
    data() {
        return {
            page: 1,
            internships: {},
        }
    },
    methods: {
        clickHandler: function (id) {
            this.$router.push('/internship/' + id);
        },
        paginateHandler: function (e) {
            this.load(e);
        },
        load: function(page = 1) {
            new Http().get("internship?page=" + page).then(response => {
                this.internships = response.data;

            })
        }
    },
    created() {
        this.load();
    }
}
</script>
