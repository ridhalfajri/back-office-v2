const get_table_pendidikan = (url) => {
    let tbl_pendidikan;
    tbl_pendidikan = $("#tbl-pendidikan").DataTable({
        processing: true,
        destroy: true,
        serverSide: true,
        deferRender: true,
        responsive: true,
        pageLength: 10,
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        ajax: {
            url: url,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
            },
            data: {
                pegawai_id: $("#pegawai_id").val(),
            },
        },
        columns: [
            {
                data: "no",
                name: "no",
                class: "text-center",
            },
            {
                data: "nama",
                name: "pendidikan.nama",
            },
            {
                data: "nama_instansi",
                name: "nama_instansi",
            },
            {
                data: "tanggal_ijazah",
                name: "tanggal_ijazah",
            },
            {
                data: "is_verified",
                name: "is_verified",
                render: function (data, type, row) {
                    switch (data) {
                        case 1:
                            return '<span class="badge badge-pill badge-success">Sukses</span>';
                            break;
                        case 0:
                            return '<span class="badge badge-pill badge-dark">Belum</span>';
                            break;
                    }
                },
            },
            {
                data: "aksi",
                name: "aksi",
                class: "text-center actions",
            },
        ],
        columnDefs: [
            {
                sortable: false,
                searchable: false,
                targets: [0, -1],
            },
        ],
        order: [[1, "asc"]],
    });

    tbl_pendidikan.on("draw.dt", function () {
        var info = tbl_pendidikan.page.info();
        tbl_pendidikan
            .column(0, {
                search: "applied",
                order: "applied",
                page: "applied",
            })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
    });
};
const delete_pendidikan = (id) => {
    Swal.fire({
        title: "Apakah anda yakin hapus pendidikan ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Hapus",
        confirmButtonColor: "#DC3444",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/pegawai/pendidikan/" + id,
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr(
                        "content"
                    ),
                },
                data: {
                    id: id,
                },
                success: function (response) {
                    if (response.errors) {
                        if (response.errors) {
                            Swal.fire({
                                title: "Gagal!",
                                text: response.errors.connection,
                                icon: "error",
                                confirmButtonText: "Tutup",
                            });
                        }
                    } else if (response.success) {
                        Swal.fire({
                            title: "Dihapus!",
                            text: response.success,
                            icon: "success",
                            confirmButtonText: "Tutup",
                        });
                        $("#tbl-pendidikan").DataTable().ajax.reload();
                    }
                },
            });
        }
    });
};
const show_pendidikan = (id) => {
    $.ajax({
        url: "/pegawai/pendidikan/" + id,
        type: "GET",
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
                $("#p_pendidikan").val(response.result.pendidikan.nama);
                $("#p_nama_instansi").val(response.result.nama_instansi);
                $("#p_propinsi").val(response.result.propinsi.nama);
                $("#p_kota").val(response.result.kota.nama);
                $("#p_alamat").val(response.result.alamat);
                $("#p_kode_gelar_depan").val(response.result.kode_gelar_depan);
                $("#p_kode_gelar_belakang").val(
                    response.result.kode_gelar_belakang
                );
                $("#p_no_ijazah").val(response.result.no_ijazah);
                $("#p_tanggal_ijazah").val(response.result.tanggal_ijazah);
                $("#p_media_ijazah").attr(
                    "href",
                    "//" + response.result.media_ijazah
                ).attr("target", "_blank");
            }
        },
    });
};
$("#modal-detail-pendidikan").on("show.bs.modal", (e) => {
    const id = $(".btn-detail-pendidikan").data("id");
    const url = $(".btn-detail-pendidikan").data("pendidikan");
    console.log(id);

    $("#modal-detail-pendidikan").modal("show");
});
