<template>
    <internship-form http-method="post" http-url="internship">
        <span class="title">Create internship</span>
    </internship-form>
</template>

<script>
import InternshipForm from './InternshipForm';

export default {
    components: {
        InternshipForm
    }
}
</script>
