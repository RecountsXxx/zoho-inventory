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
      <tr v-for="(product, index) in productStore.products" :key="index">
        <td>
          <select v-model="product.item_id" @change="() => productStore.selectProduct(index, items)" class="form-control">
            <option value="">-- Select Product --</option>
            <option v-for="item in items" :value="item.item_id" :key="item.item_id">{{ item.name }}</option>
          </select>
        </td>
        <td><input type="text" v-model="product.name" class="form-control" placeholder="Name"></td>
        <td><input type="number" v-model="product.quantity" class="form-control" placeholder="Quantity"></td>
        <td><input type="number" v-model="product.rate" class="form-control" placeholder="Price"></td>
        <td>
          <select v-model="product.tax_id" @change="() => productStore.selectTax(index, taxes)" class="form-control">
            <option value="">-- Select Tax --</option>
            <option v-for="tax in taxes" :value="tax.tax_id" :key="tax.tax_id">{{ tax.tax_name }}</option>
          </select>
        </td>
        <td>
          <button @click="() => productStore.removeProduct(index)" class="btn btn-danger">Remove</button>
        </td>
      </tr>
      </tbody>
    </table>
    <button @click="productStore.addProduct" class="btn btn-success">Add Product</button>
  </div>
</template>

<script>
import { useProductStore } from '@/stores/products';
import { watch } from 'vue';

export default {
  props: {
    items: Array,
    taxes: Array,
    products: {
      type: Array,
      required: true
    },
  },
  setup(props, { emit }) {
    const productStore = useProductStore();

    watch(() => props.products, (newVal) => {
      if (!productStore.isUpdating) {
        productStore.setProducts(newVal);
      }
    }, { deep: true, immediate: true });

    watch(() => productStore.products, (newVal) => {
      if (!productStore.isUpdating) {
        productStore.isUpdating = true;
        emit('update:products', newVal);
        setTimeout(() => {
          productStore.isUpdating = false;
        });
      }
    }, { deep: true });

    return {
      productStore
    };
  }
};
</script>

<style scoped>
</style>
