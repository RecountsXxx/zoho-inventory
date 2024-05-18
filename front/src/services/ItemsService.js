import AbstractApiService from './Abstracts/AbstractApiService';

class ItemsService extends AbstractApiService {
    async fetchItems() {
        return await this.get('/items');
    }

    async fetchItem(id) {
        return await this.get(`/items/${id}`);
    }

    async addItem(data) {
        const response = await this.post('/items', data);
        if(response) {
            this.toast.success(response.message);
            return response.item;
        }
    }
}

export default new ItemsService();
