$(document).ready(function () {
    $("#table_belumSelesai").DataTable();

    $("#table_uang").DataTable({
        order: [[0, "desc"]],
    });

    $("#table_pokok").DataTable({
        order: [[0, "desc"]],
    });

    $(".table_penerimaan").DataTable({
        order: [[0, "desc"]],
    });

    $("#table_riwayat").DataTable();
});
