const create_penghargaan = () => {
    get_data_penghargaan();
    $("#id_penghargaan").val("");
    $("#penghargaan_id").val("");
    $("#no_sk").val("");
    $("#tanggal_sk").val("");
    $("#media_sk_penghargaan").val(null);
    $(this).find("#form2")[0].reset();
};
const get_data_penghargaan = (penghargaan_id = null) => {
    $.ajax({
        url: "/data/penghargaan/get-penghargaan",
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
        },
        data: {
            penghargaan_id: penghargaan_id,
        },
        success: function (response) {
            $("#penghargaan_id").multiselect("destroy");

            $("#penghargaan_id").html(response);
            $("#penghargaan_id").multiselect({
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                maxHeight: 200,
            });
        },
    });
};

const get_table_penghargaan = (url, pegawai_id) => {
    let tbl_penghargaan;
    tbl_penghargaan = $("#tbl-penghargaan").DataTable({
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
                name: "penghargaan.nama",
            },
            {
                data: "no_sk",
                name: "no_sk",
            },
            {
                data: "tanggal_sk",
                name: "tanggal_sk",
            },
            {
                data: "tahun",
                name: "tahun",
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

    tbl_penghargaan.on("draw.dt", function () {
        var info = tbl_penghargaan.page.info();
        tbl_penghargaan
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

$("#form-penghargaan").submit(function (e) {
    e.preventDefault();
    const form = $(this);
    const actionUrl = form.attr("action");
    $.ajax({
        type: "POST",
        url: actionUrl,
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            console.log(response);
            if (response.errors) {
                resetForm();
                const err = response.errors;
                if (err.penghargaan_id) {
                    $("#error_penghargaan_id").text(err.penghargaan_id);
                }
                if (err.no_sk) {
                    $("#error_no_sk").text(err.no_sk);
                }
                if (err.tanggal_sk) {
                    $("#error_tanggal_sk").text(err.tanggal_sk);
                }
                if (err.tahun) {
                    $("#error_tahun").text(err.tahun);
                }
                if (err.media_sk_penghargaan) {
                    $("#error_media_sk_penghargaan").text(
                        err.media_sk_penghargaan
                    );
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
                Swal.fire({
                    title: "Tersimpan!",
                    text: response.success,
                    icon: "success",
                    confirmButtonText: "Tutup",
                });
                $("#modal-tambah-penghargaan").modal("hide");
                $("#tbl-penghargaan").DataTable().ajax.reload();
            }
        },
    });
});

const edit_penghargaan = (id) => {
    $.ajax({
        type: "GET",
        url: "/pegawai/penghargaan/" + id + "/edit",
        data: {
            id: id,
        },
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            console.log(response.result);
            get_data_penghargaan(response.result.penghargaan_id);
            $("#id_penghargaan").val(response.result.id);
            $("#no_sk").val(response.result.no_sk);
            $("#tanggal_sk").val(response.result.tanggal_sk);
            $("#tahun").val(response.result.tahun);
            if (response.result.media_sk_penghargaan) {
                $("#download_media_sk_penghargaan").attr(
                    "href",
                    "//" + response.result.media_sk_penghargaan
                );
            }
            $("#modal-tambah-penghargaan").modal("show");
        },
    });
};

function resetForm(is_success = false) {
    $("#error_penghargaan_id").text("");
    $("#error_no_sk").text("");
    $("#error_tanggal_sk").text("");
    $("#error_tahun").text("");
    $("#error_media_sk_penghargaan").text("");
}

const download_sk_penghargaan = (id) => {
    $.ajax({
        type: "POST",
        url: "/pegawai/penghargaan/sk-penghargaan",
        data: {
            id: id,
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
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
            } else if (response.result) {
                window.location.href = "//" + response.result;
            }
        },
    });
};

const delete_penghargaan = (id) => {
    Swal.fire({
        title: "Apakah anda yakin hapus pengharagaan ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Hapus",
        confirmButtonColor: "#DC3444",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/pegawai/penghargaan/" + id,
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
                        $("#tbl-penghargaan").DataTable().ajax.reload();
                    }
                },
            });
        }
    });
};

$(".dropify").dropify();

const drEvent = $("#media_sk_penghargaan").dropify();
drEvent.on("dropify.beforeClear", function (event, element) {});

drEvent.on("dropify.afterClear", function (event, element) {
    Swal.fire({
        position: "center",
        icon: "success",
        title: "File berhasil dihapus!",
        showConfirmButton: false,
        timer: 1500,
    });
});
