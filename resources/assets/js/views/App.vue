
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
                <router-link v-if="role === '2'" tag="button" to="/internship">
                    <i class="material-icons">assignment_ind</i>
                    <span>Internship</span>
                </router-link>
                <router-link tag="button" to="/reviews">
                    <i class="material-icons">star</i>
                    <span>My reviews</span>
                </router-link>

                <router-link class="primary" tag="button" to="/settings">
                    <i class="material-icons">settings</i>
                    <span>Settings</span>
                </router-link>

                <router-link v-if="role === '3'" tag="button" to="/admin">
                    <i class="material-icons">security</i>
                    <span>Admin</span>
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
    export default { 
        name: 'main-app',
        data() {
            return {
                role: ""
            }
        },
        created() {
            this.set_role();
        },
        methods: {
            set_role() {
                const token = localStorage.getItem("accessToken");
                if (token !== null) this.role = JSON.parse(atob(token.split(".")[1])).role;
            }
        }
     }
</script>