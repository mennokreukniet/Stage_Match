<template>
    <div id="main">
        <div class="card">
            <span class="title">Profile</span>

            <input type="text">
        </div>
    </div>    
</template>

<script>
export default {
    name: "settings"
}
</script>

<style>
    .card {
        background: white;
        border-radius: 20px;
        padding: 20px 30px;
    }

    div.card > span.title {
        letter-spacing: 2px;
        display: block;
        font-size: 23px;
        margin-bottom: 40px;
    }
</style>
