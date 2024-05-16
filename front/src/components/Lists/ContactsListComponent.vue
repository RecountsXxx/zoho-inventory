<template>
  <div>
    <label class="fs-2">List of Contacts</label>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th>Contact ID</th>
          <th>Contact Name</th>
          <th>Contact Type</th>
          <th>Contact Status</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in contacts" :key="item.contact_id">
          <td>{{ item.contact_id }}</td>
          <td>{{ item.contact_name }}</td>
          <td>{{ item.contact_type }}</td>
          <td>{{ item.status }}</td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    contacts: Array,
  },
};
</script>

<style scoped>

</style>
