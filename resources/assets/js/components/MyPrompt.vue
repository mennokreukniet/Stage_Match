<template>

    <div class="w3-modal" style="display:block">
        <div class="w3-modal-content">

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

<script>
    export default {
        name: 'prompt',
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