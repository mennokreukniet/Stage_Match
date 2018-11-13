<template>
    <internship-form :internship="internship" :http-url="`internship/${internship.id}`" http-method="put">
        <span class="title">Edit internship</span>
    </internship-form>
</template>

<script>
    import Http from '../../core/http';
    import InternshipForm from './InternshipForm';

    export default {
        components: {
            InternshipForm,
        },
        data() {
            return {
                internship: {}
            }
        },
        created() {
            new Http().get(this.$route.path.replace('/', '')).then(resolve => {
                this.internship = resolve.data;
            })
        }
    }
</script>
