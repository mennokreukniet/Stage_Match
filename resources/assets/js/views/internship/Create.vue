<template>
    <internship-form>
        <span class="title">Create internship</span>
        <div class="error" v-if="error.show">{{error.message}}</div>
    </internship-form>
</template>

<script>
import Http from '../../core/http';
import Form from './InternshipForm';

export default {
    components: {
        'internship-form': Form
    },
    data() {
        return {
            error: {
                show: false,
                message: ""
            }
        }
    },
    methods: {
        create: function (internship) {
            new Http().post("internship", internship).then(data => {
                this.$router.push('/internship');
                this.$notify({
                    type: 'success',
                    text: `Internship '${this.internship.title}' successfully created`
                });
            }, reject =>{
                //console.log(reject.response.data.errors);
                this.error = {
                    show: true,
                    message: reject.response.data.errors
                }
            })
        }
    }
}
</script>
