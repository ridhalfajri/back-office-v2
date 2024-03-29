<?php

namespace App\Exports;

use App\Models\PegawaiRekening;
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
        $data = PegawaiRiwayatThr::select(DB::raw('CONCAT(p.nama_depan," ",p.nama_belakang) AS nama_pegawai'),
        DB::raw('CONCAT("\'",p.nip) AS nip'), 'uk.nama as unit_kerja',
            'pegawai_riwayat_thr.nominal_gaji_pokok', 'pegawai_riwayat_thr.tunjangan_beras', 'pegawai_riwayat_thr.tunjangan_pasangan',
            'pegawai_riwayat_thr.tunjangan_anak', 'pegawai_riwayat_thr.tunjangan_jabatan', 'pegawai_riwayat_thr.tunjangan_kinerja',
            'pegawai_riwayat_thr.total_thr', 'pegawai_riwayat_thr.tahun'
            )
            ->selectSub(function ($query) {
                $query->select(DB::raw("CONCAT(b.nama, ' - ', pr.no_rekening)"))
                    ->from('pegawai_rekening as pr')
                    ->join('bank as b', 'b.id', '=', 'pr.bank_id')
                    ->whereColumn('pr.pegawai_id', 'pegawai_riwayat_thr.pegawai_id')
                    ->where('pr.tipe_rekening', '=', 'Gaji & Umak')
                    ->limit(1);
            }, 'rekening_gaji')
            ->selectSub(function ($query) {
                $query->select(DB::raw("CONCAT(b.nama, ' - ', pr.no_rekening)"))
                    ->from('pegawai_rekening as pr')
                    ->join('bank as b', 'b.id', '=', 'pr.bank_id')
                    ->whereColumn('pr.pegawai_id', 'pegawai_riwayat_thr.pegawai_id')
                    ->where('pr.tipe_rekening', '=', 'Tukin')
                    ->limit(1);
            }, 'rekening_tukin')
            //->join('pegawai as p','p.id','=','pegawai_riwayat_thr.pegawai_id')
            ->join('pegawai as p', function ($join) {
                $join->on('p.id','=','pegawai_riwayat_thr.pegawai_id')
                    ->whereIn('p.status_pegawai_id', array(1, 4)) //PNS, CPNS
                    ->where('p.status_dinas', 1)
                    ->whereIn('p.jenis_pegawai_id', array(1, 21, 20))
                    ;
            })
            //->join('pegawai_riwayat_jabatan as prj', 'prj.pegawai_id', '=', 'pegawai_riwayat_umak.pegawai_id')
            ->leftJoin('pegawai_riwayat_jabatan as prj', function ($join) {
                $join->on('prj.pegawai_id','=','pegawai_riwayat_thr.pegawai_id')
                    ->where('prj.is_now','=',1)
                    ->where('prj.is_plt', '=', 0)
                    ;
            })
            ->leftJoin('jabatan_unit_kerja as juk', 'juk.id', '=', 'prj.jabatan_unit_kerja_id')
            ->leftJoin('hirarki_unit_kerja as huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
            ->leftJoin('unit_kerja as uk', function ($join) {
                $join->on('uk.id', '=', 'huk.child_unit_kerja_id')
                    ->where('uk.is_active','=','Y')
                    ;
            })
            //
            ->where('pegawai_riwayat_thr.tahun', '=', $this->tahun)
            ->orderBy('p.jenis_pegawai_id','asc')
            ->orderBy('uk.id','asc')
            ->orderBy('p.nama_depan','asc');

            if(null != $this->unitKerjaId || '' != $this->unitKerjaId){
                $data->where('uk.id', '=', $this->unitKerjaId);
            }

        return $data->get();
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
            'No. Rek Gaji',
            'No. Rek Tukin',
            // ... tambahkan judul kolom lainnya
        ];
    }
}
