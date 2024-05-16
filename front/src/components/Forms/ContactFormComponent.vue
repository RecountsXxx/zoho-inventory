<template>
  <div class="w-100 p-3 mt-5 border rounded shadow">
    <label class="fs-2 mt-4">Form for adding a contact</label>
    <div class="form-group">
      <label for="contactName">Customer Name:</label>
      <input type="text" id="contactName" v-model="customer.customer_name" class="form-control">
    </div>
    <div class="form-group">
      <label for="contactName">Customer type:</label>
      <select v-model="customer.customer_type" @change="selectContactType(customer.customer_type)" class="form-control">
        <option value="customer">Customer</option>
        <option value="vendor">Vendor</option>
      </select>
    </div>

    <button @click="addCustomer" type="submit" class="btn mt-3 btn-primary">Add Contact</button>
  </div>

  <GlobalLoaderComponent v-if="isLoading" />
</template>

<script>
import {useToast} from "vue-toastification";
import GlobalLoaderComponent from "@/components/Helpers/GlobalLoaderComponent.vue";
import ContactService from "@/services/ContactService";
export default{
  components: {GlobalLoaderComponent},
  setup() {
    const toast = useToast();
    return { toast }
  },
  data(){
    return{
      customer:{
        customer_name:'',
        customer_type:'',
      },
      isLoading: false,
    }
  },
  methods: {
    selectContactType(type){
      this.customer.customer_type = type;
    },
    async addCustomer() {
      if(this.customer.customer_name.length > 0){
        this.isLoading = true;
        const contactData = {
          contact_name: this.customer.customer_name,
          contact_type: this.customer.customer_type,
      };

        let newContact = await ContactService.addCustomer(contactData);
        if(newContact != null) {
          this.$emit('add', {contact_id: newContact.contact_id,status:newContact.status, contact_type:newContact.contact_type, contact_name: newContact.contact_name});
        }

        this.isLoading = false;
      } else {
        this.toast.error("Please fill all required fields");
      }
    },
  },
}
</script>

<style scoped>

</style>