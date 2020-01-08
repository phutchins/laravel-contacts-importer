<template>
  <div class="main">
    <div class="row" v-if="this.$store.state.mycontacts.length > 0">
      <ul>
        <h2>Contacts List</h2>
        <table class="table">
          <thead>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Twitter ID</th>
            <th scope="col">FB Messenger ID</th>
            <th scope="col">Custom Attributes</th>
          </thead>
          <tbody>
            <contact v-for="contact in this.$store.state.mycontacts" :contact="contact" :key="contact.id"/>
          </tbody>
        </table>

      </ul>
    </div>
    <div v-else>
      No contacts to display. Why don't you import some?
    </div>
    <div class="row">
      <button type="button" class="btn btn-primary" v-on:click="startImport">Import Contacts</button>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import contact from "../components/Contact";
import store from "../store";

export default {
  props: [],
  components: {
  },
  methods: {
    getContacts() {
      store.dispatch("GET_CONTACTS");
    },
    startImport() {
      this.$store.commit("UPDATE_IMPORT_STEP", 1);
    }
  },
  name: "ContactsList",
	mounted() {
    this.$store.dispatch("GET_CONTACTS");
    window.Echo.channel("laravel_database_contactsCreated").listen(".contacts-retrieved", (e) => {
      this.$store.commit("ADD_CONTACTS", e.contacts);
      console.log('got event!!!!!!');
      console.log('store: ', this.$store);
    });
	},
	computed: {
    ...mapGetters(["mycontacts", "importStep"])
	}
};
</script>
