{{-- <a href="{{ route('pegawai-tambahan-bpjs.show', $id) }}" title="Lihat File Pengajuan Tambahan BPJS dan Kartu BPJS">
    <i class="dropdown-icon fa fa-file"></i>
</a> --}}

<a href="{{ route('pegawai-tambahan-bpjs.edit', $id) }}" class="btn btn-sm btn-icon btn-warning on-default edit"
    title="Persetujuan">
    <i class="fa fa-pencil text-white"></i>
</a>

<button type="button" data-type="confirm" data-id="{{ $id }}"
    class="btn btn-sm btn-icon btn-danger on-default delete" title="Hapus"><i class="fa fa-times"></i></button>

@if ($status == 3 || $status == 4)
    <button type="button" data-id="{{ $id }}" class="btn btn-sm btn-icon btn-success on-default kirim-bpjs"
        title="Daftar Ke BPJS"><i class="fa fa-check"></i></button>
@endif
