<template>
  <div class="w-100 p-3 mt-5 ms-5 border rounded shadow">
    <label class="fs-2 mt-4">Form for adding a tax</label>
    <div class="form-group">
      <label for="tax_name">Tax Name:</label>
      <input type="text" id="tax_name" v-model="tax.tax_name" class="form-control">
    </div>
    <div class="form-group">
      <label for="tax_percentage">Tax percentage:</label>
      <input type="number" id="tax_percentage" v-model="tax.tax_percentage" class="form-control">
    </div>
    <button @click="addTax" type="submit" class="btn mt-3 btn-primary">Add Tax</button>
  </div>

  <GlobalLoaderComponent v-if="isLoading" />
</template>

<script>
import {useToast} from "vue-toastification";
import GlobalLoaderComponent from "@/components/Helpers/GlobalLoaderComponent.vue";
import TaxService from "@/services/TaxService";
export default{
  components: {GlobalLoaderComponent},
  setup() {
    const toast = useToast();
    return { toast }
  },
  data(){
    return{
      tax:{
        tax_name: '',
        tax_percentage: 0,
      },
      isLoading: false,
    }
  },
  methods: {
   async addTax() {
      if(this.tax.tax_name.length > 0 && this.tax.tax_percentage > 0){
      this.isLoading = true;

      const taxData = {
        tax_name: this.tax.tax_name,
        tax_percentage:this.tax.tax_percentage
      };
        let newTax = await TaxService.addTax(taxData);
        if(newTax != null) {
          this.$emit('add', {tax_id: newTax.tax_id, tax_percentage: newTax.tax_percentage, tax_name: newTax.tax_name})
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