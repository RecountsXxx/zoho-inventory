<template>
  <div>
    <label class="fs-2">List of Items</label>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Unit</th>
          <th>Status</th>
          <th>Price</th>
          <th>Available Stock</th>
          <th>Actual Available Stock</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in items" :key="item.item_id">
          <td>{{ item.item_id }}</td>
          <td>{{ item.name }}</td>
          <td>{{ item.unit }}</td>
          <td>{{ item.status }}</td>
          <td>{{ item.rate }}</td>
          <td>{{ item.available_stock }}</td>
          <td>{{ item.actual_available_stock }}</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    items: Array,
  },
};
</script>

<style scoped>

</style>
