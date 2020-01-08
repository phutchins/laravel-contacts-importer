let getters = {
  newContact: state => {
    return state.newContact
  },
  mycontacts: state => {
    return state.mycontacts
  },
  toDelete: state => {
    return state.toDelete
  },
  importStep: state => {
    return state.importStep;
  },
  getSampleContact: state => {
    return state.sampleContact;
  },
  getCsvHeaders: state => {
    return state.csvHeaders;
  },
  getContactImportCount: state => {
    return state.contactImportCount;
  },
  assignedMappings: state => {
    return state.assignedMappings;
  },
  dbMappings: state => {
    return state.dbMappings;
  },
  getUploadedFileId: state => {
    return state.uploadedFileId;
  }
}
export default getters
