<template>
    <div class="spacing left2">
        <div>
            <button type="button" v-on:click="trigger" class="button contained">Upload an image</button>
            <span>{{uploadedFileName}}</span>
            <template v-if="image && !uploadedFile">
                <span>{{ image.name }}</span>
            </template>
        </div>
        
        <input :name="name" :id="name" type="file" ref="fileInput" accept="image/*"
               @change="handleFile"><br>

        <img v-if="uploadedFileDataURL" :src="uploadedFileDataURL" style="max-width: 100%;"/>

        <template v-else-if="image && !uploadedFile"> <!-- if image already exists in database -->
            <img :src="image.url" style="max-width: 100%;">
        </template>

    </div>


</template>

<script>
    export default {
        name: "Imagepicker",
        props: {
            image: undefined, // {image: {name: 'image.jpeg', url: 'storage/images/A12JruJAI94104JFA.jpeg'} } || file
            name: String
        },
        data () {
            return {
                uploadedFileName: "",
                uploadedFile: null,
                uploadedFileDataURL: null,
            }
        },
        methods: {
            handleFile: function (event) {
                this.uploadedFileName = event.srcElement.files[0].name;
                this.uploadedFile = event.target.files[0];
                this.$emit('change', this.uploadedFile);
            },
            trigger () {
                this.$refs.fileInput.click();
            }
        },
        watch: {
           uploadedFile: function (value) {
               if (value instanceof File) {
                   let reader = new FileReader();
                   reader.readAsDataURL(value);
                   reader.addEventListener('load', () => { this.uploadedFileDataURL = reader.result });
               }
           }
        },
    }
</script>