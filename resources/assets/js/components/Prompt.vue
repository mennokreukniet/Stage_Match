<template>
  <transition name="custom-classes-transition" enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
    <div class="modal-layer">
        <div class="card">
            {{title}}
            <input class="classic" v-model="value" type="text"/> 
            <button type="button" class="btn-close" @click="send" aria-label="Close modal" >x</button>
        </div>
    </div>
  </transition>
</template>

<script>
  export default {
    name: 'prompt',
    props: ['title'],
    data () {
      return {
        value: ""
      }
    },
    methods: {
      close() {
        this.$emit('close');
      },
      send() {
        this.$emit('value', this.value);
      }
    },
  };
</script>