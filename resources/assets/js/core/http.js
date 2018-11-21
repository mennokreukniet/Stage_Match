import axios from 'axios';

const api_url = `${window.location.origin}/api/`;


export default class Http {
    constructor() {
        this.config = {};
    }

    /**
     * Makes a get request to the API endpoint
     * @param {string} endpoint - API endpoint
     * @param {object} [config={}] - Request header config
     */
    get(endpoint, config) {
        this.http_headers(config);

        return axios.get(api_url + endpoint, this.config);
    }

    /**
     * Makes a post request to the API endpoint
     * @param {string} endpoint - API endpoint
     * @param {object} data - Post data
     * @param {object} [config={}] - Request header config
     */
    post(endpoint, data, config) {
        this.http_headers(config);

        return axios.post(api_url + endpoint, data, this.config);
    }

    /**
     * Makes a put request to the API endpoint
     * @param {string} endpoint - API endpoint
     * @param {object} data - Put data
     * @param {object} [config={}] - Request header config
     */
    put(endpoint, data, config) {
        this.http_headers(config);

        return axios.put(api_url + endpoint, data, this.config);
    }

    /**
     * Makes a delete request to the API endpoint
     * @param {string} endpoint
     * @param {object} [config={}]
     */
    delete(endpoint, config) {
        this.http_headers(config);

        return axios.delete(api_url + endpoint, this.config);
    }

    // Set basic headers in case they aren't set
    http_headers(config = {}) {
        //Checking if header object is created, if not create it
        //Note: Without this check, this script will fail if you try to access a property within the headers obj.
        if (config.headers === undefined) config.headers = {};

        //Authorization header check and placing if empty
        //Note: Needed for user authentification on server side
        if (config.headers.Authorization === undefined) config.headers.Authorization = `Bearer ${localStorage.getItem("accessToken")}`;

        this.config = config;
    }
}