<div class="item-action dropdown ml-2">
    <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-align-justify"></i></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-eye"></i>
            Lihat</a>
        @if ($status_pengajuan_cuti_id == 1)
            <a href="{{ route('cuti.pengajuan-cuti-edit', $id) }}" class="dropdown-item"><i
                    class="dropdown-icon fa fa-edit"></i>
                Edit</a>
            <a href="javascript:void(0)" onclick="delete_cuti({{ $id }})" class="dropdown-item"><i
                    class="dropdown-icon fe fe-trash-2"></i>
                Hapus</a>
        @endif


    </div>
</div>
