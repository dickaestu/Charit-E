<template>
  <div>
    <li class="list-group-item">
      <i class="flaticon-man-user"></i> Korban<span class="float-right">
        {{ jumlahKorban }} Orang</span
      >
    </li>
    <li class="list-group-item">
      <i class="flaticon-human-outline-with-heart"></i> Korban Jiwa<span
        class="float-right"
      >
        {{ jumlahKorbanJiwa }} Orang</span
      >
    </li>
  </div>
</template>

<script>
export default {
  props: ["jumlah_korban", "jumlah_korban_jiwa", "info_posko"],
  data() {
    return {
      jumlahKorban: this.jumlah_korban,
      jumlahKorbanJiwa: this.jumlah_korban_jiwa,
    };
  },

  created() {
    Echo.channel(`infoKorban`).notification((notification) => {
      if (this.info_posko.id_info_posko == notification.id_info_posko) {
        this.jumlahKorban = notification.jumlah_korban;
        this.jumlahKorbanJiwa = notification.jumlah_korban_jiwa;
      }
    });

    // let evtSource = new EventSource("/getEventStream", {
    //   withCredentials: true,
    // });

    // evtSource.onmessage = function (e) {
    //   let data = JSON.parse(e.data);
    //   console.log(data);
    // };
  },
};
</script>
