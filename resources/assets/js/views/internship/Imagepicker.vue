<template>
    <div>
        <input @change="imageHandler" id="image" class="w3-hide" type="file" accept="image/*">
        <template v-if="uploadedFile">
            <label for="image" class="w3-button w3-border">{{ uploadedFile.name }}</label>
            <img v-if="imageDataURL" :src="imageDataURL"/>
        </template>
        <template v-else-if="image && !uploadedFile">
            <label for="image" class="w3-button w3-border">{{ image.name }}</label>
            <img :src="image.url">
        </template>
        <label v-else for="image" class="w3-button w3-border">Select Image</label>
    </div>


</template>

<script>
    export default {
        name: "Imagepicker",
        data () {
            return {
                uploadedFile: null,
                imageDataURL: null,
            }
        }
    }
</script>

<style scoped>

</style>