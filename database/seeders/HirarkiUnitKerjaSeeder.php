<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HirarkiUnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hirarki = array(
            array(
                "id" => 1,
                "child_unit_kerja_id" => 2,
                "parent_unit_kerja_id" => 1),
            array(
                "id" => 2,
                "child_unit_kerja_id" => 3,
                "parent_unit_kerja_id" => 1),
            array(
                "id" => 3,
                "child_unit_kerja_id" => 4,
                "parent_unit_kerja_id" => 1),
            array(
                "id" => 4,
                "child_unit_kerja_id" => 5,
                "parent_unit_kerja_id" => 1),
            array(
                "id" => 5,
                "child_unit_kerja_id" => 6,
                "parent_unit_kerja_id" => 1),
            array(
                "id" => 6,
                "child_unit_kerja_id" => 7,
                "parent_unit_kerja_id" => 2),
            array(
                "id" => 7,
                "child_unit_kerja_id" => 8,
                "parent_unit_kerja_id" => 2),
            array(
                "id" => 8,
                "child_unit_kerja_id" => 9,
                "parent_unit_kerja_id" => 2),
            array(
                "id" => 9,
                "child_unit_kerja_id" => 10,
                "parent_unit_kerja_id" => 2),
            array(
                "id" => 10,
                "child_unit_kerja_id" => 11,
                "parent_unit_kerja_id" => 2),
            array(
                "id" => 11,
                "child_unit_kerja_id" => 12,
                "parent_unit_kerja_id" => 2),
            array(
                "id" => 12,
                "child_unit_kerja_id" => 13,
                "parent_unit_kerja_id" => 3),
            array(
                "id" => 13,
                "child_unit_kerja_id" => 14,
                "parent_unit_kerja_id" => 3),
            array(
                "id" => 14,
                "child_unit_kerja_id" => 15,
                "parent_unit_kerja_id" => 3),
            array(
                "id" => 15,
                "child_unit_kerja_id" => 16,
                "parent_unit_kerja_id" => 4),
            array(
                "id" => 16,
                "child_unit_kerja_id" => 17,
                "parent_unit_kerja_id" => 4),
            array(
                "id" => 17,
                "child_unit_kerja_id" => 18,
                "parent_unit_kerja_id" => 5),
            array(
                "id" => 18,
                "child_unit_kerja_id" => 19,
                "parent_unit_kerja_id" => 5),
            array(
                "id" => 19,
                "child_unit_kerja_id" => 20,
                "parent_unit_kerja_id" => 5),
            array(
                "id" => 20,
                "child_unit_kerja_id" => 21,
                "parent_unit_kerja_id" => 6),
            array(
                "id" => 21,
                "child_unit_kerja_id" => 22,
                "parent_unit_kerja_id" => 6),
            array(
                "id" => 22,
                "child_unit_kerja_id" => 23,
                "parent_unit_kerja_id" => 8),
            array(
                "id" => 23,
                "child_unit_kerja_id" => 24,
                "parent_unit_kerja_id" => 8),
            array(
                "id" => 24,
                "child_unit_kerja_id" => 25,
                "parent_unit_kerja_id" => 8),
            array(
                "id" => 25,
                "child_unit_kerja_id" => 26,
                "parent_unit_kerja_id" => 9),
            array(
                "id" => 26,
                "child_unit_kerja_id" => 27,
                "parent_unit_kerja_id" => 9),
            array(
                "id" => 27,
                "child_unit_kerja_id" => 28,
                "parent_unit_kerja_id" => 9),
            array(
                "id" => 28,
                "child_unit_kerja_id" => 29,
                "parent_unit_kerja_id" => 10),
            array(
                "id" => 29,
                "child_unit_kerja_id" => 30,
                "parent_unit_kerja_id" => 10),
            array(
                "id" => 30,
                "child_unit_kerja_id" => 31,
                "parent_unit_kerja_id" => 10),
            array(
                "id" => 31,
                "child_unit_kerja_id" => 32,
                "parent_unit_kerja_id" => 11),
            array(
                "id" => 32,
                "child_unit_kerja_id" => 33,
                "parent_unit_kerja_id" => 11),
            array(
                "id" => 33,
                "child_unit_kerja_id" => 34,
                "parent_unit_kerja_id" => 11),
            array(
                "id" => 34,
                "child_unit_kerja_id" => 35,
                "parent_unit_kerja_id" => 12),
            array(
                "id" => 35,
                "child_unit_kerja_id" => 36,
                "parent_unit_kerja_id" => 12),
            array(
                "id" => 36,
                "child_unit_kerja_id" => 37,
                "parent_unit_kerja_id" => 13),
            array(
                "id" => 37,
                "child_unit_kerja_id" => 38,
                "parent_unit_kerja_id" => 13),
            array(
                "id" => 38,
                "child_unit_kerja_id" => 39,
                "parent_unit_kerja_id" => 13),
            array(
                "id" => 39,
                "child_unit_kerja_id" => 40,
                "parent_unit_kerja_id" => 13),
            array(
                "id" => 40,
                "child_unit_kerja_id" => 41,
                "parent_unit_kerja_id" => 14),
            array(
                "id" => 41,
                "child_unit_kerja_id" => 42,
                "parent_unit_kerja_id" => 14),
            array(
                "id" => 42,
                "child_unit_kerja_id" => 43,
                "parent_unit_kerja_id" => 14),
            array(
                "id" => 43,
                "child_unit_kerja_id" => 44,
                "parent_unit_kerja_id" => 14),
            array(
                "id" => 44,
                "child_unit_kerja_id" => 45,
                "parent_unit_kerja_id" => 15),
            array(
                "id" => 45,
                "child_unit_kerja_id" => 46,
                "parent_unit_kerja_id" => 15),
            array(
                "id" => 46,
                "child_unit_kerja_id" => 47,
                "parent_unit_kerja_id" => 15),
            array(
                "id" => 47,
                "child_unit_kerja_id" => 48,
                "parent_unit_kerja_id" => 15),
            array(
                "id" => 48,
                "child_unit_kerja_id" => 49,
                "parent_unit_kerja_id" => 16),
            array(
                "id" => 49,
                "child_unit_kerja_id" => 50,
                "parent_unit_kerja_id" => 16),
            array(
                "id" => 50,
                "child_unit_kerja_id" => 51,
                "parent_unit_kerja_id" => 16),
            array(
                "id" => 51,
                "child_unit_kerja_id" => 52,
                "parent_unit_kerja_id" => 16),
            array(
                "id" => 52,
                "child_unit_kerja_id" => 53,
                "parent_unit_kerja_id" => 17),
            array(
                "id" => 53,
                "child_unit_kerja_id" => 54,
                "parent_unit_kerja_id" => 17),
            array(
                "id" => 54,
                "child_unit_kerja_id" => 55,
                "parent_unit_kerja_id" => 17),
            array(
                "id" => 55,
                "child_unit_kerja_id" => 56,
                "parent_unit_kerja_id" => 18),
            array(
                "id" => 56,
                "child_unit_kerja_id" => 57,
                "parent_unit_kerja_id" => 18),
            array(
                "id" => 57,
                "child_unit_kerja_id" => 58,
                "parent_unit_kerja_id" => 19),
            array(
                "id" => 58,
                "child_unit_kerja_id" => 59,
                "parent_unit_kerja_id" => 19),
            array(
                "id" => 59,
                "child_unit_kerja_id" => 60,
                "parent_unit_kerja_id" => 19),
            array(
                "id" => 60,
                "child_unit_kerja_id" => 61,
                "parent_unit_kerja_id" => 19),
            array(
                "id" => 61,
                "child_unit_kerja_id" => 62,
                "parent_unit_kerja_id" => 20),
            array(
                "id" => 62,
                "child_unit_kerja_id" => 63,
                "parent_unit_kerja_id" => 20),
            array(
                "id" => 63,
                "child_unit_kerja_id" => 64,
                "parent_unit_kerja_id" => 20),
            array(
                "id" => 64,
                "child_unit_kerja_id" => 65,
                "parent_unit_kerja_id" => 20),
            array(
                "id" => 65,
                "child_unit_kerja_id" => 66,
                "parent_unit_kerja_id" => 21),
            array(
                "id" => 66,
                "child_unit_kerja_id" => 67,
                "parent_unit_kerja_id" => 21),
            array(
                "id" => 67,
                "child_unit_kerja_id" => 68,
                "parent_unit_kerja_id" => 21),
            array(
                "id" => 68,
                "child_unit_kerja_id" => 69,
                "parent_unit_kerja_id" => 21),
            array(
                "id" => 69,
                "child_unit_kerja_id" => 70,
                "parent_unit_kerja_id" => 22),
            array(
                "id" => 70,
                "child_unit_kerja_id" => 71,
                "parent_unit_kerja_id" => 22),
            array(
                "id" => 71,
                "child_unit_kerja_id" => 72,
                "parent_unit_kerja_id" => 22),
            array(
                "id" => 72,
                "child_unit_kerja_id" => 73,
                "parent_unit_kerja_id" => 22),
            array(
                "id" => 73,
                "child_unit_kerja_id" => 74,
                "parent_unit_kerja_id" => 7),
            array(
                "id" => 74,
                "child_unit_kerja_id" => 75,
                "parent_unit_kerja_id" => 23),
            array(
                "id" => 75,
                "child_unit_kerja_id" => 76,
                "parent_unit_kerja_id" => 23),
            array(
                "id" => 76,
                "child_unit_kerja_id" => 77,
                "parent_unit_kerja_id" => 23),
            array(
                "id" => 77,
                "child_unit_kerja_id" => 78,
                "parent_unit_kerja_id" => 24),
            array(
                "id" => 78,
                "child_unit_kerja_id" => 79,
                "parent_unit_kerja_id" => 24),
            array(
                "id" => 79,
                "child_unit_kerja_id" => 80,
                "parent_unit_kerja_id" => 24),
            array(
                "id" => 80,
                "child_unit_kerja_id" => 81,
                "parent_unit_kerja_id" => 25),
            array(
                "id" => 81,
                "child_unit_kerja_id" => 82,
                "parent_unit_kerja_id" => 25),
            array(
                "id" => 82,
                "child_unit_kerja_id" => 83,
                "parent_unit_kerja_id" => 25),
            array(
                "id" => 83,
                "child_unit_kerja_id" => 84,
                "parent_unit_kerja_id" => 25),
            array(
                "id" => 84,
                "child_unit_kerja_id" => 85,
                "parent_unit_kerja_id" => 25),
            array(
                "id" => 85,
                "child_unit_kerja_id" => 86,
                "parent_unit_kerja_id" => 25),
            array(
                "id" => 86,
                "child_unit_kerja_id" => 87,
                "parent_unit_kerja_id" => 25),
            array(
                "id" => 87,
                "child_unit_kerja_id" => 88,
                "parent_unit_kerja_id" => 25),
            array(
                "id" => 88,
                "child_unit_kerja_id" => 89,
                "parent_unit_kerja_id" => 25),
            array(
                "id" => 89,
                "child_unit_kerja_id" => 90,
                "parent_unit_kerja_id" => 25),
            array(
                "id" => 90,
                "child_unit_kerja_id" => 91,
                "parent_unit_kerja_id" => 26),
            array(
                "id" => 91,
                "child_unit_kerja_id" => 92,
                "parent_unit_kerja_id" => 26),
            array(
                "id" => 92,
                "child_unit_kerja_id" => 93,
                "parent_unit_kerja_id" => 27),
            array(
                "id" => 93,
                "child_unit_kerja_id" => 94,
                "parent_unit_kerja_id" => 27),
            array(
                "id" => 94,
                "child_unit_kerja_id" => 95,
                "parent_unit_kerja_id" => 28),
            array(
                "id" => 95,
                "child_unit_kerja_id" => 96,
                "parent_unit_kerja_id" => 28),
            array(
                "id" => 96,
                "child_unit_kerja_id" => 97,
                "parent_unit_kerja_id" => 28),
            array(
                "id" => 97,
                "child_unit_kerja_id" => 98,
                "parent_unit_kerja_id" => 29),
            array(
                "id" => 98,
                "child_unit_kerja_id" => 99,
                "parent_unit_kerja_id" => 29),
            array(
                "id" => 99,
                "child_unit_kerja_id" => 100,
                "parent_unit_kerja_id" => 30),
            array(
                "id" => 100,
                "child_unit_kerja_id" => 101,
                "parent_unit_kerja_id" => 30),
            array(
                "id" => 101,
                "child_unit_kerja_id" => 102,
                "parent_unit_kerja_id" => 31),
            array(
                "id" => 102,
                "child_unit_kerja_id" => 103,
                "parent_unit_kerja_id" => 31),
            array(
                "id" => 103,
                "child_unit_kerja_id" => 104,
                "parent_unit_kerja_id" => 34),
            array(
                "id" => 104,
                "child_unit_kerja_id" => 105,
                "parent_unit_kerja_id" => 34),
            array(
                "id" => 105,
                "child_unit_kerja_id" => 106,
                "parent_unit_kerja_id" => 25),
            array(
                "id" => 106,
                "child_unit_kerja_id" => 107,
                "parent_unit_kerja_id" => 25),
            array(
                "id" => 107,
                "child_unit_kerja_id" => 108,
                "parent_unit_kerja_id" => 12),
            array(
                "id" => 108,
                "child_unit_kerja_id" => 109,
                "parent_unit_kerja_id" => 49),
            array(
                "id" => 109,
                "child_unit_kerja_id" => 110,
                "parent_unit_kerja_id" => 49),
            array(
                "id" => 110,
                "child_unit_kerja_id" => 111,
                "parent_unit_kerja_id" => 50),
            array(
                "id" => 111,
                "child_unit_kerja_id" => 112,
                "parent_unit_kerja_id" => 50),
            array(
                "id" => 112,
                "child_unit_kerja_id" => 113,
                "parent_unit_kerja_id" => 51),
            array(
                "id" => 113,
                "child_unit_kerja_id" => 114,
                "parent_unit_kerja_id" => 51),
            array(
                "id" => 114,
                "child_unit_kerja_id" => 115,
                "parent_unit_kerja_id" => 52),
            array(
                "id" => 115,
                "child_unit_kerja_id" => 116,
                "parent_unit_kerja_id" => 52),
            array(
                "id" => 116,
                "child_unit_kerja_id" => 117,
                "parent_unit_kerja_id" => 53),
            array(
                "id" => 117,
                "child_unit_kerja_id" => 118,
                "parent_unit_kerja_id" => 53),
            array(
                "id" => 118,
                "child_unit_kerja_id" => 119,
                "parent_unit_kerja_id" => 54),
            array(
                "id" => 119,
                "child_unit_kerja_id" => 120,
                "parent_unit_kerja_id" => 54),
            array(
                "id" => 120,
                "child_unit_kerja_id" => 121,
                "parent_unit_kerja_id" => 55),
            array(
                "id" => 121,
                "child_unit_kerja_id" => 122,
                "parent_unit_kerja_id" => 55),
            array(
                "id" => 122,
                "child_unit_kerja_id" => 123,
                "parent_unit_kerja_id" => 56),
            array(
                "id" => 123,
                "child_unit_kerja_id" => 124,
                "parent_unit_kerja_id" => 56),
            array(
                "id" => 124,
                "child_unit_kerja_id" => 125,
                "parent_unit_kerja_id" => 57),
            array(
                "id" => 125,
                "child_unit_kerja_id" => 126,
                "parent_unit_kerja_id" => 57)
        );
        foreach ($hirarki as $data)
        {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('hirarki_unit_kerja')->insert($data);
        }
    }
}
