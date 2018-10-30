<template>
    <div>
        <div class="card">
            <span class="title">Internships</span>
            <div v-for="internship in internships">
                <h3>{{ internship.mentor }}</h3>
                <p>{{ internship.start }} - {{ internship.end }}</p>
                <br>
            </div>
        </div>
    </div>    
</template>

<script>
import Http from '../../core/http';

export default {
    name: "list_internship",
    data() {
        return {
            internships: [{mentor:'mentor',start:'start',end:'end'}]
        }
    },
    methods: {},
    created() {
        new Http().get("internship").then(response => {
            console.log(response.data.data);
            this.internships = response.data.data;
        })
    }
}
</script>
