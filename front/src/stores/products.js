import { defineStore } from 'pinia';

export const useProductStore = defineStore('productStore', {
    state: () => ({
        products: [],
        isUpdating: false,
    }),
    actions: {
        setProducts(newProducts) {
            if (!this.isUpdating && newProducts) {
                this.products = [...newProducts];
            }
        },
        addProduct() {
            const newProduct = {
                item_id: null,
                name: '',
                quantity: 1,
                rate: 0,
                tax_id: null
            };
            this.products.push(newProduct);
        },
        removeProduct(index) {
            this.products.splice(index, 1);
        },
        selectProduct(index, items) {
            const selectedProductId = this.products[index].item_id;
            const selectedItem = items.find(item => item.item_id === selectedProductId);
            if (selectedItem) {
                const { rate, tax_id, name } = selectedItem;
                Object.assign(this.products[index], { rate, tax_id, name });
            } else {
                Object.assign(this.products[index], { rate: 0, tax_id: '', name: '' });
            }
        },
        selectTax(index, taxes) {
            const selectedTaxId = this.products[index].tax_id;
            const selectedItem = taxes.find(item => item.tax_id === selectedTaxId);
            this.products[index].tax_id = selectedItem ? selectedItem.tax_id : null;
        },
    }
});
