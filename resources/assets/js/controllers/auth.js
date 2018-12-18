import http from '@/core/http';
import router from '../router';
import { runtime } from '../core/runtime';
// import { Validations, types, between, required } from '@/core/Validation';

// const login_requirements = {
//     email: {
//         required,
//         type: types.email
//     },
//     password: {
//         required,
//         type: types.string,
//         length: between(6, 20)
//     }
// };

// const register_requirements = {
//     email: {
//         required,
//         type: types.email
//     },
//     password: {
//         required,
//         type: types.string,
//         length: between(6, 20)
//     }
// };

export default class Auth {
    static login (credentials) {  
        http.post(`auth/login`, credentials)
            .then(res => {
                localStorage.setItem("accessToken", res.data.token);
                runtime.refresh();
                router.push({ name: "main" });
            })
            .catch(err => {
                this.error = {
                show: true,
                message: "Invalid credentials"
            }
        });
    }

    static register (credentials) {


        // const result = new Validation(register_requirements, {});

        http.post(`auth/login`, credentials)
            .then(res => {
                localStorage.setItem("accessToken", res.data.token);
                this.$parent.read_token();
                this.$router.push({ name: "main" });
            })
            .catch(err => {
                this.error = {
                show: true,
                message: "Invalid credentials"
            }
        });
    }

    static logout (redirect = true) {
        localStorage.clear();
        runtime.clear();

        if (redirect) {
            router.push({ name: "login" });
        } 
    }
};