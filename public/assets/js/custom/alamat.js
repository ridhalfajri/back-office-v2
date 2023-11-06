$(".select-filter").multiselect({
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    maxHeight: 200,
});
$("#modal-alamat").on("show.bs.modal", function (e) {
    resetForm();
    $("#modal-alamat").modal("show");
});
const domisili = function () {
    get_data_alamat("Domisili");
};
const asal = function () {
    get_data_alamat("Asal");
};
const set_data_edit = (response) => {
    select_propinsi(response.result.propinsi_id);
    select_kota(response.result.propinsi_id, response.result.kota_id);
    select_kecamatan(response.result.kota_id, response.result.kecamatan_id);
    select_desa(response.result.kecamatan_id, response.result.desa_id);
    $("#tipe_alamat").val(response.result.tipe_alamat);
    $("#kode_pos").val(response.result.kode_pos);
    $("#alamat").val(response.result.alamat);
};
