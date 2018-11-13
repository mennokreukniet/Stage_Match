<template>
    <div class="w3-center">
        <a v-if="meta.current_page !== 1" @click="prevPage()" class="w3-button">&laquo;</a>

        <template v-for="index in meta.last_page">
            <a @click="handleClick(index)" :class="['w3-button', index === meta.current_page ? 'w3-purple': '']">{{ index }}</a>
        </template>

        <a v-if="meta.current_page !== meta.last_page" @click="nextPage()" class="w3-button">&raquo;</a>

    </div>
</template>

<script>
    /**
     * laravel pagination handler
     */
    export default {
        name: "paginate",
        props: {
            meta: {
                type: Object,
                required: true,
            }
        },
        methods: {
            handleClick: function (index) {
                this.$emit('input', index);
            },
            prevPage: function() {
                this.handleClick(this.meta.current_page - 1);
            },
            nextPage: function() {
                this.handleClick(this.meta.current_page + 1);
            },
        }
    }
</script>

<style scoped>

</style>