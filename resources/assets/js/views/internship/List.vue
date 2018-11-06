<template>
    <div>
        <div class="w3-center">
            <paginate
                    v-model="page"
                    :click-handler="myHandler"
                    :page-count="data.last_page"
                    :page-range="5"

                    :no-li-surround="true"
                    :hide-prev-next="true"

                    :container-class="w3-bar"
                    :page-link-class="'w3-button'"
                    :active-class="'w3-purple'"

                    :prev-text="'&laquo;'"
                    :prev-link-class="'w3-button'"
                    :next-text="'&raquo;'"
                    :next-link-class="'w3-button'"
            />
        </div>


        <div class="card" v-for="internship in internships">
            <h4 class="w3-title">{{ internship.title }}</h4>
            <p>{{ internship.mentor}}</p>
            <p>{{ internship.body }}</p>
            <p>{{ internship.start_date }} - {{ internship.end_date }}</p>
            <br>
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
            internships: [],
            data: []
        }
    },
    methods: {
        myHandler: function (e) {
            this.load(e);
        },
        load: function(page = 1) {
            new Http().get("internship?page=" + page).then(response => {
                this.data = response.data;
                this.internships = this.data.data;
            })
        }
    },
    created() {
        this.load();
    }
}
</script>
