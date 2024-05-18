import AbstractApiService from './Abstracts/AbstractApiService';

class TaxService extends AbstractApiService {

    async fetchTaxes() {
       return await this.get('/taxes');
    }

    async addTax(data) {
        const response = await this.post('/taxes', data);
        if (response) {
            this.toast.success(response.message);
            return response.tax;
        }
    }
}

export default new TaxService();
