import axios from "axios";
import {useToast} from "vue-toastification";
class PurchaseOrderService{
    toast = useToast();
    async addPurchaseOrder(data)
    {
        try {
            const response = await axios.post('http://127.0.0.1:8000/api/purchase_orders',data);
            this.toast.success(response.data.message);
        } catch (error) {
            this.toast.error(error.response.data.message);
        }
    }

}

export default new PurchaseOrderService();