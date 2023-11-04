$("#modal-detail-diklat").on("show.bs.modal", (e) => {
    const id = $("#btn-detail-diklat").data("id");
    const url = $("#btn-detail-diklat").data("diklat");
    $.ajax({
        url: url,
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
        },
        data: {
            id: id,
        },
        success: function (response) {
            if (response.errors) {
                if (response.errors.data) {
                    Swal.fire({
                        title: "Gagal!",
                        text: response.errors.data,
                        icon: "error",
                        confirmButtonText: "Tutup",
                    });
                }
                if (response.errors.connection) {
                    Swal.fire({
                        title: "Gagal!",
                        text: response.errors.connection,
                        icon: "error",
                        confirmButtonText: "Tutup",
                    });
                }
            } else {
                $("#d_nama_jenis_diklat").val(
                    response.result.jenis_diklat.nama
                );
                $("#d_tanggal_mulai").val(response.result.tanggal_mulai);
                $("#d_tanggal_akhir").val(response.result.tanggal_akhir);
                $("#d_jam_pelajaran").val(response.result.jam_pelajaran);
                $("#d_lokasi").val(response.result.lokasi);
                $("#d_penyelenggaran").val(response.result.penyelenggaran);
                $("#d_no_sertifikat").val(response.result.no_sertifikat);
                $("#d_tanggal_sertifikat").val(
                    response.result.tanggal_sertifikat
                );
                $("#d_media_sertifikat").attr(
                    "href",
                    "//" + response.result.media_sertifikat
                );
            }
        },
    });
    $("#modal-detail-diklat").modal("show");
});
