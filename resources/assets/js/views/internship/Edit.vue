<template>
    <internship-form :internship="internship" :http-url="'internship/' + id" http-method="put">
        <span class="title">Edit internship</span>
    </internship-form>
</template>

<script>
    import Http from '../../core/http';
    import InternshipForm from './InternshipForm';

    export default {
        props: ['id'], //this.router.params.id
        components: {
            InternshipForm,
        },
        data() {
            return {
                internship: {}
            }
        },
        created() {
            new Http().get('internship/' + this.id).then(response => {
                this.internship = response.data;
            }, reject => {
                this.internship = reject.response.data;
            });
        }
    }
</script>
