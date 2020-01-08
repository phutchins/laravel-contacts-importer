let state = {
  importStep: 0,
  mycontacts: [],
  sampleContact: [],
  csvHeaders: [],
  contactImportCount: 0,
  uploadedFileId: '',
  dbMappings: ['team_id', 'first_name', 'last_name', 'email', 'phone', 'stick_phone_number_id', 'twitter_id', 'fb_messenger_id', 'unsubscribed_status'],
  assignedMappings: [],
  toDelete: '',
  newContact: {
    team_id: '',
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    sticky_phone_number_id: '',
    twitter_id: '',
    fb_messenger_id: '',
    unsubscribed_status: false
  }
}
export default state
