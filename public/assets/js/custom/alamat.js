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

const get_data_alamat = (tipe_alamat) => {
    $.ajax({
        url: "/pegawai/alamat-by-pegawai",
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
        },
        data: {
            pegawai_id: $("#pegawai_id").val(),
            tipe_alamat: tipe_alamat,
        },
        success: function (response) {
            if (response.result == null) {
                select_propinsi();
                $("#tipe_alamat").val(tipe_alamat);
            } else {
                set_data_edit(response);
            }
        },
    });
};
$("body").on("click", "#store-alamat", function (e) {
    e.preventDefault();
    $.ajax({
        url: "/pegawai/alamat",
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
        },
        data: {
            tipe_alamat: $("#tipe_alamat").val(),
            propinsi_id: $("#propinsi_id").val(),
            kota_id: $("#kota_id").val(),
            kecamatan_id: $("#kecamatan_id").val(),
            desa_id: $("#desa_id").val(),
            kode_pos: $("#kode_pos").val(),
            alamat: $("#alamat").val(),
            pegawai_id: $("#pegawai_id").val(),
        },
        success: function (response) {
            if (response.errors) {
                resetForm();
                const err = response.errors;
                if (err.propinsi_id) {
                    $("#error_propinsi_id").text(err.propinsi_id);
                }
                if (err.kota_id) {
                    $("#error_kota_id").text(err.kota_id);
                }
                if (err.kecamatan_id) {
                    $("#error_kecamatan_id").text(err.kecamatan_id);
                }
                if (err.desa_id) {
                    $("#error_desa_id").text(err.desa_id);
                }
                if (err.kode_pos) {
                    $("#error_kode_pos").text(err.kode_pos);
                }
                if (err.alamat) {
                    $("#error_alamat").text(err.alamat);
                }
                if (err.connection) {
                    Swal.fire({
                        title: "Gagal!",
                        text: response.errors.connection,
                        icon: "error",
                        confirmButtonText: "Tutup",
                    });
                }
            } else {
                resetForm(true);
                Swal.fire({
                    title: "Tersimpan!",
                    text: response.success,
                    icon: "success",
                    confirmButtonText: "Tutup",
                });
                setTimeout(function () {
                    window.location.href = "/pegawai/" + $("#pegawai_id").val();
                }, 1000);
            }
        },
    });
});
function resetForm(is_success = false) {
    $("#error_tipe_alamat").text("");
    $("#error_propinsi_id").text("");
    $("#error_kota_id").text("");
    $("#error_kecamatan_id").text("");
    $("#error_desa_id").text("");
    $("#error_kode_pos").text("");
    $("#error_alamat").text("");
}
