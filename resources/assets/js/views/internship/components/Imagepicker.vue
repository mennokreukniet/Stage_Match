<template>
    <div>
        <input :name="name" :id="name" type="file" accept="image/*"
               @change="handleFile">

        <img v-if="uploadedFileDataURL" :src="uploadedFileDataURL" style="max-width: 100%;"/>

        <template v-else-if="image && !uploadedFile"> <!-- if image already exists in database -->
            <p>{{ image.name }}</p>
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
                uploadedFile: null,
                uploadedFileDataURL: null,
            }
        },
        methods: {
            handleFile: function (event) {
                this.uploadedFile = event.target.files[0];
                this.$emit('change', this.uploadedFile);
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