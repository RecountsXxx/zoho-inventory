<template>
  <div class="p-3 w-100 border rounded shadow">
    <label class="fs-2">Form for creating a sales order</label>
    <div class="form-group">
      <label for="customerName">Customer:</label>
      <select v-model="salesOrder.customer_id" class="form-control">
        <option v-for="customer in customers" :value="customer.contact_id" :key="customer.contact_id">{{ customer.contact_name }}</option>
      </select>
    </div>
    <div class="form-group">
      <label>Discount:</label>
      <input type="number" v-model="salesOrder.discount" class="form-control" placeholder="Discount">
    </div>
    <div class="form-group mt-2">
      <label>Make purchase order:</label>
      <input type="checkbox" v-model="salesOrder.purchase_order" class="form-check-input">
    </div>
    <SelectProductComponent :vendors="vendors" :items="items" :taxes="taxes" v-model:products="products" />
    <ItemFormComponent class="w-100" @addItem="addItem" :taxes="taxes"  :vendors="vendors" v-if="showPopup" :isVisible="showPopup" @close="showPopup = false" />
    <div>
      <button @click="submitSalesOrder" :disabled="isLoading || !salesOrder.customer_id || products.length === 0" class="btn mt-5 btn-primary">Submit Order</button>
      <button @click="showPopup = true" class="ms-2 mt-5 btn btn-success">Create product</button>
    </div>
    <GlobalLoaderComponent v-if="isLoading" />
  </div>
</template>

<script>
import { useToast } from "vue-toastification";
import GlobalLoaderComponent from "@/components/Helpers/GlobalLoaderComponent.vue";
import SalesOrderService from "@/services/OrderService";
import SelectProductComponent from "@/components/Helpers/SelectProductComponent.vue";
import ItemsService from "@/services/ItemsService";
import ItemFormComponent from "@/components/Forms/ItemFormComponent.vue";

export default {
  components: {ItemFormComponent, SelectProductComponent, GlobalLoaderComponent },
  props: {
    items: Array,
    customers: Array,
    vendors: Array,
    taxes: Array,
  },
  setup() {
    const toast = useToast();
    return { toast };
  },
  data() {
    return {
      salesOrder: {
        customer_id: null,
        discount: 0,
        purchase_order: false,
      },
      products: [],
      isLoading: false,
      showPopup: false,
    };
  },
  methods: {
    validateProducts() {
      if (this.salesOrder.purchase_order) {
        for (const product of this.products) {
          if (!product.item_id) {
            this.toast.error("Select products from list, Purchase order accepted only created products");
            return false;
          }
        }
      } else {
        for (const product of this.products) {
          if (!product.item_id && !product.name) {
            this.toast.error("Select product or enter name");
            return false;
          }
        }
      }
      return true;
    },

    async submitSalesOrder() {
      if (!this.salesOrder.customer_id || this.products.length === 0) {
        this.toast.error("Please fill all required fields");
        return;
      }

      if (!this.validateProducts()) {
        return;
      }

      try {
        this.isLoading = true;

        if (this.salesOrder.purchase_order) {
          await this.handlePurchaseOrder();
        }

        await this.sendSalesOrder();
      } catch (error) {
        console.error("Error sales order:", error);
        this.toast.error("Error sales order");
      } finally {
        this.isLoading = false;
      }
    },

    async handlePurchaseOrder() {
      const productIds = this.products.map(product => product.item_id).filter(Boolean);
      if (productIds.length === 0) {
        this.toast.error("Only created products can be added to a purchase order.");
        return;
      }

      try {
        const products = await Promise.all(productIds.map(productId => ItemsService.fetchItem(productId)));
        const productsByVendor = {};

        products.forEach(product => {
          if (!productsByVendor[product.vendor_id]) {
            productsByVendor[product.vendor_id] = [];
          }
          productsByVendor[product.vendor_id].push(product);
        });

        for (const vendorId in productsByVendor) {
          const vendorProducts = productsByVendor[vendorId];
          const lineItems = [];

          vendorProducts.forEach(product => {
            let quantity = 0;
            const correspondingProduct = this.products.find(p => p.item_id === product.item_id);
            if (correspondingProduct) {
              if(product.actual_available_for_sale_stock < correspondingProduct.quantity){
                quantity = correspondingProduct.quantity - product.actual_available_for_sale_stock;
              }
              lineItems.push({
                item_id: product.item_id,
                quantity: quantity,
                rate: correspondingProduct.rate,
                tax_id: correspondingProduct.tax_id
              });
            }
          });

          if (lineItems.length === 0) {
            this.toast.error("Item does not have a vendor");
            return;
          }

          await SalesOrderService.addPurchaseOrder({vendor_id: vendorId, line_items: lineItems});
        }
      } catch (error) {
        console.error("Error purchase order:", error);
        this.toast.error("Error purchase order");
      }
    },

    async sendSalesOrder() {
      try {
        this.isLoading = true;
        const sortedProducts = this.products.sort((a, b) => a.index - b.index);
        const orderData = {
          customer_id: this.salesOrder.customer_id,
          discount: `${this.salesOrder.discount}%`,
          line_items: sortedProducts.map(product => ({
            item_id: product.item_id,
            name: product.item_id ? null : product.name,
            quantity: product.quantity,
            rate: product.rate,
            tax_id: product.tax_id,
          })),
        };
        await SalesOrderService.addSalesOrder(orderData);
      } catch (error) {
        console.error("Error sales order:", error);
        this.toast.error("Error purchase order");
      } finally {
        this.isLoading = false;
      }
    },


    addItem(newItem){
      // eslint-disable-next-line vue/no-mutating-props
      this.items.push(newItem);
    }
  },
};
</script>

<style scoped>
</style>
