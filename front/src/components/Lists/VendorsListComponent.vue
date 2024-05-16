<template>
  <div>
    <label class="fs-2">List of Vendors</label>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th>Vendor ID</th>
          <th>Vendor Name</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in vendors" :key="item.contact_id">
          <td>{{ item.contact_id }}</td>
          <td>{{ item.contact_name }}</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    vendors: Array,
  },
};
</script>

<style scoped>

</style>
