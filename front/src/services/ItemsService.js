import axios from "axios";
import {useToast} from "vue-toastification";
 class ItemsService{
     toast = useToast();
    async fetchItems()
    {
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/items');
            return response.data;
        } catch (error) {
            this.toast.error(error.response.data.message);
        }
    }

     async fetchItem(id)
     {
         try {
             const response = await axios.get('http://127.0.0.1:8000/api/items/' + id);
             return response.data;
         } catch (error) {
             this.toast.error(error.response.data.message);
         }
     }

     async addItem(data)
     {
         try {
             const response = await axios.post('http://127.0.0.1:8000/api/items',data);
             this.toast.success(response.data.message);
             return response.data.item;
         } catch (error) {
             this.toast.error(error.response.data.message);
         }
     }


 }

export default new ItemsService();