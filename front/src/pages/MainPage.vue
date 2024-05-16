<template>
  <div class="w-100 p-5">

    <div class="d-flex flex-row gap-5">
      <SalesFormComponent :items="items" :customers="customers" :taxes="taxes"></SalesFormComponent>

      <PurchaseFormComponent :items="items" :vendors="vendors" :taxes="taxes"></PurchaseFormComponent>
    </div>
    <div class="w-100 d-flex flex-row mt-5">
      <ContactFormComponent @addVendor="addVendor" @addCustomer="addCustomer"></ContactFormComponent>
      <TaxFormComponent @add="addTax"></TaxFormComponent>
    </div>


    <ListItemsComponent class="mt-4" :items="items"></ListItemsComponent>
    <div class="d-flex flex-row gap-5 w-100">
      <ListContactsComponent class="mt-4 w-50" :contacts="customers"></ListContactsComponent>
      <ListVendorsComponent  class="mt-4 w-50" :vendors="vendors"></ListVendorsComponent>
      <ListTaxesComponent class="mt-4 w-50" :taxes="taxes"></ListTaxesComponent>
    </div>

  </div>

  <GlobalLoaderComponent v-if="isLoading" />
</template>

<script>
import ListItemsComponent from "@/components/Lists/ItemsListComponent.vue";
import ListContactsComponent from "@/components/Lists/ContactsListComponent.vue";
import ListTaxesComponent from "@/components/Lists/TaxesListComponent.vue";
import ListVendorsComponent from "@/components/Lists/VendorsListComponent.vue";
import GlobalLoaderComponent from "@/components/Helpers/GlobalLoaderComponent.vue";
import ContactFormComponent from "@/components/Forms/ContactFormComponent.vue";
import TaxFormComponent from "@/components/Forms/TaxFormComponent.vue";

import ContactService from "@/services/ContactService";
import TaxService from "@/services/TaxService";
import ItemService from "@/services/ItemsService";
import SalesFormComponent from "@/components/Forms/SalesFormComponent.vue";
import PurchaseFormComponent from "@/components/Forms/PurchaseFormComponent.vue";
import VendorService from "@/services/VendorService";

export default {
  components: {
    PurchaseFormComponent,
    SalesFormComponent,
    TaxFormComponent,
    ContactFormComponent,
    ListItemsComponent,
    ListVendorsComponent,
    ListContactsComponent,
    ListTaxesComponent,
    GlobalLoaderComponent,
  },
  data() {
    return {
      customers: [],
      items: [],
      taxes:[],
      vendors:[],

      isLoading: true,
    };
  },
  async created() {
    this.customers = await ContactService.fetchCustomers();
    this.items = await ItemService.fetchItems();
    this.taxes = await TaxService.fetchTaxes();
    this.vendors = await VendorService.fetchVendors();

    this.isLoading = false;
  },
  methods: {
    addTax(newTax) {
      this.taxes.push(newTax);
    },
    addCustomer(newCustomer) {
      this.customers.push(newCustomer);
    },
    addVendor(newVendor) {
      this.vendors.push(newVendor);
    }
  }
}
</script>
