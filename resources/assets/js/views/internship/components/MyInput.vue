<template>
    <div class="form-group">
        <div class="input outlined">

            <textarea v-if="type === 'textarea'"
                      :name="name" @input="$emit('input', $event.target.value)"
                      :required="required"
                      rows="8">{{ value }}</textarea>

            <imagepicker v-else-if="type === 'imagepicker'"
                         @change="$emit('input', $event)" :name="name" :image="value"/>

            <input v-else
                   :name="name" :value="value" @input="$emit('input', $event.target.value)"
                   :required="required" :type="type"/>

            <ul v-if="errors">
                <li v-for="error in errors">{{ error }}</li>
            </ul>

            <label>{{ label + (required ? " *": "") }}</label>

        </div>
    </div>
</template>

<script>
import Imagepicker from "@/views/internship/components/Imagepicker";

export default {
    name: "MyInput",
    components: {
        Imagepicker
    },
    props: {
        value: undefined, //image picker
        name: String,
        errors: Array,
        label: String,
        required: {
            type: Boolean,
            default: false
        },
        type: {
            type: String,
            default: 'text'
        }
    },
}
</script>