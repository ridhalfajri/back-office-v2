const get_table_tmt_gaji = (url, pegawai_id) => {
    let tbl_tmt_gaji;
    tbl_tmt_gaji = $("#tbl-tmt-gaji").DataTable({
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
                data: "tmt_gaji",
                name: "tmt_gaji",
            },
            {
                data: "nominal",
                name: "gaji.nominal",
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

    tbl_tmt_gaji.on("draw.dt", function () {
        var info = tbl_tmt_gaji.page.info();
        tbl_tmt_gaji
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
$("#modal-tmt-gaji").on("show.bs.modal", function (e) {
    resetForm();
    $("#modal-tmt-gaji").modal("show");
});
const get_data_gaji = (gaji_id = null) => {
    $.ajax({
        url: "/gaji/get-gaji",
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
        },
        data: {
            gaji_id: gaji_id,
        },
        success: function (response) {
            $("#gaji_id").multiselect("destroy");

            $("#gaji_id").html(response);
            $("#gaji_id").multiselect({
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                maxHeight: 200,
            });
        },
    });
};
$("#form-tmt-gaji").submit(function (e) {
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
                resetFormTmtGaji();
                const err = response.errors;
                if (err.gaji_id) {
                    console.log(err.gaji_id);
                    $("#error_gaji_id").text(err.gaji_id);
                }
                if (err.tmt_gaji) {
                    $("#error_tmt_gaji").text(err.tmt_gaji);
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
                $("#modal-tmt-gaji").modal("hide");
                $("#tbl-tmt-gaji").DataTable().ajax.reload();
            }
        },
    });
});
function resetFormTmtGaji(is_success = false) {
    $("#error_gaji_id").text("");
    $("#error_tmt_gaji").text("");
}
$(".datepicker_tmt").datepicker({
    format: "dd-mm-yyyy",
});

const edit_tmt_gaji = (id) => {
    $.ajax({
        url: "/pegawai/tmt-gaji/tmt-gaji-by-id",
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf_token"]').attr("content"),
        },
        data: {
            id: id,
        },
        success: function (response) {
            get_data_gaji(response.result.gaji_id);
            $("#date_tmt_gaji").val(response.result.tmt_gaji);
            $("#tmt_gaji_id").val(response.result.id);
        },
    });
};
const create_tmt_gaji = () => {
    get_data_gaji();
    $("#date_tmt_gaji").val("");
    $("#tmt_gaji_id").val("");
};

const delete_tmt_gaji = (id) => {
    Swal.fire({
        title: "Apakah Anda Yakin Hapus TMT Gaji Ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Hapus",
        confirmButtonColor: "#DC3444",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/pegawai/tmt-gaji/" + id,
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
                        $("#tbl-tmt-gaji").DataTable().ajax.reload();
                    }
                },
            });
        }
    });
};
