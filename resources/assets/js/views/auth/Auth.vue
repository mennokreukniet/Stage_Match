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
            <span class="title">Placeholder feature 1</span>
            <span class="description">Placeholder feature 1</span>
            <div class="screenshot"></div>
            <div class="overlay">
                <span class="title">Placeholder feature 1</span>
            </div>
        </div>

        <div class="card2">
            <span class="title">Placeholder feature 2</span>
            <span class="description">Placeholder feature 3</span>
            <div class="screenshot"></div>
            <div class="overlay">
                <span class="title">Placeholder feature 2</span>
            </div>
        </div>
        <div class="card3">
            <span class="title">Placeholder feature 3</span>
            <span class="description">Placeholder feature 3</span>
            <div class="screenshot1"></div>
        </div>

        <div class="card4">
            <span class="title">{{$t("auth.footer.waiting")}}</span>
            <router-link tag="button" class="register" to="/auth/register">{{$t("auth.product.register_button")}}</router-link>

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