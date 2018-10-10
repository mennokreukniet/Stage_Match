<template>
  <div class="margin-bottom" v-bind:class="status.type">{{status.message}}</div>
</template>

<script>
  export default {
    name: 'status',
    props: ["status"],
    methods: {
      close() {
        this.$emit('close');
      }
    },
  };
</script>