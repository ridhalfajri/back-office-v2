{{-- <a href="{{ route('ruang-rapat.edit', $id) }}" class="btn btn-sm btn-icon btn-warning on-default edit"
    title="Ubah">
    <i class="fa fa-pencil text-white"></i>
</a> --}}
@if (auth()->user()->pegawai_id == $pegawai_id)
    <button type="button" data-type="confirm" data-id="{{ $id }}"
    class="btn btn-sm btn-icon btn-danger on-default delete" title="Hapus"><i class="fa fa-trash"></i></button>
@endif