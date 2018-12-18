<template>
   <div class="pagination">

       <button :disabled="currentPage === 1" class="button text lock left" @click="$emit('pageChange', currentPage - 1)">Vorige</button>

       <div class="pagination list">
           <template v-for="page in pages">

               <button v-if="page.isFiller" class="button text" @click="currentIndex = page.index">...</button>

               <button v-else :class="['button text', {'active': page.isCurrent}]" @click="$emit('pageChange', page.index)">{{ page.index }}</button>

           </template>
       </div>

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
           meta: Object
       },
       data() {
           return {
               currentIndex: null
           }
       },
       watch: {
           currentPage: function(index) {
               this.currentIndex = index;
           },
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
           pages: function () {
               let total = this.lastPage,

                   offset = 2,
                   length = offset * 2,

                   start = this.currentIndex - offset,
                   end = this.currentIndex + offset;

               if (start < 1) {
                   start = 1;
                   end = 1 + length;
               } else if (end > total) {
                   start = total - length;
                   end = total;
               }

               let pages = [];

               if (start > 1) pages.push({index: 1, isCurrent: 1 === this.currentPage});

               if (start > 2) pages.push({isFiller: true, index: start - (1 + offset)});

               for (let i = start; i <= end; i++)
                   pages.push({index: i, isCurrent: i === this.currentPage});

               if (end < total - 1) pages.push({isFiller: true, index: end + 1 + offset});

               if (end < total) pages.push({index: total, isCurrent: total === this.currentPage});

               return pages;
           }
       }
   }
</script>