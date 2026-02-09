<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FTSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        $admin = 1;

        /*
        |--------------------------------------------------------------------------
        | NEWS
        |--------------------------------------------------------------------------
        */
        // DB::table('news')->insert([
        //     [
        //         'title' => 'BEM UNUJA Gelar International Conference Bahas Pendidikan Holistik',
        //         'content' => 'Badan Eksekutif Mahasiswa Universitas Nurul Jadid (UNUJA) menggelar International Conference dengan tema "Holistic Education: Building Intellectual, Emotional, and Spiritual Intelligence" di Aula 1 Pondok Pesantren Nurul Jadid. Acara dihadiri narasumber internasional serta mahasiswa dari berbagai kampus untuk membahas integrasi kecerdasan intelektual, emosional, dan spiritual dalam pendidikan modern.',
        //         'thumbnail' => 'news/bem-international-conference.jpg',
        //         'published_at' => $now->subDays(90),
        //         'status' => 'published',
        //         'created_by' => $admin,
        //         'updated_by' => $admin,
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ],
        //     [
        //         'title' => 'Kongres ke-VIII BEM PTNU Se-Nusantara Resmi Digelar di UNUJA',
        //         'content' => 'UNUJA menjadi tuan rumah Kongres VIII BEM PTNU Se-Nusantara, sebuah forum strategis mahasiswa Nahdlatul Ulama yang dihadiri perwakilan BEM PTNU dari seluruh Indonesia. Tema kongres adalah "Merajut Persatuan Mahasiswa Nahdliyin untuk Mendorong Kualitas Pendidikan dan Kemandirian Ekonomi Umat."',
        //         'thumbnail' => 'news/kongres-viii-bem-ptnu.jpg',
        //         'published_at' => $now->subDays(120),
        //         'status' => 'published',
        //         'created_by' => $admin,
        //         'updated_by' => $admin,
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ],
        //     [
        //         'title' => 'Kiai Zuhri Zaini Bicara Tantangan Teknologi dan Persatuan di Kongres BEMPTNU',
        //         'content' => 'KH. M. Zuhri Zaini memberikan pesan mendalam kepada peserta Kongres VIII BEMPTNU di UNUJA, bahwa perjuangan mahasiswa akan diuji oleh konflik dan kemajuan teknologi, serta pentingnya persatuan dan nilai keagamaan dalam menghadapi masa depan.',
        //         'thumbnail' => 'news/zuhri-zaini-kongres.jpg',
        //         'published_at' => $now->subDays(110),
        //         'status' => 'published',
        //         'created_by' => $admin,
        //         'updated_by' => $admin,
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ],
        //     [
        //         'title' => 'CBT Center UNUJA Resmi Diakui Sebagai Pusat Uji Kompetensi Tenaga Kesehatan Nasional',
        //         'content' => 'Laboratorium komputer CBT Center UNUJA di Gedung D secara resmi diakui oleh Lembaga Pengembangan Uji Kompetensi Tenaga Kesehatan (LPUK-NAKES) sebagai pusat uji kompetensi nasional. Sertifikasi ini memperkuat komitmen UNUJA dalam mendukung mutu pendidikan dan tenaga kesehatan di Indonesia.',
        //         'thumbnail' => 'news/cbt-center-unuja.jpg',
        //         'published_at' => $now->subDays(150),
        //         'status' => 'published',
        //         'created_by' => $admin,
        //         'updated_by' => $admin,
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ],
        //     [
        //         'title' => 'UNUJA Gelar Try Out UKOM Nasional, CBT Center Jadi Lokasi Resmi',
        //         'content' => 'Pada 14–16 Juni 2025, UNUJA menjadi tuan rumah Try Out Uji Kompetensi Nasional (UKOM) bagi mahasiswa kesehatan seperti Ners, Keperawatan, dan Teknologi Laboratorium Medik, bekerja sama dengan AIPNI, AIPKIND, AIPViKI, dan LPUK-NAKES.',
        //         'thumbnail' => 'news/tryout-ukom-unuja.jpg',
        //         'published_at' => $now->subDays(160),
        //         'status' => 'published',
        //         'created_by' => $admin,
        //         'updated_by' => $admin,
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ],
        // ]);

        /*
        |--------------------------------------------------------------------------
        | ANNOUNCEMENTS
        |--------------------------------------------------------------------------
        */
        DB::table('announcements')->insert([
            [
                'title' => 'Pengumuman Perkuliahan Semester Genap 2024/2025 Dimulai 4 Maret',
                'status' => 'published',
                'created_by' => $admin,
                'updated_by' => NULL,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Pendaftaran Yudisium Periode Februari Telah Dibuka',
                'status' => 'published',
                'created_by' => $admin,
                'updated_by' => NULL,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Pelaksanaan Ujian Tengah Semester (UTS) Dimulai 18 Maret 2025',
                'status' => 'published',
                'created_by' => $admin,
                'updated_by' => NULL,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Registrasi Administrasi Semester Genap Dibuka Hingga 10 Maret 2025',
                'status' => 'published',
                'created_by' => $admin,
                'updated_by' => NULL,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Pengumuman Libur Nasional: Fakultas Teknik Tutup pada 29 Maret 2025',
                'status' => 'published',
                'created_by' => $admin,
                'updated_by' => NULL,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | INFOS
        |--------------------------------------------------------------------------
        */
        DB::table('infos')->insert([
            [
                'title' => 'Maintenance Sistem Informasi Akademik',
                'message' => 'SIAKAD akan mengalami gangguan akses pada tanggal 20 Februari jam 22.00 - 00.00.',
                'date' => '2025-02-20',
                'status' => 'active',
                'created_by' => $admin,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Pengumpulan Laporan KP',
                'message' => 'Pengumpulan laporan Kerja Praktek maksimal tanggal 10 Maret 2025.',
                'date' => '2025-03-10',
                'status' => 'active',
                'created_by' => $admin,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Pendaftaran Wisuda Gelombang I 2025',
                'message' => 'Pendaftaran wisuda Fakultas Teknik dibuka mulai 1 Maret hingga 30 April 2025 melalui portal akademik.',
                'date' => '2025-03-01',
                'status' => 'active',
                'created_by' => $admin,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Seminar Nasional Teknologi Informasi',
                'message' => 'Mahasiswa diwajibkan mengikuti Seminar Nasional Teknologi Informasi yang akan dilaksanakan pada 15 Mei 2025 di Aula FT.',
                'date' => '2025-05-15',
                'status' => 'active',
                'created_by' => $admin,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Pemberitahuan Cuti Akademik Semester Genap',
                'message' => 'Pengajuan cuti akademik semester genap dapat dilakukan hingga tanggal 5 Maret 2025 di bagian administrasi Fakultas Teknik.',
                'date' => '2025-03-05',
                'status' => 'active',
                'created_by' => $admin,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | VIDEOS
        |--------------------------------------------------------------------------
        */
        // DB::table('videos')->insert([
        //     [
        //         'title' => 'Profil Fakultas Teknik UNUJA',
        //         'source_type' => 'youtube',
        //         'video_url' => 'https://www.youtube.com/embed/ycx9W2KFx1A',
        //         'is_active' => 1,
        //         'order' => 1,
        //         'created_by' => $admin,
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ],
        //     [
        //         'title' => 'Sarana Prasarana Fakultas Teknik UNUJA',
        //         'source_type' => 'youtube',
        //         'video_url' => 'https://www.youtube.com/embed/SqgVpYleREA',
        //         'is_active' => 1,
        //         'order' => 2,
        //         'created_by' => $admin,
        //         'created_at' => $now,
        //         'updated_at' => $now,
        //     ],
        // ]);

        /*
        |--------------------------------------------------------------------------
        | NOTIFICATIONS
        |--------------------------------------------------------------------------
        */
        DB::table('notifications')->insert([
            [
                'message' => 'Selamat datang di Papan Informasi Digital Fakultas Teknik UNUJA!',
                'date' => $now,
                'created_by' => $admin,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'message' => 'Jangan lupa untuk melakukan registrasi ulang semester genap.',
                'date' => $now,
                'created_by' => $admin,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'message' => 'Pengumpulan laporan KP maksimal tanggal 10 Maret 2025.',
                'date' => $now,
                'created_by' => $admin,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
