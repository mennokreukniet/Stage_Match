<template>
    <div class="w3-center">
        <a v-if="currentPage !== 1" @click="prevPage()" class="w3-button">&laquo;</a>

        <template v-for="index in lastPage">
            <a @click="handleClick(index)" :class="['w3-button', index === currentPage ? 'w3-purple': '']">{{ index }}</a>
        </template>

        <a v-if="currentPage !== lastPage" @click="nextPage()" class="w3-button">&raquo;</a>

    </div>
</template>

<script>
    /**
     * laravel pagination handler
     */
    export default {
        name: "paginate",
        props: {
            currentPage: Number,
            lastPage: Number
        },
        methods: {
            handleClick: function (index) {
                this.$emit('input', index);
            },
            prevPage: function() {
                this.handleClick(this.currentPage - 1);
            },
            nextPage: function() {
                this.handleClick(this.currentPage + 1);
            },
        }
    }
</script>

<style scoped>

</style>