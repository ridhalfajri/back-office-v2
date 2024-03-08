<?php

namespace App\Exports;
use App\Models\PegawaiRiwayatThr;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromCollection;

class DataExportPrt implements FromCollection, WithHeadings
{
    use Exportable;

    private $tahun;
    private $unitKerjaId;

    public function __construct($tahun, $unitKerjaId)
    {
        $this->tahun = $tahun;
        $this->unitKerjaId = $unitKerjaId;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = PegawaiRiwayatThr::select(DB::raw('CONCAT(p.nama_depan," ",p.nama_belakang) AS nama_pegawai'), 'p.nip', 'uk.nama as unit_kerja',
            'pegawai_riwayat_thr.nominal_gaji_pokok', 'pegawai_riwayat_thr.tunjangan_beras', 'pegawai_riwayat_thr.tunjangan_pasangan',
            'pegawai_riwayat_thr.tunjangan_anak', 'pegawai_riwayat_thr.tunjangan_jabatan', 'pegawai_riwayat_thr.tunjangan_kinerja',
            'pegawai_riwayat_thr.total_thr', 'pegawai_riwayat_thr.tahun')
            ->join('pegawai as p','p.id','=','pegawai_riwayat_thr.pegawai_id')
            //->join('pegawai_riwayat_jabatan as prj', 'prj.pegawai_id', '=', 'pegawai_riwayat_umak.pegawai_id')
            ->join('pegawai_riwayat_jabatan as prj', function ($join) {
                $join->on('prj.pegawai_id','=','pegawai_riwayat_thr.pegawai_id')
                    ->where('prj.is_now','=',1)
                    ->where('prj.is_plt', '=', 0)
                    ;
            })
            ->join('jabatan_unit_kerja as juk', 'juk.id', '=', 'prj.jabatan_unit_kerja_id')
            ->join('hirarki_unit_kerja as huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
            ->leftJoin('unit_kerja as uk', function ($join) {
                $join->on('uk.id', '=', 'huk.child_unit_kerja_id')
                    ->where('uk.is_active','=','Y')
                    ;
            })
            //
            ->where('pegawai_riwayat_thr.tahun', '=', $this->tahun)
            ->orderBy('uk.id','asc')
            ->orderBy('p.nama_depan','asc')
            ->get();

            if(null != $this->unitKerjaId || '' != $this->unitKerjaId){
                $data->where('uk.id', '=', $this->unitKerjaId);
            }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Nama Pegawai',
            'NIP',
            'Unit Kerja',
            'Gapok',
            'Tunjangan Beras',
            'Tunjangan Pasangan',
            'Tunjangan Anak',
            'Tunjangan Jabatan',
            'Tunjangan Kinerja',
            'Total THR',
            'Tahun',
            // ... tambahkan judul kolom lainnya
        ];
    }
}
