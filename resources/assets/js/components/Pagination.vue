<template>
   <div class="pagination">

       <button :disabled="currentPage === 1" class="button text lock left" @click="$emit('pageChange', currentPage - 1)">Vorige</button>

       <ul class="pagination list">
           <span v-for="page in pages" :key="page">

               <button :key="index" v-if="page.isFiller" class="button text" disabled @click="$emit('fillerClick', page.index)">...</button>

               <button v-else :class="['button text', {'active': page.isCurrent}]" @click="$emit('pageChange', page.index)">{{ page.index }}</button>

           </span>
       </ul>

       <button :disabled="currentPage === lastPage" class="button text" @click="$emit('pageChange', currentPage + 1)">Volgende</button>
   </div>
</template>

<script>
   /**
    * laravel pagination handler
    */
   export default {
       name: "paginate",
       props: {
           meta: Object,
           currentIndex: Number
       },
       methods: {
           handlePageClick(index) {

           }
       },
       computed: {
           currentPage: function () {
               return this.meta.current_page < this.lastPage ? this.meta.current_page : this.lastPage;
           },
           lastPage: function () {
               return this.meta.last_page;
           },
           pages: function () {// [1,'..',4,5,6,'..',12]
               let index = this.currentIndex || this.currentPage,
                   offset = 1,
                   total = this.lastPage,

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