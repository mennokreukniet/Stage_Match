<template>
    <div class="container">

        <div class="card elevated">
            <img style="margin: -16px;margin-bottom: 16px;width:calc(100% + 32px);border-top-right-radius: 3px; border-top-left-radius: 3px; " src="https://assets.entrepreneur.com/content/3x2/2000/20150805204041-google-company-building-corporate.jpeg?width=700&crop=2:1">
            
            <div>
                <div class="font h6 high">Company name</div>
                <div class="font subtitle2 low">16 kilometers away</div>
                <br>
                <div class="font body1">This is our desc...</div>
            </div>
            
            <!-- <strong>Version: </strong><span>V0.0.3 (LESS ALPHA-ISH)</span><br>
            <strong>Role: </strong><span>{{this.role}}</span><br><br> -->
        </div>
    </div>
</template>

<script>
    import { runtime } from "../../core/runtime";
    
    export default { 
        name: 'main_index', 
        data() {
            return {
                role: ""
            }
        },
        created() {
            switch(runtime.token.role) {
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