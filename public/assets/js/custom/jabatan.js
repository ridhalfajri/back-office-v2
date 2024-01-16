const show_jabatan = (id) => {
    $.ajax({
        // url: "/pegawai/jabatan/" + id,
        // url: "/pegawai/jabatan/",
        // type: "GET",
        // success: function (response) {
        //     if (response.errors) {
        //         if (response.errors.data) {
        //             Swal.fire({
        //                 title: "Gagal!",
        //                 text: response.errors.data,
        //                 icon: "error",
        //                 confirmButtonText: "Tutup",
        //             });
        //         }
        //         if (response.errors.connection) {
        //             Swal.fire({
        //                 title: "Gagal!",
        //                 text: response.errors.connection,
        //                 icon: "error",
        //                 confirmButtonText: "Tutup",
        //             });
        //         }
        //     } else {
        //         $("#d_nama_jenis_diklat").val(
        //             response.result.jenis_diklat.nama
        //         );
        //         $("#d_tanggal_mulai").val(response.result.tanggal_mulai);
        //         $("#d_tanggal_akhir").val(response.result.tanggal_akhir);
        //         $("#d_jam_pelajaran").val(response.result.jam_pelajaran);
        //         $("#d_lokasi").val(response.result.lokasi);
        //         $("#d_penyelenggaran").val(response.result.penyelenggaran);
        //         $("#d_no_sertifikat").val(response.result.no_sertifikat);
        //         $("#d_tanggal_sertifikat").val(
        //             response.result.tanggal_sertifikat
        //         );
        //         $("#d_media_sertifikat").attr(
        //             "href",
        //             "//" + response.result.media_sertifikat
        //         );
        //     }
        // },
    });
};
const get_table_jabatan = (url) => {
    let tbl_jabatan;
    tbl_jabatan = $("#tbl-riwayat-jabatan").DataTable({
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
                data: "tipe_jabatan",
                name: "ttj.tipe_jabatan",
                class: "text-center",
            },
            {
                data: "nama_unit_kerja",
                name: "uk.nama",
                class: "text-center",
            },
            {
                data: "tanggal_sk",
                name: "tanggal_sk",
                class: "text-center",
            },
            {
                data: "tanggal_pelantikan",
                name: "tanggal_pelantikan",
                class: "text-center",
            },
            {
                data: "tmt_jabatan",
                name: "tmt_jabatan",
                class: "text-center",
            },
            {
                data: "is_plt",
                name: "is_plt",
                class: "text-center",
                render: function (data, type, row) {
                    switch (data) {
                        case 1:
                            return '<span class="badge badge-pill badge-primary">YA</span>';
                            break;
                        case 0:
                            return '<span class="badge badge-pill badge-dark">TIDAK</span>';
                            break;
                    }
                },
            },
            {
                data: "is_now",
                name: "is_now",
                class: "text-center",
                render: function (data, type, row) {
                    switch (data) {
                        case 1:
                            return '<span class="badge badge-pill badge-success">AKTIF</span>';
                            break;
                        case 0:
                            return '<span class="badge badge-pill badge-dark">TIDAK AKTIF</span>';
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

    tbl_jabatan.on("draw.dt", function () {
        var info = tbl_jabatan.page.info();
        tbl_jabatan
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
// const delete_diklat = (id) => {
//     Swal.fire({
//         title: "Apakah anda yakin hapus diklat ini?",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonText: "Hapus",
//         confirmButtonColor: "#DC3444",
//     }).then((result) => {
//         if (result.isConfirmed) {
//             $.ajax({
//                 url: "/pegawai/diklat/" + id,
//                 type: "DELETE",
//                 headers: {
//                     "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr(
//                         "content"
//                     ),
//                 },
//                 data: {
//                     id: id,
//                 },
//                 success: function (response) {
//                     if (response.errors) {
//                         if (response.errors) {
//                             Swal.fire({
//                                 title: "Gagal!",
//                                 text: response.errors.connection,
//                                 icon: "error",
//                                 confirmButtonText: "Tutup",
//                             });
//                         }
//                     } else if (response.success) {
//                         Swal.fire({
//                             title: "Dihapus!",
//                             text: response.success,
//                             icon: "success",
//                             confirmButtonText: "Tutup",
//                         });
//                         $("#tbl-diklat").DataTable().ajax.reload();
//                     }
//                 },
//             });
//         }
//     });
// };
