const get_table_pasangan = (url, pegawai_id) => {
    let tbl_pasangan;
    tbl_pasangan = $("#tbl-pasangan").DataTable({
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
                pegawai_id: pegawai_id,
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
                name: "nama",
            },
            {
                data: "nik",
                name: "nik",
            },
            {
                data: "status_tunjangan",
                name: "status_tunjangan",
                render: function (data, type, row, meta) {
                    return data
                        ? '<span class="badge badge-success">Aktif</span>'
                        : '<span class="badge badge-danger">Non Aktif</span>';
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
                targets: [0, -1, -2],
            },
        ],
        order: [[1, "asc"]],
    });

    tbl_pasangan.on("draw.dt", function () {
        var info = tbl_pasangan.page.info();
        tbl_pasangan
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
const get_table_anak = (url, pegawai_id) => {
    let tbl_anak;
    tbl_anak = $("#tbl-anak").DataTable({
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
                pegawai_id: pegawai_id,
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
                name: "nama",
            },
            {
                data: "nik",
                name: "nik",
            },
            {
                data: "status_tunjangan",
                name: "status_tunjangan",
                render: function (data, type, row, meta) {
                    return data
                        ? '<span class="badge badge-success">Aktif</span>'
                        : '<span class="badge badge-danger">Non Aktif</span>';
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
                targets: [0, -1, -2],
            },
        ],
        order: [[1, "asc"]],
    });

    tbl_anak.on("draw.dt", function () {
        var info = tbl_anak.page.info();
        tbl_anak
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

const show_pasangan = (id) => {
    $.ajax({
        url: "/pegawai/pasangan/" + id,
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
                $("#si_nama").val(response.result.nama);
                $("#si_nik").val(response.result.nik);
                $("#si_tempat_lahir").val(response.result.tempat_lahir);
                $("#si_tanggal_lahir").val(response.result.tanggal_lahir);
                $("#si_tanggal_kawin").val(response.result.tanggal_kawin);
                $("#si_jenis_kawin").val(response.result.jenis_kawin.nama);
                $("#si_no_buku_nikah").val(response.result.no_buku_nikah);
                $("#si_no_kartu").val(response.result.no_kartu);
                if (response.result.is_pns == 1) {
                    $("#si_is_pns").val("Aktif");
                } else {
                    $("#si_is_pns").val("Non Aktif");
                }
                $("#si_pendidikan").val(response.result.pendidikan.nama);
                $("#si_pekerjaan").val(response.result.pekerjaan);
                if (response.result.is_pns == 1) {
                    $("#si_status_tunjangan").val("Aktif");
                } else {
                    $("#si_status_tunjangan").val("Non Aktif");
                }
                $("#si_no_sk_cerai").val(response.result.no_sk_cerai);
                $("#si_tmt_sk_cerai").val(response.result.tmt_sk_cerai);
                $("#si_media_buku_nikah").attr(
                    "href",
                    "//" + response.result.media_buku_nikah
                );
                $("#foto_pasangan").html(
                    '<img src="//' +
                        response.result.media_foto_pasangan +
                        '" id="si_media_foto_pasangan" alt="Foto Pasangan" width="150"height="250"></img>'
                );
            }
        },
    });
};

const delete_pasangan = (id) => {
    Swal.fire({
        title: "Apakah anda yakin hapus diklat ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Hapus",
        confirmButtonColor: "#DC3444",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/pegawai/pasangan/" + id,
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
                        $("#tbl-pasangan").DataTable().ajax.reload();
                    }
                },
            });
        }
    });
};
