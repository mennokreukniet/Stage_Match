<template>
    <div class="container">
        <notifications position="top right"/>

        <div class="page-options left">
            <router-link v-if="$route.name !== 'internship_show'" to="/internship" tag="button" class="back">
                <i class="material-icons">arrow_back</i>
            </router-link>
        </div>

        <div class="page-options right">
            <router-link to="/internship/create" tag="button" class="page-options right create">
                <i class="material-icons">add</i>
            </router-link>
        </div>

        <div class="main">
            <div class="title">
                <i class="material-icons">assignment_ind</i>
                <span class="title">Internships</span>
            </div>

            <router-view :key="$route.fullPath"></router-view>
        </div>
    </div>
</template>

<script>
export default {
    name: "internship",
}
</script>
