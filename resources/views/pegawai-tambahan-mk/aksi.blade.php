<a href="{{ route('pegawai-tambahan-mk.show', $id) }}"
    title="Lihat File Pengajuan PMK dan File SK">
    <i class="dropdown-icon fa fa-file"></i>
</a>

@if ($status != 3)
<a href="{{ route('pegawai-tambahan-mk.edit', $id) }}" class="btn btn-sm btn-icon btn-warning on-default edit"
    title="Setujui">
    <i class="fa fa-check text-white"></i>
</a>
@endif

@if ($status != 2)
<button type="button" data-type="confirm" data-id="{{ $id }}"
    class="btn btn-sm btn-icon btn-danger on-default delete" title="Batalkan"><i class="fa fa-times"></i></button>
@endif