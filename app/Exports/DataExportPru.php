<?php

namespace App\Exports;
use App\Models\PegawaiRiwayatUmak;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromCollection;

class DataExportPru implements FromCollection, WithHeadings
{
    use Exportable;

    private $bulan;
    private $tahun;
    private $unitKerjaId;

    public function __construct($bulan, $tahun, $unitKerjaId)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->unitKerjaId = $unitKerjaId;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = PegawaiRiwayatUmak::select(DB::raw('CONCAT(p.nama_depan," ",p.nama_belakang) AS nama_pegawai'), 'p.nip', 'uk.nama as unit_kerja', 'um.nominal',
            'pegawai_riwayat_umak.jumlah_hari_masuk', 'pegawai_riwayat_umak.total', 'pegawai_riwayat_umak.is_double', DB::raw('MONTHNAME(STR_TO_DATE(pegawai_riwayat_umak.bulan, "%m")) as nama_bulan'), 'pegawai_riwayat_umak.tahun')
            ->selectSub(function ($query) {
                $query->select(DB::raw("CONCAT(b.nama, ' - ', pr.no_rekening)"))
                    ->from('pegawai_rekening as pr')
                    ->join('bank as b', 'b.id', '=', 'pr.bank_id')
                    ->whereColumn('pr.pegawai_id', 'pegawai_riwayat_umak.pegawai_id')
                    ->where('pr.tipe_rekening', '=', 'Gaji & Umak')
                    ->limit(1);
            }, 'rekening_umak')
            ->join('pegawai as p','p.id','=','pegawai_riwayat_umak.pegawai_id')
            //->join('pegawai_riwayat_jabatan as prj', 'prj.pegawai_id', '=', 'pegawai_riwayat_umak.pegawai_id')
            ->join('pegawai_riwayat_jabatan as prj', function ($join) {
                $join->on('prj.pegawai_id','=','pegawai_riwayat_umak.pegawai_id')
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
            // ->join('pegawai_riwayat_golongan as prg', function ($join) {
            //     $join->on('prg.pegawai_id','=','p.id')
            //         ->where('prg.is_active','=',1)
            //         ;
            // })
            //->leftJoin('uang_makan as um','um.golongan_id','=','prg.golongan_id')
            ->leftJoin('uang_makan as um', function ($join) {
                $join->on('um.id','=','pegawai_riwayat_umak.uang_makan_id')
                    ;
            })
            
            ->where('pegawai_riwayat_umak.bulan', '=', $this->bulan)
            ->where('pegawai_riwayat_umak.tahun', '=', $this->tahun)
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
            'Uang Makan Harian',
            'Jumlah Hari Masuk',
            'Total',
            'Is Double',
            'Bulan',
            'Tahun',
            'No. Rek Umak',
            // ... tambahkan judul kolom lainnya
        ];
    }
}
