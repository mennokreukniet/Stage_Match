<template>

    <div class="modal w3-animate-opacity" style="display:block">
        <div class="modal-content">

            <header class="w3-container w3-blue-grey">
                <h2>{{ title }}</h2>
                <span @click="$emit('close')" class="w3-button w3-display-topright">&times;</span>
            </header>

            <div class="w3-container">
                <p v-if="body" style="padding-bottom: 16px; padding-top: 16px;">{{ body }}</p>
                <input v-if="inputModel" v-model="inputModel" type="text"/>
            </div>

            <footer class="w3-container w3-blue-grey">
                <button class="w3-button w3-red" type="button" @click="$emit('confirm')">{{ confirmButtonText }}</button>
                <button class="w3-button" type="button" @click="$emit('close')">{{ cancelButtonText }}</button>
            </footer>

        </div>

    </div>

</template>
<style scoped>
    .modal {
        z-index: 3;
        padding-top: 40%;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }
    .modal-content {
        margin: auto;
        background-color: #fff;
        position: relative;
        width: 600px;
    }
</style>
<script>
    export default {
        name: 'modal',
        props: {
            title: {
                type: String,
                default: 'Are you sure?'
            },
            body: {
                type: String
            },
            confirmButtonText: {
                type: String,
                default: 'Ok'
            },
            cancelButtonText: {
                type: String,
                default: 'Cancel'
            },
            inputModel: {
                type: Object
            },
        },
    };
</script>