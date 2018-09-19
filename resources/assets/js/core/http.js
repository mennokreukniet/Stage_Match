import axios from 'axios';

export default class Http {
    get(api_url, config) {
        if (config.headers === undefined && config.headers.Authorization === undefined) {
            config.header.Authorization = `Bearer ${localStorage.getItem("access_token")}`;
        }
        
        return axios.get(api_url, config);
    }

    parse_url() {
        
    }
}