<template>
    <div>
        <modal v-show="modal.render" v-bind:modal="modal" @close="modal.render = false" @value="edit">
            <div slot="title">I am a title!</div>
            <div slot="content">I am the content</div>
            <div slot="actions" slot-scope="{ close }">
                <button class="button text">Another button</button>
                <button v-on:click="close" class="button text">Close</button>
            </div>
        </modal>

        <div class="container">
            <div class="center">
                
                <div style="padding: 16px 16px;">
                    <div class="font h5">Buttons</div>
                    
                    <button class="button text" >Text button</button>
                    <button class="button outlined">Outlined button</button>
                    <button class="button contained">Contained button</button>
                    
                </div>

                <div class="divider"></div>

                <div style="padding: 16px 32px;">
                    <div class="font h5">Modals</div>

                    <button class="button outlined" v-on:click="modal.render = true; modal.size = `small`; modal.safe_exit = false">Open Small Modal</button>
                    <button class="button outlined" v-on:click="modal.render = true; modal.size = ``; modal.safe_exit = false">Open Regular Modal</button>
                    <button class="button outlined" v-on:click="modal.render = true; modal.size = `huge`; modal.safe_exit = false">Open Huge Modal</button>
                    <button class="button outlined" v-on:click="modal.render = true; modal.size = `huge`; modal.safe_exit = true">Open Modal with Safe Exit</button>
                </div>

                <div class="divider"></div>

                <div style="padding: 16px 32px; max-width: 360px">
                    <div class="font h5">Inputs</div>

                    <div class="input outlined">
                        <input required/>
                        <label>Firstname</label>
                        <span>Helper!</span>
                    </div>
                    <br>
                    <div class="input filled">
                        <input required/>
                        <label>Firstname</label>
                        <span>Helper!</span>
                    </div>
                </div>

                <div class="divider"></div>
                

                <div style="padding: 16px 32px;">
                    <div class="font h5">Chips</div>

                    <span class="chip choice">Choice 1</span>
                    <span class="chip choice active">Choice 2 (active)</span>
                    <span class="chip choice">Choice 3</span>
                </div>
                <div class="divider"></div>

                <div style="padding: 16px 32px;">
                    <div class="font h5">List</div>

                    <div class="list">
                        <div class="item">item 1</div>
                        <div class="item">item 2</div>
                        <div class="item">item 3</div>
                        <div class="item">item 4</div>
                        <div class="item">item 5</div>
                        <div class="item">item 6</div>
                    </div>
                </div>
                <div class="divider"></div>
            </div>
        </div>
    </div>
        
</template>

<script>
    import Modal from '../../components/Modal.vue';

    export default { 
        name: 'demo', 
        data() {
            return {
                modal: {
                    render: false,
                    size: "", //optional
                    safe_exit: false //optional
                }
            }
        },
        components: {Modal},
        created() {


        },
        methods: {

        }
    }
</script>