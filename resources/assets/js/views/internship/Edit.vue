<template>
    <div>
        <prompt
            v-if="showDeletePrompt"
            @confirm="destroy()"
            @close="showDeletePrompt = false"
            :title="'Confirm Deletion'"
            :body="'Delete the internship \'' + internship.title + '\'?'"
        />
        <div class="card">
            <span class="title">Edit internship</span>
            <div class="error" v-if="error.show">{{error.message}}</div>
            <div class="success" v-if="success.show">{{success.message}}</div>

            <div class="form">
                <span class="label">Mentor</span>
                <input v-model="internship.mentor" class="classic" type="text">
                <span class="label">Title</span>
                <input v-model="internship.title" class="classic" type="text">
                <span class="label">Body</span>
                <textarea v-model="internship.body" class="w3-input w3-border" type="text" rows="8"></textarea>
                <span class="label">Start datum</span>
                <input v-model="internship.start_date" class="classic" type="date">
                <span class="label">Eind datum</span>
                <input v-model="internship.end_date" class="classic" type="date">

                <button class="w3-button w3-blue" @click="update">Edit</button>
                <button class="w3-button w3-red w3-right" @click="showDeletePrompt = true">Delete</button>
            </div>
        </div>
    </div>    
</template>

<script>
import Http from '../../core/http';
import Prompt from '../../components/MyPrompt'

export default {
    components: {
        Prompt
    },
    data() {
        return {
            showDeletePrompt: false,
            internship: {},
            error: {
                show: false,
                message: ""
            },
            success: {
                show: false,
                message: ""
            } 
        }
    },
    beforeCreate() {
        console.log(this.$root);
        new Http().get(this.$route.path.replace('/', '')).then(res => {
            this.internship = res.data;
        })
    },
    methods: {
        destroy() {
            new Http().delete(this.$route.path.replace('/', '')).then(() => {
                this.$router.push('/internship');
                this.$notify({
                    type: 'error',
                    text: `Internship '${this.internship.title}' successfully deleted`
                });
            });

        },
        update() {
            new Http().put(this.$route.path.replace('/', ''), this.internship).then(data => {
                this.$router.push('/internship');
                this.$notify({
                    type: 'success',
                    text: `Internship '${this.internship.title}' successfully updated`
                });
            }).catch(error =>{
                //console.log(error.response.data.errors);
                this.error = {
                    show: true,
                    message: error.response.data.errors
                }
            })
        }
    }
}
</script>
