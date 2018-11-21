<template>
    <div class="form-control">
        <span class="label">{{ label }}</span>

        <textarea v-if="type === 'textarea'"
            @input="$emit('input', $event.target.value)"
            class="w3-input" rows="8">{{ value }}</textarea>

        <datepicker v-else-if="type === 'datepicker'"/>

        <imagepicker v-else-if="type === 'imagepicker'"/>
        
        <input v-else
            :value="value" @input="$emit('input', $event.target.value)"
            :required="required" :type="type"
            class="w3-input"/>

        <div  v-if="errors" v-show="showErrors" class="w3-panel w3-red w3-display-container">
            <!--span @click="showErrors = false" class="w3-button w3-display-topright">×</span-->
            <ul class="w3-ul">
                <li v-for="error in errors">{{ error }}</li>
            </ul>
        </div>
    </div>

</template>

<script>
    import Datepicker from "vuejs-datepicker";
    import Imagepicker from "./Imagepicker";
    export default {
        name: "MyInput",
        components: {
            Imagepicker,
            Datepicker
        },
        props: {
            value: String,
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
        data () {
            return {
                showErrors: true,
            }
        },
    }
</script>