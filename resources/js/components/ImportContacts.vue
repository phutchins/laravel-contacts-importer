<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel-heading">CSV Import</div>
      </div>
      <div class="col-md-8 col-md-offset-2">
				<div class="custom-file">
					<input type="file" class="custom-file-input" id="csv_file" name="csv_file" v-on:change="submitFile()" ref="csv_file">
					<label class="custom-file-label" for="customFile">Choose file</label>
				</div>
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
    submitFile() {
      var data = new FormData();
      this.file = this.$refs.csv_file.files[0];
      data.append('csv_file', this.file);
      store.dispatch("UPLOAD_FILE", data);
      this.nextStep();
    },
    nextStep() {
      this.$store.commit("UPDATE_IMPORT_STEP", 2);
    },
    mounted() {
    }
  }
}
</script>
