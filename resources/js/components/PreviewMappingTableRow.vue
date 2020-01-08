<template>
  <tr>
    <th>{{ sampleContactField }}</th>
    <th>
      <div class="dropdown" :id="index">
        <button class="btn btn-primary dropdown-toggle" type="button" :id="[`dropdownMenuButton-${index}`]" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Field</button>
        <div class="dropdown-menu dropdown-primary">
          <a v-for="headerItem in this.$store.state.csvHeaders" class="dropdown-item" href="#">{{headerItem}}</a>
        </div>
      </div>
    </th>
  </tr>
</template>

<script>
import store from "../store";


export default {
  name: "AssignFieldsTableRow",
  props: ["index", "sampleContactField"],
  mounted: function() {
    $(".dropdown .dropdown-menu a").click(function(){
      $(this).parents(".dropdown").find('.btn').html($(this).text() + '<span class="caret"></span>');
      $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
    });
  }
};
</script>
