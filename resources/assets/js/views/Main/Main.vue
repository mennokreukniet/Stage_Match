<template>
    <div class="container">
        <div class="main">
            <div class="card">
                <input type="hidden" v-model="token">
                <strong>Version: </strong><span>V0.0.3 (LESS ALPHA-ISH)</span><br>
                <strong>Role: </strong><span>{{this.role}}</span><br><br>
                <button class="classic" v-on:click="get_token">Copy token</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default { 
        name: 'main_index', 
        data() {
            return {
                token: ""
            }
        },
        created() {
            this.token = localStorage.getItem("accessToken");

            switch(this.$parent.auth.role) {
                case "1":
                    this.role = "Student";
                    break;
                case "2":
                    this.role = "Company";
                    break;
                case "3": 
                    this.role = "Admin";
                    break;
            }

        },
        methods: {
            get_token() {
                navigator.permissions.query({name: "clipboard-write"}).then(result => {
                    if (result.state == "granted" || result.state == "prompt") {
                    navigator.clipboard.writeText(this.token).then(clipText =>
                        console.log(clipText));
                    }
                });
            }
        }
    }
</script>