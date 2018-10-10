<template>
    <div>
        <router-link to="/internship" tag="button" class="back"><i class="material-icons">arrow_back_ios</i></router-link>
        <router-link to="/internship/create" tag="button" class="create"><i class="material-icons">add</i></router-link>
        
        
        <router-view></router-view>   
        
    </div>
</template>

<script>
export default {
    name: "internship",
}
</script>
