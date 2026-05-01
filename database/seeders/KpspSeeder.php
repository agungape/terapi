<?php

namespace Database\Seeders;

use App\Models\KpspKelompokUsia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KpspSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('kpsp_pertanyaans')->truncate();
        DB::table('kpsp_kelompok_usias')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'kode' => '3bln',
                'nama' => '3 Bulan',
                'usia_bulan' => 3,
                'pertanyaans' => [
                    ['no_urut' => 1, 'bidang' => 'MK', 'pertanyaan' => 'Pada waktu bayi telentang, apakah ia dapat mengikuti gerakan anda dengan menggerakkan kepala sepenuhnya dari satu sisi ke sisi yang lain?'],
                    ['no_urut' => 2, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah bayi mempertahankan posisi kepala dalam keadaan tegak dan stabil? Jawab TIDAK bila kepala bayi cenderung jatuh ke kanan/kiri atau ke dadanya.'],
                    ['no_urut' => 3, 'bidang' => 'PS', 'pertanyaan' => 'Apakah bayi suka tertawa keras walau tidak digelitik atau diraba-raba?'],
                    ['no_urut' => 4, 'bidang' => 'MK', 'pertanyaan' => 'Tarik bayi pada pergelangan tangannya secara perlahan ke posisi duduk. Dapatkah bayi mempertahankan lehernya secara kaku?'],
                    ['no_urut' => 5, 'bidang' => 'MH', 'pertanyaan' => 'Pernahkah bayi mengeluarkan suara gembira bernada tinggi atau memekik tetapi bukan menangis?'],
                    ['no_urut' => 6, 'bidang' => 'B', 'pertanyaan' => 'Pernahkah bayi berbalik paling sedikit dua kali, dari telentang ke telungkup atau sebaliknya?'],
                    ['no_urut' => 7, 'bidang' => 'PS', 'pertanyaan' => 'Pernahkah anda melihat bayi tersenyum ketika melihat mainan yang lucu, gambar atau binatang peliharaan pada saat ia bermain sendiri?'],
                    ['no_urut' => 8, 'bidang' => 'B', 'pertanyaan' => 'Dapatkah bayi mengarahkan matanya pada benda kecil sebesar kacang, kismis atau uang logam?'],
                    ['no_urut' => 9, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah bayi meraih mainan yang diletakkan agak jauh namun masih berada dalam jangkauan tangannya?'],
                    ['no_urut' => 10, 'bidang' => 'MH', 'pertanyaan' => 'Pada posisi telungkup, dapatkah bayi mengangkat dada dengan kedua lengannya sebagai penyangga?']
                ]
            ],
            [
                'kode' => '6bln',
                'nama' => '6 Bulan',
                'usia_bulan' => 6,
                'pertanyaans' => [
                    ['no_urut' => 1, 'bidang' => 'MK', 'pertanyaan' => 'Pada waktu bayi telentang, apakah ia dapat mengikuti gerakan anda dengan menggerakkan kepala sepenuhnya dari satu sisi ke sisi yang lain?'],
                    ['no_urut' => 2, 'bidang' => 'PS', 'pertanyaan' => 'Dapatkah bayi mempertahankan posisi kepala dalam keadaan tegak dan stabil?'],
                    ['no_urut' => 3, 'bidang' => 'B', 'pertanyaan' => 'Apakah bayi suka tertawa keras walau tidak digelitik atau diraba-raba?'],
                    ['no_urut' => 4, 'bidang' => 'MK', 'pertanyaan' => 'Tarik bayi pada pergelangan tangannya secara perlahan ke posisi duduk. Dapatkah bayi mempertahankan lehernya secara kaku?'],
                    ['no_urut' => 5, 'bidang' => 'MH', 'pertanyaan' => 'Pernahkah bayi mengeluarkan suara gembira bernada tinggi atau memekik tetapi bukan menangis?'],
                    ['no_urut' => 6, 'bidang' => 'MK', 'pertanyaan' => 'Pernahkah bayi berbalik paling sedikit dua kali, dari telentang ke telungkup atau sebaliknya?'],
                    ['no_urut' => 7, 'bidang' => 'PS', 'pertanyaan' => 'Pernahkah anda melihat bayi tersenyum ketika melihat mainan yang lucu?'],
                    ['no_urut' => 8, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah bayi mengarahkan matanya pada benda kecil sebesar kacang?'],
                    ['no_urut' => 9, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah bayi meraih mainan yang diletakkan agak jauh?'],
                    ['no_urut' => 10, 'bidang' => 'MK', 'pertanyaan' => 'Pada posisi telungkup, dapatkah bayi mengangkat dada dengan kedua lengannya?']
                ]
            ],
            [
                'kode' => '9bln',
                'nama' => '9 Bulan',
                'usia_bulan' => 9,
                'pertanyaans' => [
                    ['no_urut' => 1, 'bidang' => 'MK', 'pertanyaan' => 'Pada posisi telungkup, dapatkah bayi mengangkat dada dengan kedua lengannya?'],
                    ['no_urut' => 2, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah bayi memungut dua benda seperti mainan/kacang-kacangan menggunakan tangan kanannya dan tangan kirinya secara bersamaan?'],
                    ['no_urut' => 3, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah bayi duduk sendiri tanpa penyangga atau bantuan selama 60 detik?'],
                    ['no_urut' => 4, 'bidang' => 'PS', 'pertanyaan' => 'Apakah bayi dapat makan kue kering sendiri?'],
                    ['no_urut' => 5, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah bayi mengambil benda kecil (sebesar kacang/kismis) dengan meremas di antara ibu jari dan jarinya?'],
                    ['no_urut' => 6, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah bayi memungut mainan sendiri saat dijatuhkan tanpa bantuan?'],
                    ['no_urut' => 7, 'bidang' => 'B', 'pertanyaan' => 'Bila Anda memanggil namanya, apakah bayi menoleh ke arah Anda?'],
                    ['no_urut' => 8, 'bidang' => 'PS', 'pertanyaan' => 'Apakah bayi bersuara, minimal tiga suara (ba-ba, ma-ma, da-da)?'],
                    ['no_urut' => 9, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah bayi berdiri sambil berpegangan pada perabotan (meja/kursi)?'],
                    ['no_urut' => 10, 'bidang' => 'PS', 'pertanyaan' => 'Apakah bayi dapat bertepuk tangan atau melambai (cilukba/dadah) tanpa bantuan?']
                ]
            ],
            [
                'kode' => '12bln',
                'nama' => '12 Bulan',
                'usia_bulan' => 12,
                'pertanyaans' => [
                    ['no_urut' => 1, 'bidang' => 'MK', 'pertanyaan' => 'Jika Anda bersembunyi di belakang kertas/sapu tangan/selimut, dapatkah bayi mencari dan menemukan Anda?'],
                    ['no_urut' => 2, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah bayi mengambil benda kecil (kacang/kismis/potongan biskuit) dengan menggunakan ibu jari dan telunjuk (menjumput)?'],
                    ['no_urut' => 3, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah bayi duduk sendiri tanpa penyangga?'],
                    ['no_urut' => 4, 'bidang' => 'B', 'pertanyaan' => 'Apakah bayi dapat mengucapkan 1-2 kata yang mempunyai arti seperti "papa" atau "mama"?'],
                    ['no_urut' => 5, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah bayi berdiri sendiri tanpa berpegangan selama kira-kira 5 detik?'],
                    ['no_urut' => 6, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah bayi berdiri sendiri tanpa berpegangan selama kira-kira 30 detik atau lebih?'],
                    ['no_urut' => 7, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah bayi berjalan beberapa langkah tanpa berpegangan?'],
                    ['no_urut' => 8, 'bidang' => 'PS', 'pertanyaan' => 'Apakah bayi dapat memberikan mainan/benda lain kepada Anda bila diminta?'],
                    ['no_urut' => 9, 'bidang' => 'B', 'pertanyaan' => 'Apakah bayi dapat menunjuk ke suatu benda yang diinginkannya dengan telunjuk?'],
                    ['no_urut' => 10, 'bidang' => 'MH', 'pertanyaan' => 'Apakah bayi dapat menggelindingkan bola ke arah Anda?']
                ]
            ],
            [
                'kode' => '15bln',
                'nama' => '15 Bulan',
                'usia_bulan' => 15,
                'pertanyaans' => [
                    ['no_urut' => 1, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah anak berjalan dengan baik tanpa jatuh?'],
                    ['no_urut' => 2, 'bidang' => 'B', 'pertanyaan' => 'Apakah anak dapat mengucapkan 3 kata selain "papa" dan "mama"?'],
                    ['no_urut' => 3, 'bidang' => 'B', 'pertanyaan' => 'Apakah anak dapat menunjuk bagian tubuhnya (mata/hidung/mulut) bila diminta?'],
                    ['no_urut' => 4, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak menumpuk 2 buah kubus tanpa menjatuhkannya?'],
                    ['no_urut' => 5, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak memasukkan benda kecil ke dalam cangkir/botol?'],
                    ['no_urut' => 6, 'bidang' => 'PS', 'pertanyaan' => 'Apakah anak dapat minum dari cangkir/gelas tanpa banyak tumpah?'],
                    ['no_urut' => 7, 'bidang' => 'PS', 'pertanyaan' => 'Apakah anak dapat menggunakan sendok meskipun masih ada yang tumpah?'],
                    ['no_urut' => 8, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak mencoret-coret dengan pensil/krayon di atas kertas?'],
                    ['no_urut' => 9, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah anak berjalan mundur 5 langkah tanpa jatuh?'],
                    ['no_urut' => 10, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah anak naik tangga sambil merangkak?']
                ]
            ],
            [
                'kode' => '18bln',
                'nama' => '18 Bulan',
                'usia_bulan' => 18,
                'pertanyaans' => [
                    ['no_urut' => 1, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah anak berjalan mundur 5 langkah tanpa jatuh?'],
                    ['no_urut' => 2, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak mencoret-coret dengan pensil/krayon di atas kertas?'],
                    ['no_urut' => 3, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak menumpuk 2 buah kubus tanpa menjatuhkannya?'],
                    ['no_urut' => 4, 'bidang' => 'B', 'pertanyaan' => 'Apakah anak dapat menunjuk 1 bagian tubuhnya bila diminta?'],
                    ['no_urut' => 5, 'bidang' => 'PS', 'pertanyaan' => 'Apakah anak dapat membuka pakaiannya sendiri (topi/kaos kaki/sepatu)?'],
                    ['no_urut' => 6, 'bidang' => 'PS', 'pertanyaan' => 'Apakah anak dapat makan dengan sendok tanpa banyak tumpah?'],
                    ['no_urut' => 7, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah anak lari tanpa jatuh?'],
                    ['no_urut' => 8, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah anak naik tangga tanpa dibantu?'],
                    ['no_urut' => 9, 'bidang' => 'B', 'pertanyaan' => 'Apakah anak dapat mengucapkan 10 kata selain "papa" dan "mama"?'],
                    ['no_urut' => 10, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak membalik halaman buku?']
                ]
            ],
            [
                'kode' => '24bln',
                'nama' => '24 Bulan',
                'usia_bulan' => 24,
                'pertanyaans' => [
                    ['no_urut' => 1, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak menumpuk 4 buah kubus tanpa menjatuhkannya?'],
                    ['no_urut' => 2, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak menumpuk 6 buah kubus tanpa menjatuhkannya?'],
                    ['no_urut' => 3, 'bidang' => 'B', 'pertanyaan' => 'Apakah anak dapat merangkai 2 kata seperti "mau minum" atau "mama pergi"?'],
                    ['no_urut' => 4, 'bidang' => 'B', 'pertanyaan' => 'Apakah anak dapat menunjuk gambar yang disebutkan (misal: "mana anjing?", "mana kucing?")?'],
                    ['no_urut' => 5, 'bidang' => 'PS', 'pertanyaan' => 'Apakah anak dapat memakai bajunya sendiri?'],
                    ['no_urut' => 6, 'bidang' => 'PS', 'pertanyaan' => 'Apakah anak dapat mencuci dan mengeringkan tangannya sendiri?'],
                    ['no_urut' => 7, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah anak menendang bola ke depan tanpa berpegangan?'],
                    ['no_urut' => 8, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah anak melompat dengan kedua kaki bersamaan?'],
                    ['no_urut' => 9, 'bidang' => 'B', 'pertanyaan' => 'Apakah anak menyebutkan nama benda/gambar yang ditunjukkan kepadanya?'],
                    ['no_urut' => 10, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak meniru garis tegak/lurus?']
                ]
            ],
            [
                'kode' => '36bln',
                'nama' => '36 Bulan',
                'usia_bulan' => 36,
                'pertanyaans' => [
                    ['no_urut' => 1, 'bidang' => 'MK', 'pertanyaan' => 'Bila diberi bola, dapatkah anak melemparkan bola ke arah dada anda?'],
                    ['no_urut' => 2, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak menyusun 8 buah kubus satu persatu di atas yang lain tanpa menjatuhkannya?'],
                    ['no_urut' => 3, 'bidang' => 'PS', 'pertanyaan' => 'Apakah anak dapat menyebutkan nama lengkapnya tanpa dibantu?'],
                    ['no_urut' => 4, 'bidang' => 'B', 'pertanyaan' => 'Apakah anak dapat menceritakan dua kejadian yang dialaminya secara berurutan?'],
                    ['no_urut' => 5, 'bidang' => 'PS', 'pertanyaan' => 'Apakah anak dapat memakai baju atau kemejanya sendiri?'],
                    ['no_urut' => 6, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah anak mengayuh sepeda roda tiga sejauh kira-kira 3 meter?'],
                    ['no_urut' => 7, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak menggambar garis lurus setelah anda mencontohkan?'],
                    ['no_urut' => 8, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah anak berdiri dengan 1 kaki selama 2 detik tanpa berpegangan?'],
                    ['no_urut' => 9, 'bidang' => 'B', 'pertanyaan' => 'Apakah anak dapat menjawab pertanyaan yang menggunakan kata tanya (siapa/apa/dimana)?'],
                    ['no_urut' => 10, 'bidang' => 'PS', 'pertanyaan' => 'Apakah anak dapat bermain petak umpet/ular naga dengan anak-anak lainnya?']
                ]
            ],
            [
                'kode' => '48bln',
                'nama' => '48 Bulan',
                'usia_bulan' => 48,
                'pertanyaans' => [
                    ['no_urut' => 1, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah anak berdiri dengan 1 kaki selama 6 detik tanpa berpegangan?'],
                    ['no_urut' => 2, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak menggambar tanda silang (X) di atas kertas?'],
                    ['no_urut' => 3, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah anak melompat dengan satu kaki berturut-turut dua kali tanpa terjatuh?'],
                    ['no_urut' => 4, 'bidang' => 'B', 'pertanyaan' => 'Dapatkah anak menyebutkan paling sedikit 4 warna?'],
                    ['no_urut' => 5, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak menggambar orang dengan paling sedikit 3 bagian tubuh (kepala, badan, kaki)?'],
                    ['no_urut' => 6, 'bidang' => 'PS', 'pertanyaan' => 'Apakah anak dapat mengancingkan bajunya atau pakaian boneka?'],
                    ['no_urut' => 7, 'bidang' => 'PS', 'pertanyaan' => 'Apakah anak dapat mencuci dan mengeringkan wajahnya tanpa dibantu?'],
                    ['no_urut' => 8, 'bidang' => 'B', 'pertanyaan' => 'Apakah anak memahami arti kata "di atas", "di bawah", "di belakang"?'],
                    ['no_urut' => 9, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah anak menangkap bola kecil sebesar bola tenis?'],
                    ['no_urut' => 10, 'bidang' => 'B', 'pertanyaan' => 'Apakah anak dapat menyebutkan nama temannya?']
                ]
            ],
            [
                'kode' => '60bln',
                'nama' => '60 Bulan',
                'usia_bulan' => 60,
                'pertanyaans' => [
                    ['no_urut' => 1, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah anak berdiri dengan satu kaki selama 11 detik tanpa berpegangan?'],
                    ['no_urut' => 2, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak menggambar orang dengan paling sedikit 6 bagian tubuh?'],
                    ['no_urut' => 3, 'bidang' => 'B', 'pertanyaan' => 'Dapatkah anak menceritakan fungsi/kegunaan dari benda-benda di rumah?'],
                    ['no_urut' => 4, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah anak berjalan jinjit sedikitnya 5 langkah?'],
                    ['no_urut' => 5, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak menggambar segi empat?'],
                    ['no_urut' => 6, 'bidang' => 'B', 'pertanyaan' => 'Apakah anak dapat berhitung sampai 10?'],
                    ['no_urut' => 7, 'bidang' => 'B', 'pertanyaan' => 'Apakah anak mengetahui lawan kata dari panjang/pendek, siang/malam?'],
                    ['no_urut' => 8, 'bidang' => 'PS', 'pertanyaan' => 'Apakah anak dapat mengambil minuman sendiri dari kulkas/meja?'],
                    ['no_urut' => 9, 'bidang' => 'PS', 'pertanyaan' => 'Apakah anak mengerti aturan sederhana dalam permainan seperti ular tangga/petak umpet?'],
                    ['no_urut' => 10, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak mengoleskan mentega/selai ke atas roti?']
                ]
            ],
            [
                'kode' => '72bln',
                'nama' => '72 Bulan',
                'usia_bulan' => 72,
                'pertanyaans' => [
                    ['no_urut' => 1, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah anak berdiri dengan satu kaki selama 11 detik tanpa berpegangan?'],
                    ['no_urut' => 2, 'bidang' => 'MK', 'pertanyaan' => 'Dapatkah anak berjalan mundur tumit bersentuhan jari kaki?'],
                    ['no_urut' => 3, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak menggambar segi empat atau benda dengan sudut tajam?'],
                    ['no_urut' => 4, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak menggambar orang dengan 6 bagian tubuh?'],
                    ['no_urut' => 5, 'bidang' => 'B', 'pertanyaan' => 'Dapatkah anak membedakan mana benda yang berat dan benda yang ringan?'],
                    ['no_urut' => 6, 'bidang' => 'B', 'pertanyaan' => 'Dapatkah anak menjelaskan arti 3 dari 5 kata yang ditanyakan (contoh: bola, danau, rumah, meja, jeruk)?'],
                    ['no_urut' => 7, 'bidang' => 'B', 'pertanyaan' => 'Dapatkah anak mengetahui fungsi dari 3 benda?'],
                    ['no_urut' => 8, 'bidang' => 'PS', 'pertanyaan' => 'Apakah anak dapat berpakaian sendiri tanpa bantuan?'],
                    ['no_urut' => 9, 'bidang' => 'PS', 'pertanyaan' => 'Apakah anak dapat membersihkan alat makannya sendiri?'],
                    ['no_urut' => 10, 'bidang' => 'MH', 'pertanyaan' => 'Dapatkah anak menulis namanya sendiri (walau beberapa huruf terbalik)?']
                ]
            ]
        ];

        foreach ($data as $group) {
            $kelompokUsia = KpspKelompokUsia::create([
                'kode' => $group['kode'],
                'nama' => $group['nama'],
                'usia_bulan' => $group['usia_bulan']
            ]);

            foreach ($group['pertanyaans'] as $q) {
                $kelompokUsia->pertanyaans()->create([
                    'no_urut' => $q['no_urut'],
                    'bidang' => $q['bidang'],
                    'pertanyaan' => $q['pertanyaan']
                ]);
            }
        }
    }
}
