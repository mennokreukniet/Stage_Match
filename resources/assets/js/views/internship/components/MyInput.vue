<template>
    <div class="form-group">
        <div v-if="type !== 'imagepicker'" class="input outlined" v-bind:class="{ double: type === 'textarea' }">
            
            <textarea v-if="type === 'textarea'"
                      :name="name" @input="$emit('input', $event.target.value)"
                      v-bind:value="value"
                      :required="required"></textarea>

            <input v-else
                   :name="name" :value="value" @input="$emit('input', $event.target.value)"
                   :required="required" :type="type"/>

            <label>{{ label + (required ? " *  ": "  ") }}</label>

            <ul class="spacing bottom2" v-if="errors">
                <li v-for="error in errors" :key="error">{{ error }}<br></li>
            </ul>
        </div>

        <div v-else="" class="imagepicker">
            <imagepicker @change="$emit('input', $event)" :name="name" :image="value"/>
            <ul class="spacing bottom2" v-if="errors">
                <li v-for="error in errors" :key="error">{{ error }}<br></li>
            </ul>
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