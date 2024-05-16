import axios from "axios";
import {useToast} from "vue-toastification";
 class VendorService{
     toast = useToast();
    async fetchVendors()
    {
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/vendors');
            return response.data;
        } catch (error) {
            this.toast.error(error.response.data.message);
        }
    }

}

export default new VendorService();