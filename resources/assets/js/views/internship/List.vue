<template>
    <div>
        <div class="card">
            <span class="title">Internships</span>
        </div>
    </div>    
</template>

<script>
import Http from '../../core/http';

export default {
    name: "list_internship",
    data() {
        return {
            internships: []
        }
    },
    methods: {
        create() {
            new Http().get("internship").then(data => {
                this.internships = data.result;
            })
        }
    }
}
</script>
