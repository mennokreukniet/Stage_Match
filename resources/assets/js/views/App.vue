<template>
    <div>
        <div class="container">
            <router-view></router-view>
        </div>
        <nav v-if="!['login', 'register', 'index'].includes($route.name)">
            <div class="left">
                <button class="primary">
                    <i class="material-icons">menu</i>
                    <span>Menu</span>
                </button>
            </div>
            <div class="center">
                <router-link to="/">
                    <button class="circle">
                        <i class="material-icons">filter_none</i>
                        <span>Swipe</span>
                    </button>
                </router-link>
            </div>
            <div class="right">
                <router-link tag="button" to="/reviews">
                    <i class="material-icons">star</i>
                    <span>My reviews</span>
                </router-link>

                <router-link class="primary" tag="button" to="/settings">
                    <i class="material-icons">settings</i>
                    <span>Settings</span>
                </router-link>
                <router-link tag="button" to="/logout">
                    <i class="material-icons">power_settings_new</i>
                    <span>Log out</span>
                </router-link>
            </div>
        </nav>
    </div>
</template>

<script>
    export default { name: 'main-app' }
</script>