<template>
    <div>
        <input :name="name" id="images" class="w3-hide" type="file" accept="image/*"
               @change="$emit('change', uploadedFile = $event.target.files[0])">
        <template v-if="uploadedFile">
            <label for="images" class="w3-button w3-border">{{ uploadedFile.name }}</label>
            <img v-if="imageDataURL" :src="imageDataURL"/>
        </template>
        <template v-else-if="image && !uploadedFile">
            <label for="images" class="w3-button w3-border">{{ image.name }}</label>
            <img :src="image.url">
        </template>
        <label v-else for="images" class="w3-button w3-border">Select Image</label>
    </div>


</template>

<script>
    export default {
        name: "Imagepicker",
        props: {
            image: undefined, // {image: {name: 'image.jpeg', url: 'storage/images/A12JruJAI94104JFA.jpeg'} } || file
            name: String //
        },
        data () {
            return {
                uploadedFile: null,
                imageDataURL: null,
            }
        },
        watch: {
            uploadedFile: function (value) {
                if (value instanceof File) {
                    let reader = new FileReader();
                    reader.readAsDataURL(this.uploadedFile);
                    reader.addEventListener('load', () => this.imageDataURL = reader.result);
                }
                this.imageDataURL = null;
            }
        }
    }
</script>

<style scoped>

</style>