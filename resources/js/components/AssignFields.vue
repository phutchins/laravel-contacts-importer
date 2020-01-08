<template>
  <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">CSV Field</th>
                <th scope="col">Map to Field</th>
              </tr>
              <assign-fields-table-row :key="sampleContactField" :index="index" :sampleContactField="sampleContactField" v-for="(sampleContactField,index) in this.$store.state.sampleContact"/>
            </thead>
          </table>
        </div>
        <div class="col-md-8 col-md-offset-2">
          <button type="button" class="btn btn-primary" v-on:click="sanityCheckMappings">Preview Mapping</button>
        </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { mapState } from "vuex";
import contact from "../components/Contact";
import assignFieldsTableRow from "../components/AssignFieldsTableRow";
import store from "../store";

export default {
  methods: {
    sanityCheckMappings() {
			// Check mappings for no double usage etc...
      this.showMappingPreview();
    },
    showMappingPreview() {
      // Loop through the selection of each dropdown and assign it to assignedMappings in order
      var assignedMappings = [];
      $('.dropdown .btn').each(function() {
        //
        console.log('Text content is: ', $(this).text());
        var dbMappings = store.getters.dbMappings;
        var mappingPosition = dbMappings.indexOf($(this).text());
				assignedMappings.push(mappingPosition);
      });

      console.log("Assigned mappings results: ", assignedMappings);
      // Save the mapping selected to local object
      this.$store.commit("UPDATE_ASSIGNED_MAPPINGS", assignedMappings);
      this.$store.commit("UPDATE_IMPORT_STEP", 3);
    },
  },
  mounted() {
    window.Echo.channel("laravel_database_fileUpload").listen(".file-uploaded", e => {
      console.log('Got fileUpload channel event of file-uploaded with data: ', e);
      this.$store.commit("ADD_SAMPLE_CONTACT", e.uploadedData.sample_contact);
      this.$store.commit("ADD_CSV_HEADERS", e.uploadedData.csv_headers);
      this.$store.commit("ADD_CONTACT_IMPORT_COUNT", e.uploadedData.contact_import_count);
      this.$store.commit("ADD_UPLOADED_FILE_ID", e.uploadedData.uploadedFileId);
      console.log('After fileUpload, store is: ', this.$store);
    });
  },
  computed: {
    ...mapGetters(["getSampleContact", "getCsvHeaders", "getContactImportCount"])
  }
}
</script>
