<template>
    <div>
        <div class="scrim" @click="safe_close"></div>
        
        <div v-bind:class="`modal ${modal.size}`">         
            <div class="title">
                <slot name="title"></slot>
            </div>
            <div class="content">
                <slot name="content"></slot>
            </div>
            <div class="bottom">
                <slot name="actions" :close="close">
                    <button @click="close" class="button text">Close</button>
                </slot>
            </div>
        </div>

        <div v-if="safe_exit" class="scrim high"></div>
        <div v-if="safe_exit" v-bind:class="`modal high small`">         
            <div class="title">
                There are unsaved changes, are you sure you want to exit?
            </div>
            <div class="bottom">
                <button v-on:click="safe_exit = false" class="button text">Keep Editing</button>
                <button v-on:click="close" class="button text">Close</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'modal',
    props: ['modal'],
    data() {
        return {
            safe_exit: false
        }
    },
    watch: {
        modal: {
            immediate: true,
            handler: function(modal) {
                if (modal.render) {
                    document.documentElement.style.overflow = 'hidden'
                }
            },
            deep: true
        }
    },
    methods: {
        close() {
            this.safe_exit = false;
            document.documentElement.style.overflow = 'auto';
            this.$emit('close');
        },
        safe_close() {
            if (this.modal.safe_exit === true) {
                return this.safe_exit = true;
            }

            this.safe_exit = false;
            this.$emit('close');
        }
    },
};
</script>