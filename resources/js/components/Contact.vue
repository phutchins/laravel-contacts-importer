<template>
  <tr>
    <th>{{contact.first_name}}</th>
    <th>{{contact.last_name}}</th>
    <th>{{contact.phone}}</th>
    <th>{{contact.email}}</th>
    <th>{{contact.twitter_id}}</th>
    <th>{{contact.fb_messenger_id}}</th>
    <th>{{contact.custom_attributes}}</th>
  </tr>
</template>
<script>
export default {
  name: "Contact",
  props: ["contact"]
};
</script>
