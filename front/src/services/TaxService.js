import axios from "axios";
import {useToast} from "vue-toastification";
 class TaxService{
     toast = useToast();
    async fetchTaxes()
    {
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/taxes');
            return response.data;
        } catch (error) {
            this.toast.error(error.response.data.message);
        }
    }

     async addTax(data)
     {
         try {
             const response = await axios.post('http://127.0.0.1:8000/api/taxes',data);
             this.toast.success(response.data.message);
             return response.data.tax;
         } catch (error) {
             this.toast.error(error.response.data.message);
         }
     }

}

export default new TaxService();