<div class="item-action dropdown ml-2">
    <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-align-justify"></i></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a href="javascript:void(0)" class="dropdown-item btn-detail-pendidikan"
            onclick="show_pendidikan({{ $id }})" data-toggle="modal" data-target="#modal-detail-pendidikan"><i
                class="dropdown-icon fe fe-eye"></i>
            Lihat</a>
        <a href="{{ route('pendidikan.edit', $id) }}" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i>
            Edit</a>
        @if ($is_verified != true)
            @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 7 ||
                    auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)
                <a href="{{ route('pendidikan.verifikasi-sdmoh', $id) }}" class="dropdown-item"><i
                        class="dropdown-icon fe fe-check"></i>
                    Verifikasi</a>
            @endif
        @endif
        <a href="javascript:void(0)" onclick="delete_pendidikan({{ $id }})" class="dropdown-item"><i
                class="dropdown-icon fe fe-trash-2"></i>
            Hapus</a>
    </div>
</div>
