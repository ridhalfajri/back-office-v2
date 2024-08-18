<?php

namespace App\Exports;

use App\Models\PegawaiBpjsRegular;
use App\Models\PegawaiRiwayatUmak;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromCollection;

class DataExportBpjsReg implements FromCollection, WithHeadings
{
    use Exportable;

    private $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = PegawaiBpjsRegular::select(
            DB::raw('CONCAT("\'",p.nip) AS nip'),
            'pegawai_bpjs_regular.nama',
            'pegawai_bpjs_regular.tgl_lahir',
            'pegawai_bpjs_regular.kode_hub_keluarga',
            'pegawai_bpjs_regular.alamat',
            DB::raw('NULL AS kolom1'),
            DB::raw('NULL AS kolom2'),
            DB::raw('NULL AS kolom3'),
            DB::raw('NULL AS kolom4'),
            DB::raw('NULL AS kolom5'),
            DB::raw('NULL AS kolom6'),
            DB::raw('NULL AS kolom7'),
            DB::raw('NULL AS kolom8'),
            'pegawai_bpjs_regular.kode_faskes',
            'pegawai_bpjs_regular.nama_faskes',
            'pegawai_bpjs_regular.no_telepon',
            'pegawai_bpjs_regular.email',
            'pegawai_bpjs_regular.nama_ibu_kandung'
        )
            ->join('pegawai as p', 'p.id', '=', 'pegawai_bpjs_regular.pegawai_id')

            ->orderBy('p.nip', 'desc')
            //->orderBy('p.nama_depan', 'asc')
        ;

        if (null != $this->status || '' != $this->status) {
            $data->where('pegawai_bpjs_regular.status', '=', $this->status);
        }

        return $data->get();
    }

    public function headings(): array
    {
        return [
            'NIP',
            'Nama Lengkap',
            'Tanggal Lahir',
            'Kode Hub Kel (1=Peserta, 2=Istri, 3=Suami, 4=Anak)',
            'Alamat Lengkap',
            'Golongan/Pangkat',
            'Tgl SK Pengangkatan',
            'TMT SK Terakhir',
            'Gaji Pokok',
            'Tunjangan Keluarga',
            'Tunjangan Jabatan',
            'Tunjangan Profesi',
            'Tunjangan Kinerja',
            'Kode Faskes TK I',
            'Nama Faskes TK I',
            'Nomor Telepon',
            'Email',
            'Nama Ibu Kandung',
            // ... tambahkan judul kolom lainnya
        ];
    }
}
