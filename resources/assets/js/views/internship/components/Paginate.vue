<template>
    <div class="pagination is-centered is-rounded">

        <a :disabled="currentPage === 1" class="pagination-previous"
           @click="$emit('pageChange', currentPage - 1)">Vorige</a>

        <a :disabled="currentPage === lastPage" class="pagination-next"
           @click="$emit('pageChange', currentPage + 1)">Volgende</a>

        <ul class="pagination-list">
            <li v-for="page in pages">

                <a v-if="page.isFiller" class="pagination-link is-primary" @click="$emit('input', page.index)">…</a>

                <a v-else :class="['pagination-link', {'is-current': page.isCurrent}]"
                   @click="$emit('pageChange', page.index)">{{ page.index }}</a>

            </li>
        </ul>

    </div>
</template>

<script>
    /**
     * ^1 2 3 4 .. 9
     * 1 2 3 ^4 .. 9
     * 1 .. ^5 6 7 8 9
     * 1 .. ^5 6 7 8 .. 10
     * 1 .. ^9 10
     * 1 .. ^9 10 11 12 .. 35
     * 1 .. ^13 14 15 16 .. 35
     *
     /**
     * laravel pagination handler
     */
    export default {
        name: "paginate",
        props: {
            meta: Object,
            value: Number
        },
        computed: {
            lastPage: function () {
                return this.meta.last_page;
            },
            currentPage: function () {
                return this.lastPage < this.meta.current_page
                    ? this.lastPage
                    : this.meta.current_page;
            },

            pages: function () {// [1,'..',4,5,6,'..',12]
                let index = this.value || this.currentPage,
                    total = this.lastPage,
                    offset = 1,

                    start = index - offset > 0
                        ? index - offset
                        : 1,

                    end = index + offset < total
                        ? index + offset
                        : total,

                    pages = [];

                if (start > 1) pages.push({index: 1, isCurrent: 1 === this.currentPage});

                if (start > 2) pages.push({isFiller: true, index: start - 2});

                for (let i = start; i <= end; i++)
                    pages.push({index: i, isCurrent: i === this.currentPage});

                if (end < total - 1) pages.push({isFiller: true, index: end + 2});

                if (end < total) pages.push({index: total, isCurrent: total === this.currentPage});

                return pages;
            }
        }
    }
</script>
<style lang="sass" scoped>
    @import "~bulma/sass/components/pagination"
    .pagination-ellipsis
        pointer-events: all

</style>