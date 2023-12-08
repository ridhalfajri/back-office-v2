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
        $data = PegawaiRiwayatUmak::select('p.nama_depan', 'p.nama_belakang', 'p.nip', 'uk.nama as unit_kerja', 'um.nominal',
            'pegawai_riwayat_umak.jumlah_hari_masuk', 'pegawai_riwayat_umak.total', 'pegawai_riwayat_umak.is_double',
            'pegawai_riwayat_umak.bulan', 'pegawai_riwayat_umak.tahun')
            ->join('pegawai as p','p.id','=','pegawai_riwayat_umak.pegawai_id')
            ->join('pegawai_riwayat_jabatan as prj', 'prj.pegawai_id', '=', 'pegawai_riwayat_umak.pegawai_id')
            ->join('jabatan_unit_kerja as juk', 'juk.id', '=', 'prj.jabatan_unit_kerja_id')
            ->join('hirarki_unit_kerja as huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
            ->leftJoin('unit_kerja as uk', 'uk.id', '=', 'huk.child_unit_kerja_id')
            ->join('pegawai_riwayat_golongan as prg', function ($join) {
                $join->on('prg.pegawai_id','=','p.id')
                    ->where('prg.is_active','=',1)
                    ;
            })
            ->leftJoin('uang_makan as um','um.golongan_id','=','prg.golongan_id')
            
            ->where('pegawai_riwayat_umak.bulan', '=', $this->bulan)
            ->where('pegawai_riwayat_umak.tahun', '=', $this->tahun)
            ->orderBy('uk.id','asc')
            ->get();

            if(null != $this->unitKerjaId || '' != $this->unitKerjaId){
                $data->where('uk.id', '=', $this->unitKerjaId);
            }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Nama Depan',
            'Nama Belakang',
            'NIP',
            'Unit Kerja',
            'Uang Makan Harian',
            'Jumlah Hari Masuk',
            'Total',
            'Is Double',
            'Bulan',
            'Tahun',
            // ... tambahkan judul kolom lainnya
        ];
    }
}
