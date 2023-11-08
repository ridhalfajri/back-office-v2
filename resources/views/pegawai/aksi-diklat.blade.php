<div class="item-action dropdown ml-2">
    <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-align-justify"></i></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a href="javascript:void(0)" class="dropdown-item" onclick="show_diklat({{ $id }})" data-toggle="modal"
            data-target="#modal-detail-diklat" id="btn-detail-diklat"><i class="dropdown-icon fe fe-eye"></i>
            Lihat</a>
        <a href="{{ route('diklat.edit', $id) }}" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i>
            Edit</a>
        <a href="javascript:void(0)" onclick="delete_diklat({{ $id }})" class="dropdown-item"><i
                class="dropdown-icon fe fe-trash-2"></i>
            Hapus</a>
    </div>
</div>
