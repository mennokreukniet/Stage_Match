<template>
  <transition name="custom-classes-transition" enter-active-class="animated fadeIn" leave-active-class="animated fadeOut">
    <div class="modal">
        <div class="card">
            <span class="title">{{prompt.title}}</span>
            <input class="classic margin-bottom" v-model="value" type="text"/> 
            <button class="classic" type="button" @click="send">Edit</button>
            <button class="classic cancel" type="button" @click="close">Cancel</button>
        </div>
    </div>
  </transition>
</template>

<script>
  export default {
    name: 'prompt',
    props: ['prompt'],
    data () {
      return {
        value: ""
      }
    },
    methods: {
      close() {
        this.value = "";
        this.$emit('close');
      },
      send() {
        this.$emit('value', { value: this.value, properties: this.prompt.properties });
        this.value = "";
        this.$emit('close');
      }
    },
  };
</script>