<template>
    <router-view></router-view>
</template>

<script>
export default {
    name: "internship",
    created() {
        console.log(this.$route)
    }
}
</script>
