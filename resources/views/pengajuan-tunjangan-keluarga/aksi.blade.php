<a href="{{ route('pengajuan-tunjangan-keluarga.show', $id) }}" title="Lihat File">
    <i class="dropdown-icon fa fa-file"></i>
</a>

@if ($status == 2)
    <a href="{{ route('pengajuan-tunjangan-keluarga.edit', $id) }}"
        class="btn btn-sm btn-icon btn-warning on-default edit" title="Ubah">
        <i class="fa fa-pencil text-white"></i>
    </a>
@endif

@if ($status == 2)
    <button type="button" data-type="confirm" data-id="{{ $id }}"
        class="btn btn-sm btn-icon btn-danger on-default delete" title="Hapus"><i class="fa fa-trash"></i></button>
@endif
