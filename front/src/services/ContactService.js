import AbstractApiService from './Abstracts/AbstractApiService';

class ContactService extends AbstractApiService {

    async fetchCustomers() {
       return await this.get('/contacts');
    }

    async addCustomer(data) {
        const response = await this.post('/contacts', data);
        if (response) {
            this.toast.success(response.message);
            return response.contact;
        }
    }
}

export default new ContactService();
