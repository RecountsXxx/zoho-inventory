import axios from "axios";
import {useToast} from "vue-toastification";
 class ContactService{
     toast = useToast();
    async fetchCustomers()
    {
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/contacts');
            return response.data;
        } catch (error) {
            this.toast.error(error.response.data.message);
        }
    }

     async addCustomer(data)
     {
         try {
             const response = await axios.post('http://127.0.0.1:8000/api/contacts',data);
             this.toast.success(response.data.message);
             return response.data.contact;
         } catch (error) {
             this.toast.error(error.response.data.message);
         }
     }

}

export default new ContactService();