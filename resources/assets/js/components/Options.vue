<template>
    <span :class="{locked: show_options}">
      <button v-on:click="open" class="button icon small absolute options"><i class="material-icons">more_vert</i></button>
        <div class="vertical-menu" v-if="show_options" style="right: 16px; top: 16px;">
            <slot :close="close"></slot>
        </div>
    </span>
</template>

<script>
export default {
    name: 'options',
    data() {
        return {
            show_options: false,
            scrim: document.getElementById("scrim"),
            listener: () => { this.close(); this.scrim.classList.add("hidden"); }
        }
    },
    methods: {
        open(event) {
          // this.left = event.clientY+"px";
          if (this.scrim === null) this.scrim = document.getElementById("scrim")
          this.scrim.classList.remove("hidden");
          this.show_options = true;
          this.scrim.addEventListener("click", this.listener);
        },
        close() {
            this.show_options = false;
            this.scrim.classList.add("hidden");
            this.scrim.removeEventListener("click", this.listener);
        }
    },
};
</script>