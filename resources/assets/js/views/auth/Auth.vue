<template>
    <div class="container">
        <div class="product-card">
            <div class="overlay"></div>
            <div class="content">
                <span class="appname">{{$t("app.name")}}.</span>
                <span class="title">{{$t("auth.product.title")}}.</span>

                <span class="register">{{$t("auth.product.register_message")}}</span>
                <router-link tag="button" class="register" to="/auth/register">{{$t("auth.product.register_button")}}</router-link>

                <span class="login">{{$t("auth.already_using")}} <router-link to="/auth/login">{{$t("auth.sign_in")}}.</router-link></span>
            </div>
        </div>
        <div class="card1">

        </div>
    </div>
</template>

<style>
    @import '/css/auth.css';
</style>


<script>
    export default { 
        name: 'auth', 
        created() {
            if ('scrollRestoration' in history) {
                history.scrollRestoration = 'manual';
            }
            
        }
    }
</script>