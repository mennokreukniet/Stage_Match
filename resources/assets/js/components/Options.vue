<template>
    <div class="modal">
        <div class="card">
            <span class="title">{{confirm.title}}</span>
            <div class="actions">
              <button class="classic" type="button" @click="send">OK</button>
              <button class="classic cancel" type="button" @click="close">Cancel</button>
            </div>
        </div>
    </div>
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