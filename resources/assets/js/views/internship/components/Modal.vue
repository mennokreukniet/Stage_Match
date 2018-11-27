<template>

    <div class="modal w3-animate-opacity">
        <div class="modal-content">

            <header class="w3-container w3-blue-grey">
                <h2>{{ title }}</h2>
                <span @click="$emit('close')" class="w3-button w3-display-topright">&times;</span>
            </header>

            <div class="w3-container w3-section">
                <p v-if="body">{{ body }}</p>
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
        background-color: rgba(0, 0, 0, 0.4);
    }
    .modal-content {
        background-color: #fff;
        width: 600px;

        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
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