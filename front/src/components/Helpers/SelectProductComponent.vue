<template>
  <div class="mt-2">
    <h2>Items List</h2>
    <table class="table">
      <thead>
      <tr>
        <th>Product</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Tax</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(product, index) in localProducts" :key="index">
        <td>
          <select v-model="product.item_id" @change="selectProduct(index)" class="form-control">
            <option value="">-- Select Product --</option>
            <option v-for="item in items" :value="item.item_id" :key="item.item_id">{{ item.name }}</option>
          </select>
        </td>
        <td><input type="text" v-model="product.name" class="form-control" placeholder="Name"></td>
        <td><input type="number" v-model="product.quantity" class="form-control" placeholder="Quantity"></td>
        <td><input type="number" v-model="product.rate" class="form-control" placeholder="Price"></td>
        <td>
          <select v-model="product.tax_id" @change="selectTax(index)" class="form-control">
            <option value="">-- Select Tax --</option>
            <option v-for="tax in taxes" :value="tax.tax_id" :key="tax.tax_id">{{ tax.tax_name }}</option>
          </select>
        </td>
        <td>
          <button @click="removeProduct(index)" class="btn btn-danger">Remove</button>
        </td>
      </tr>
      </tbody>
    </table>
    <button @click="addProduct" class="btn btn-success">Add Product</button>
  </div>
</template>

<script>
export default {
  props: {
    items: Array,
    taxes: Array,
    products: {
      type: Array,
      required: true
    },
  },
  data() {
    return {
      localProducts: [],
      isUpdating: false
    };
  },
  watch: {
    products: {
      handler(newVal) {
        if (!this.isUpdating) {
          this.localProducts = [...newVal];
        }
      },
      deep: true,
      immediate: true
    },
    localProducts: {
      handler(newVal) {
        if (!this.isUpdating) {
          this.isUpdating = true;
          this.$emit('update:products', newVal);
          this.$nextTick(() => {
            this.isUpdating = false;
          });
        }
      },
      deep: true
    }
  },
  methods: {
    addProduct() {
      const index = this.localProducts.length;
      this.localProducts.push({
        item_id: null,
        name: '',
        quantity: 1,
        rate: 0,
        tax_id: null,
        index
      });
    },
    removeProduct(index) {
      this.localProducts.splice(index, 1);
      this.localProducts.forEach((product, i) => {
        product.index = i;
      });
    },
    selectProduct(index) {
      const selectedProductId = this.localProducts[index].item_id;
      const selectedItem = this.items.find(item => item.item_id === selectedProductId);
      if (selectedItem) {
        const {rate, tax_id, name} = selectedItem;
        Object.assign(this.localProducts[index], {rate, tax_id, name});
      } else {
        Object.assign(this.localProducts[index], {rate: 0, tax_id: '', name: ''});
      }
    },
    selectTax(index) {
      const selectedTaxId = this.localProducts[index].tax_id;
      const selectedItem = this.taxes.find(item => item.tax_id === selectedTaxId);
      this.localProducts[index].tax_id = selectedItem ? selectedItem.tax_id : null;

    },
  }
}
</script>

<style scoped>
</style>
