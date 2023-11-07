<div class="item-action dropdown ml-2">
    <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-align-justify"></i></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a href="javascript:void(0)" class="dropdown-item" data-id="{{ $id }}"
            data-pendidikan="{{ route('pendidikan.get-pendidikan-by-id') }}" data-toggle="modal"
            data-target="#modal-detail-pendidikan" id="btn-pendidikan-diklat"><i class="dropdown-icon fe fe-eye"></i>
            Lihat</a>
        <a href="{{ route('pendidikan.edit', $id) }}" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i>
            Edit</a>
        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-trash-2"></i>
            Hapus</a>
    </div>
</div>
