import axios from 'axios';
import router from '../router';
import Auth from '../controllers/auth';

const http = axios.create(
    {
        baseURL: `${window.location.origin}/api/`
    }
);

http.interceptors.request.use(function (config) {
    config.headers.Authorization = `bearer ${localStorage.getItem("accessToken")}`;
    return config;
});

http.interceptors.response.use(
    (response) => {
        console.log("res:", response)
        return response;
    }, 
    (error)  => {
        if (error.response.status === 401) {
            const token = localStorage.getItem("accessToken") ;

            try {
                if (token !== null && JSON.parse(atob(token.split(".")[1])).exp < Math.floor(Date.now()/1000)) {
                    console.log(1)
                    Auth.logout(true);
                }
                
            } catch (e) {
                console.log(2);
                Auth.logout(true);
            } 
        }

        return Promise.reject(error);
    }
);

export default http;

