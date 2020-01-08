let mutations = {
  ADD_CONTACT(state, contact) {
    state.mycontacts.unshift(contact)
  },
  CACHE_DELETED(state, contact) {
    state.toDelete = contact;
  },
  ADD_CONTACTS(state, mycontacts) {
    console.log("GET_CONTACTS mutation called");
    // Should prob loop through the array of contacts and create one at a time?
    console.log('contacts about to import is: ', mycontacts);
    state.mycontacts = mycontacts;
  },
  DELETE_CONTACT(state, contact) {
    state.mycontacts.splice(state.mycontacts.indexOf(contact), 1)
    state.toDelete = null;
  },
  ADD_SAMPLE_CONTACT(state, contact) {
    state.sampleContact = contact;
  },
  ADD_CSV_HEADERS(state, csv_headers) {
    state.csvHeaders = csv_headers;
  },
  ADD_CONTACT_IMPORT_COUNT(state, contact_import_count) {
    state.contactImportCount = contact_import_count;
  },
  UPDATE_IMPORT_STEP(state, newStep) {
    state.importStep = newStep;
  },
  UPDATE_ASSIGNED_MAPPINGS(state, assignedMappings) {
    state.assignedMappings = assignedMappings;
  },
  ADD_UPLOADED_FILE_ID(state, uploadedFileId) {
    state.uploadedFileId = uploadedFileId;
  }
}
export default mutations
