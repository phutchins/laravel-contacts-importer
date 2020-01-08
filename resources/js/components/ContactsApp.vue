<template>
<!-- button accent green: 80d340  button blue: 00adde    background blue: 33bee8 -->
  <div class="container-fluid">
    <div class="row" style="background-color:#33bee8" height=80>
      <div class="col-1">
      </div>
      <div class="col-md">
        <h2>Contacts Importer</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-1">
      </div>
      <div class="col-md">
        <contacts-list v-show="this.$store.state.importStep == 0"></contacts-list>
        <import-contacts v-show="this.$store.state.importStep == 1"></import-contacts>
        <assign-fields v-show="this.$store.state.importStep == 2"></assign-fields>
        <mapping-preview v-show="this.$store.state.importStep == 3"></mapping-preview>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import store from "../store";
import contact from "../components/Contact";
import contactsList from "../components/ContactsList.vue";
import importContacts from "../components/ImportContacts.vue";
import assignFields from "../components/AssignFields.vue";

console.log('Loaded ContactsApp.vue template!');

export default {
  components: {
    contact,
    contactsList,
    importContacts,
    assignFields
  },
  name: "ContactsApp",
  mounted() {
    console.log('Component mounted.')
    console.log('Store is', this.$store);
  }
};
</script>
