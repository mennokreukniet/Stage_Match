<template>
    <div>
        <div class="card">
            <strong>Version: </strong><span>V0.0.2 (STILL ROCKING ÜBER ALPHA)</span><br>
            <strong>Role: </strong><span>{{this.role}}</span>
        </div>
    </div>
</template>

<script>
    export default { 
        name: 'main_index', 
        data() {
            return {
                role: "dfdf"
            }
        },
        created() {
            switch(JSON.parse(atob(localStorage.getItem("accessToken").split(".")[1])).role) {
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

        } 
    }
</script>