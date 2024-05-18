import axios from 'axios';
import { useToast } from 'vue-toastification';

class AbstractApiService {
    constructor() {
        this.toast = useToast();
    }

    async get(endpoint) {
        try {
            const response = await axios.get(endpoint);
            return response.data;
        } catch (error) {
            this.handleError(error);
        }
    }

    async post(endpoint, data) {
        try {
            const response = await axios.post(endpoint, data);
            return response.data;
        } catch (error) {
            this.handleError(error);
        }
    }

    async put(endpoint, data) {
        try {
            const response = await axios.put(endpoint, data);
            return response.data;
        } catch (error) {
            this.handleError(error);
        }
    }

    async delete(endpoint) {
        try {
            const response = await axios.delete(endpoint);
            return response.data;
        } catch (error) {
            this.handleError(error);
        }
    }

    handleError(error) {
        if (error.response && error.response.data && error.response.data.message) {
            this.toast.error(error.response.data.message);
        } else {
            this.toast.error('An unknown error occurred.');
        }
    }
}

export default AbstractApiService;
