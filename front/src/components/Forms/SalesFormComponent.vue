<template>
  <div class="p-3 w-75 border rounded shadow">
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
    <SelectProductComponent :show-name-input="true" :items="items" :taxes="taxes" v-model:products="products">></SelectProductComponent>
    <button @click="submitSalesOrder" class="btn mt-5 btn-primary">Submit Order</button>
  </div>
  <GlobalLoaderComponent v-if="isLoading" />
</template>

<script>
import { useToast } from "vue-toastification";
import GlobalLoaderComponent from "@/components/Helpers/GlobalLoaderComponent.vue";
import SalesOrderService from "@/services/SalesOrderService";
import SelectProductComponent from "@/components/Helpers/SelectProductComponent.vue";

export default {
  components: {SelectProductComponent, GlobalLoaderComponent },
  props: {
    items: Array,
    customers: Array,
    taxes: Array,
  },
  setup() {
    const toast = useToast();
    return { toast };
  },
  data() {
    return {
      salesOrder: {
        customer_id: 0,
        discount: 0,
      },
      products: [],
      isLoading: false,
    };
  },
  methods: {
    async submitSalesOrder() {
      if (this.salesOrder.customer_id && this.products.length > 0) {
        this.isLoading = true;
        const sortedProducts = this.products.sort((a, b) => a.index - b.index);
        const orderData = {
          customer_id: this.salesOrder.customer_id,
          discount: this.salesOrder.discount.toString() + "%",
          line_items: sortedProducts.map(product => ({
            item_id: product.item_id,
            name: product.item_id ? null : product.name,
            quantity: product.quantity,
            rate: product.rate,
            tax_id: product.tax_id,
          })),
        };

        await SalesOrderService.addSalesOrder(orderData);
        this.isLoading = false;
      } else {
        this.toast.error("Please fill all required fields");
      }
    },
  },
};
</script>

<style scoped>
</style>
