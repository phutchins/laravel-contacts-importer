<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h3>Field Mapping Preview</h3>
      </div>
      <div class="col-md-8 col-md-offset-4">
        <table class="table">
          <thead>
            <tr>
              <th v-for="field in this.$store.state.dbMappings" scope="col">{{field}}</th>
            </tr>
            <tr>
              <th v-for="(field,index) in this.$store.state.dbMappings" scope="col">{{$store.state.sampleContact[$store.state.assignedMappings.indexOf(index)]}}</th>
            </tr>
          </thead>
        </table>
      </div>
      <div class="col-md-8 col-md-offset-4">
        <button type="button" class="btn btn-primary" v-on:click="submitMapping">Ok</button>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import contact from "../components/Contact";
import store from "../store";

export default {
  data() {
    return {
      file: ''
    }
  },
  methods: {
    submitMapping() {
      var mappingData = {
        'mapping': this.$store.state.assignedMappings,
        'uploadedFileId': this.$store.state.uploadedFileId
      }
      store.dispatch("COMMIT_MAPPING", mappingData);
      // Should catch error submitting here before moving back to contacts list page
      this.backToList();
    },
    backToList() {
      this.$store.commit("UPDATE_IMPORT_STEP", 0);
    },
    mounted() {
    }
  }
}
</script>
