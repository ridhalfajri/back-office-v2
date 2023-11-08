<div class="item-action dropdown ml-2">
    <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-align-justify"></i></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a href="javascript:void(0)" class="dropdown-item btn-penghargaan" data-toggle="modal"
            data-target="#modal-penghargaan" id="btn-domisili" onclick="edit_penghargaan({{ $id }})"><i
                class="dropdown-icon fa fa-edit"></i>
            Ubah</a>
        <a href="javascript:void(0)" onclick="download_sk_penghargaan({{ $id }})" class="dropdown-item"><i
                class="dropdown-icon fe fe-download"></i>Download</a>
        <a href="javascript:void(0)" onclick="delete_penghargaan({{ $id }})" class="dropdown-item"><i
                class="dropdown-icon fe fe-trash-2"></i>Hapus</a>
    </div>
</div>
