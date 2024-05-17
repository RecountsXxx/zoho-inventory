<template>
  <div class="popup-form">
    <div class="popup-content">
      <button @click="close" class="btn btn-secondary">Close</button>
      <form @submit.prevent="submitForm" class="mt-3">
        <div class="mb-3">
          <label for="name" class="form-label">Name:</label>
          <input type="text" v-model="formData.name" id="name" class="form-control" required maxlength="200" />
        </div>
        <div class="mb-3">
          <label for="tax_id" class="form-label">Tax:</label>
          <select v-model="formData.tax_id" id="tax_id" class="form-select" required>
            <option v-for="tax in taxes" :key="tax.tax_id" :value="tax.tax_id">{{ tax.tax_name }}</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="vendor_id" class="form-label">Vendor:</label>
          <select v-model="formData.vendor_id" id="vendor_id" class="form-select" required>
            <option v-for="vendor in vendors" :key="vendor.contact_id" :value="vendor.contact_id">{{ vendor.contact_name }}</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="rate" class="form-label">Rate:</label>
          <input type="number" v-model="formData.rate" id="rate" class="form-control" required />
        </div>
        <div class="mb-3">
          <label for="initial_stock" class="form-label">Initial Stock:</label>
          <input type="number" v-model="formData.initial_stock" id="initial_stock" class="form-control" required />
        </div>
        <div class="mb-3">
          <label for="initial_stock" class="form-label">Purchase rate:</label>
          <input type="number" v-model="formData.purchase_rate" id="purchase_rate" class="form-control" required />
        </div>
        <div class="mb-3">
          <label for="initial_stock_rate" class="form-label">Initial Stock Rate:</label>
          <input type="number" v-model="formData.initial_stock_rate" id="initial_stock_rate" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <GlobalLoaderComponent v-if="isLoading" />
    </div>
  </div>

</template>

<script>
import ItemsService from "@/services/ItemsService";
import GlobalLoaderComponent from "@/components/Helpers/GlobalLoaderComponent.vue";


export default {
  components: { GlobalLoaderComponent },
  props: {
    isVisible: Boolean,
    taxes: Array,
    vendors: Array
  },
  data() {
    return {
      formData: {
        name: '',
        tax_id: '',
        vendor_id: '',
        rate: 0,
        initial_stock: 0,
        initial_stock_rate: 0,
        purchase_rate:0,
      },
      isLoading: false,
    };
  },
  methods: {
    close() {
      this.$emit('close');
    },
    async submitForm() {
      this.isLoading = true;
      console.log(this.formData);
      const newItem = await ItemsService.addItem(this.formData);
      console.log(newItem);
      this.$emit('addItem', newItem);
      this.isLoading = false;
      this.close();
    }
  },
};
</script>

<style scoped>
.popup-form {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.popup-content {
  background-color: white;
  padding: 20px;
  border-radius: 5px;
  position: relative;
}

.close-btn {
  position: absolute;
  top: 10px;
  right: 10px;
  background: none;
  border: none;
  font-size: 16px;
  cursor: pointer;
}

form > div {
  margin-bottom: 10px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input, select {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}
</style>
