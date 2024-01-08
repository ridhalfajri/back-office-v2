<div class="item-action dropdown ml-2">
    <a href="javascript:void(0)" data-toggle="dropdown"><i class="fe fe-align-justify"></i></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a @if ($id_thp != null) href="{{ route('penghasilan.gaji-detail', $id_thp) }}" @endif
            class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i>
            Riwayat Gaji</a>
        <a @if ($id_thp != null) href="{{ route('penghasilan.tukin-detail', $id_thp) }}" @endif
            class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i>
            Riwayat Tukin</a>
        <a @if ($id_umak != null) href="{{ route('penghasilan.umak-detail', $id_umak) }}" @endif
            class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i>
            Riwayat Uang Makan</a>
    </div>
</div>
