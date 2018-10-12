<template>
  <transition name="custom-classes-transition" enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
    <div class="modal">
        <div class="card">
            <span class="title">{{confirm.title}}</span>
            <button class="classic" type="button" @click="send">OK</button>
            <button class="classic cancel" type="button" @click="close">Cancel</button>
        </div>
    </div>
  </transition>
</template>

<script>
  export default {
    name: 'confirm',
    props: ['confirm'],
    methods: {
      close() {
        this.$emit('close');
      },
      send() {
        this.$emit('trigger', { "is_confirmed": true, properties: this.confirm.properties });
        this.$emit('close');
      }
    },
  };
</script>