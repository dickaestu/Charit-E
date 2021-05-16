<template>
  <!-- Nav Item - Alerts -->
  <li class="nav-item dropdown no-arrow mx-1">
    <a
      class="nav-link dropdown-toggle"
      href="#"
      id="alertsDropdown"
      role="button"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
    >
      <i class="fas fa-bell fa-fw"></i>
      <!-- Counter - Alerts -->
      <span class="badge badge-danger badge-counter">{{
        permintaanLogistikVerif.length
      }}</span>
    </a>
    <!-- Dropdown - Alerts -->
    <div
      class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
      aria-labelledby="alertsDropdown"
      style="max-height: 300px; overflow: auto"
    >
      <h6 class="dropdown-header">Notifikasi</h6>
      <a
        v-for="(notification, index) in permintaanLogistikVerif"
        :key="index"
        class="dropdown-item d-flex align-items-center"
        href="/logistik/data-permintaan"
      >
        <div class="mr-3">
          <div class="icon-circle bg-warning">
            <i class="fas fa-exclamation-triangle text-white"></i>
          </div>
        </div>
        <div>
          <div class="small text-gray-500">
            {{ notification.created_at | moment("from") }}
          </div>
          Permintaan Barang , ID Permintaan :
          {{ notification.id_permintaan_barang }}
        </div>
      </a>

      <div
        class="dropdown-item d-flex align-items-center justify-content-center"
        v-if="permintaanLogistikVerif.length < 1"
      >
        <div>Tidak Ada Notifikasi</div>
      </div>
    </div>
  </li>
</template>

<script>
export default {
  data() {
    return {
      permintaanLogistikVerif: [],
    };
  },
  created() {
    Echo.channel(`permintaanLogistikVerified`).notification((notification) => {
      this.permintaanLogistikVerif.unshift(notification);
    });
  },

  mounted() {
    axios.get("/logistik/data-permintaan/verified").then((response) => {
      this.permintaanLogistikVerif = response.data;
    });
  },
};
</script>
