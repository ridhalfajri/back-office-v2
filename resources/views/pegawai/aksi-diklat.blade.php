<div class="item-action dropdown ml-2">
    <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-align-justify"></i></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a href="javascript:void(0)" class="dropdown-item" onclick="show_diklat({{ $id }})" data-toggle="modal"
            data-target="#modal-detail-diklat" id="btn-detail-diklat"><i class="dropdown-icon fe fe-eye"></i>
            Lihat</a>
        <a href="{{ route('diklat.edit', $id) }}" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i>
            Edit</a>
        @if ($is_verified != true)
            @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 7 ||
                    auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)
                <a href="{{ route('diklat.verifikasi-sdmoh', $id) }}" class="dropdown-item"><i
                        class="dropdown-icon fe fe-check"></i>
                    Verifikasi</a>
            @endif
        @endif
        <a href="javascript:void(0)" onclick="delete_diklat({{ $id }})" class="dropdown-item"><i
                class="dropdown-icon fe fe-trash-2"></i>
            Hapus</a>
    </div>
</div>
