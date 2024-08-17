<div class="item-action dropdown ml-2">
    @if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 7 ||
            auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)
        <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-align-justify"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a href="javascript:void(0)" class="dropdown-item btn-tmt-gaji" data-toggle="modal"
                data-target="#modal-tmt-gaji" id="btn-domisili" onclick="edit_tmt_gaji({{ $id }})"><i
                    class="dropdown-icon fa fa-edit"></i>
                Ubah</a>
            <a href="javascript:void(0)" onclick="delete_tmt_gaji({{ $id }})" class="dropdown-item"><i
                    class="dropdown-icon fe fe-trash-2"></i>Hapus</a>
        </div>
    @endif
</div>
