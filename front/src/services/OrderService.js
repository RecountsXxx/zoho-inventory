import AbstractApiService from './Abstracts/AbstractApiService';

class OrderService extends AbstractApiService {
    async addSalesOrder(data) {
        const response = await this.post('/sales_orders', data);
        if (response) {
            this.toast.success(response.message);
        }
    }

    async addPurchaseOrder(data) {
        const response = await this.post('/purchase_orders', data);
        if (response) {
            this.toast.success(response.message);
        }
    }
}

export default new OrderService();
