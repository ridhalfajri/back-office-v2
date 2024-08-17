<?php

namespace App\Exports;

use App\Models\PegawaiBpjsLainnya;
use App\Models\PegawaiRiwayatUmak;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromCollection;

class DataExportBpjsLain implements FromCollection, WithHeadings
{
    use Exportable;

    private $status;
    private $daftarBpjs;

    public function __construct($status, $daftarBpjs)
    {
        $this->status = $status;
        $this->daftarBpjs = $daftarBpjs;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = PegawaiBpjsLainnya::select(
            DB::raw('CONCAT(p.nama_depan," ",p.nama_belakang," - ",p.nip," - ",p.nik) AS nama_pegawai'),
            'pegawai_bpjs_lainnya.nama_keluarga',
            'pegawai_bpjs_lainnya.nik_keluarga',
            'pegawai_bpjs_lainnya.no_kk_keluarga',
            'pegawai_bpjs_lainnya.status_keluarga'
        )
            ->join('pegawai as p', 'p.id', '=', 'pegawai_bpjs_lainnya.pegawai_id')

            ->orderBy('p.nip', 'desc')
            //->orderBy('p.nama_depan', 'asc')
        ;

        if (null != $this->status || '' != $this->status) {
            $data->where('pegawai_bpjs_lainnya.status', '=', $this->status);
        }

        if (null != $this->daftarBpjs || '' != $this->daftarBpjs) {
            $data->where('pegawai_bpjs_lainnya.daftar_ke_bpjs', '=', $this->daftarBpjs);
        }

        return $data->get();
    }

    public function headings(): array
    {
        return [
            'Nama Penanggung (NIP dan NIK)',
            'Nama',
            'NIK',
            'No. KK',
            'Status Hubungan Keluarga',
            // ... tambahkan judul kolom lainnya
        ];
    }
}
