<template>
  <span class="badge badge-pill badge-sm badge-primary">{{
    permintaanLogistikUnverif.length
  }}</span>
</template>

<script>
export default {
  props: ["user"],

  data() {
    return {
      permintaanLogistikUnverif: [],
    };
  },
  created() {
    Echo.private(`App.User.${this.user.user_id}`).notification(
      (notification) => {
        this.permintaanLogistikUnverif.unshift(notification);
        console.log(notification);
      }
    );
  },

  mounted() {
    axios.get("/admin/data-permintaan/unverif").then((response) => {
      this.permintaanLogistikUnverif = response.data;
    });
  },
};
</script>
