<template>
  <div>
    <label class="fs-2">List of Taxes</label>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th>Id</th>
          <th>Tax Name</th>
          <th>Tax Percentage</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in taxes" :key="item.tax_id">
          <td>{{ item.tax_id }}</td>
          <td>{{ item.tax_name }}</td>
          <td>{{ item.tax_percentage }}</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    taxes: Array,
  },
};
</script>

<style scoped>

</style>
