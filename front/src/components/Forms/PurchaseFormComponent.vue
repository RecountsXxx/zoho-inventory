<template>
  <div class="p-3 w-75 border rounded shadow">
    <label class="fs-2">Form for creating a purchase order</label>
    <div class="form-group">
      <label for="customerName">Vendor:</label>
      <select v-model="purchaseOrder.vendor_id" class="form-control">
        <option v-for="vendor in vendors" :value="vendor.contact_id" :key="vendor.contact_id">{{ vendor.contact_name }}</option>
      </select>
    </div>

    <SelectProductComponent :items="items" :taxes="taxes" v-model:products="products">></SelectProductComponent>
    <button @click="submitPurchaseOrder" class="btn mt-5 btn-primary">Submit Order</button>
  </div>
  <GlobalLoaderComponent v-if="isLoading" />
</template>

<script>
import { useToast } from "vue-toastification";
import GlobalLoaderComponent from "@/components/Helpers/GlobalLoaderComponent.vue";
import PurchaseOrderService from "@/services/PurchaseOrderService";
import SelectProductComponent from "@/components/Helpers/SelectProductComponent.vue";

export default {
  components: {SelectProductComponent, GlobalLoaderComponent },
  props: {
    items: Array,
    vendors: Array,
    taxes: Array,
  },
  setup() {
    const toast = useToast();
    return { toast };
  },
  data() {
    return {
      purchaseOrder: {
        vendor_id: 0,
      },
      products: [],
      isLoading: false,
    };
  },
  methods: {
    async submitPurchaseOrder() {
      if (this.purchaseOrder.vendor_id && this.products.length > 0) {
        this.isLoading = true;
        const sortedProducts = this.products.sort((a, b) => a.index - b.index);
        const orderData = {
          vendor_id: this.purchaseOrder.vendor_id,
          line_items: sortedProducts.map(product => ({
            item_id: product.item_id,
            quantity: product.quantity,
            rate: product.rate,
            tax_id: product.tax_id,
          })),
        };

        await PurchaseOrderService.addPurchaseOrder(orderData);
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
