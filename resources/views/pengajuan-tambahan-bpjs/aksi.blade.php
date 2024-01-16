<a href="{{ route('pengajuan-tambahan-bpjs.show', $id) }}"
    title="Lihat File Kartu BPJS dan Pengajuan Tambahan BPJS">
    <i class="dropdown-icon fa fa-file"></i>
</a>

@if ($status != 3)
<button type="button" data-type="confirm" data-id="{{ $id }}"
class="btn btn-sm btn-icon btn-danger on-default delete" title="Hapus"><i class="fa fa-trash"></i></button>
@endif
