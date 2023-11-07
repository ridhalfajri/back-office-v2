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
