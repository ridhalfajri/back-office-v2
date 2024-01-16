<a href="{{ route('pegawai-tambahan-bpjs.show', $id) }}"
    title="Lihat File Pengajuan Tambahan BPJS dan Kartu BPJS">
    <i class="dropdown-icon fa fa-file"></i>
</a>

@if ($status != 3)
<a href="{{ route('pegawai-tambahan-bpjs.edit', $id) }}" class="btn btn-sm btn-icon btn-warning on-default edit"
    title="Setujui">
    <i class="fa fa-check text-white"></i>
</a>
@endif

@if ($status != 2)
<button type="button" data-type="confirm" data-id="{{ $id }}"
class="btn btn-sm btn-icon btn-danger on-default delete" title="Batalkan"><i class="fa fa-times"></i></button>
@endif
