require('./bootstrap');

window.Vue = require('vue');

Vue.component('contacts-app', require('./components/ContactsApp.vue').default);
Vue.component('contacts-list', require('./components/ContactsList.vue').default);
Vue.component('import-contacts', require('./components/ImportContacts.vue').default);
Vue.component('assign-fields', require('./components/AssignFields.vue').default);
Vue.component('mapping-preview', require('./components/MappingPreview').default);
Vue.component('assign-fields-table-row', require('./components/AssignFieldsTableRow').default);
Vue.component('preview-mapping-table-row', require('./components/PreviewMappingTableRow').default);
Vue.component('contact', require('./components/Contact.vue').default);
import store from '../js/store';

const app = new Vue({
  el: '#app',
  store
});

console.log('Loaded app.js!');
