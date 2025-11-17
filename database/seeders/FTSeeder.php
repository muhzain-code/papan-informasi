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
        $admin = 1; // sesuaikan jika diperlukan

        /*
        |--------------------------------------------------------------------------
        | NEWS
        |--------------------------------------------------------------------------
        */
        DB::table('news')->insert([
            [
                'title' => 'BEM UNUJA Gelar International Conference Bahas Pendidikan Holistik',
                'content' => 'Badan Eksekutif Mahasiswa Universitas Nurul Jadid (UNUJA) menggelar International Conference dengan tema “Holistic Education: Building Intellectual, Emotional, and Spiritual Intelligence” di Aula 1 Pondok Pesantren Nurul Jadid. Acara dihadiri narasumber internasional serta mahasiswa dari berbagai kampus untuk membahas integrasi kecerdasan intelektual, emosional, dan spiritual dalam pendidikan modern.',
                'thumbnail' => 'news/bem-international-conference.jpg',
                'published_at' => $now->subDays(90), // misal 90 hari yang lalu
                'status' => 'published',
                'created_by' => $admin,
                'updated_by' => $admin,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Kongres ke-VIII BEM PTNU Se-Nusantara Resmi Digelar di UNUJA',
                'content' => 'UNUJA menjadi tuan rumah Kongres VIII BEM PTNU Se-Nusantara, sebuah forum strategis mahasiswa Nahdlatul Ulama yang dihadiri perwakilan BEM PTNU dari seluruh Indonesia. Tema kongres adalah “Merajut Persatuan Mahasiswa Nahdliyin untuk Mendorong Kualitas Pendidikan dan Kemandirian Ekonomi Umat.”',
                'thumbnail' => 'news/kongres-viii-bem-ptnu.jpg',
                'published_at' => $now->subDays(120),
                'status' => 'published',
                'created_by' => $admin,
                'updated_by' => $admin,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Kiai Zuhri Zaini Bicara Tantangan Teknologi dan Persatuan di Kongres BEMPTNU',
                'content' => 'KH. M. Zuhri Zaini memberikan pesan mendalam kepada peserta Kongres VIII BEMPTNU di UNUJA, bahwa perjuangan mahasiswa akan diuji oleh konflik dan kemajuan teknologi, serta pentingnya persatuan dan nilai keagamaan dalam menghadapi masa depan.',
                'thumbnail' => 'news/zuhri-zaini-kongres.jpg',
                'published_at' => $now->subDays(110),
                'status' => 'published',
                'created_by' => $admin,
                'updated_by' => $admin,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'CBT Center UNUJA Resmi Diakui Sebagai Pusat Uji Kompetensi Tenaga Kesehatan Nasional',
                'content' => 'Laboratorium komputer CBT Center UNUJA di Gedung D secara resmi diakui oleh Lembaga Pengembangan Uji Kompetensi Tenaga Kesehatan (LPUK-NAKES) sebagai pusat uji kompetensi nasional. Sertifikasi ini memperkuat komitmen UNUJA dalam mendukung mutu pendidikan dan tenaga kesehatan di Indonesia.',
                'thumbnail' => 'news/cbt-center-unuja.jpg',
                'published_at' => $now->subDays(150),
                'status' => 'published',
                'created_by' => $admin,
                'updated_by' => $admin,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'UNUJA Gelar Try Out UKOM Nasional, CBT Center Jadi Lokasi Resmi',
                'content' => 'Pada 14–16 Juni 2025, UNUJA menjadi tuan rumah Try Out Uji Kompetensi Nasional (UKOM) bagi mahasiswa kesehatan seperti Ners, Keperawatan, dan Teknologi Laboratorium Medik, bekerja sama dengan AIPNI, AIPKIND, AIPViKI, dan LPUK-NAKES.',
                'thumbnail' => 'news/tryout-ukom-unuja.jpg',
                'published_at' => $now->subDays(160),
                'status' => 'published',
                'created_by' => $admin,
                'updated_by' => $admin,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

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
        DB::table('videos')->insert([
            [
                'title' => 'Profil Fakultas Teknik UNUJA',
                'source_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/embed/ycx9W2KFx1A',
                'is_active' => 1,
                'order' => 1,
                'created_by' => $admin,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Sarana Prasarana Fakultas Teknik UNUJA',
                'source_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/embed/SqgVpYleREA',
                'is_active' => 1,
                'order' => 2,
                'created_by' => $admin,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | COURSES — sesuai kurikulum Fakultas Teknik UNJ
        |--------------------------------------------------------------------------
        */
        DB::table('courses')->insert([
            [
                'code' => 'TI215',
                'name' => 'Struktur Data',
                'sks' => 3,
                'description' => 'Struktur data linear dan non-linear, implementasi dan analisis.',
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'code' => 'TI230',
                'name' => 'Sistem Operasi',
                'sks' => 3,
                'description' => 'Konsep dasar OS, manajemen proses, memori, dan file system.',
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'code' => 'TI260',
                'name' => 'Pemrograman Web',
                'sks' => 3,
                'description' => 'HTML, CSS, JS, dan backend dasar.',
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'code' => 'TI350',
                'name' => 'Rekayasa Perangkat Lunak',
                'sks' => 3,
                'description' => 'Software development lifecycle dan manajemen proyek.',
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'code' => 'TI410',
                'name' => 'Kecerdasan Buatan',
                'sks' => 3,
                'description' => 'AI dasar, search, machine learning dasar.',
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'code' => 'TI450',
                'name' => 'Pemrograman Mobile',
                'sks' => 3,
                'description' => 'Pemrograman mobile Android dasar.',
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'code' => 'TI480',
                'name' => 'Cloud Computing',
                'sks' => 2,
                'description' => 'Dasar cloud, deployment, virtualisasi.',
                'created_by' => $admin,
                'created_at' => $now,
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | ROOMS — sesuai gedung FT UNJ
        |--------------------------------------------------------------------------
        */
        DB::table('rooms')->insert([
            [
                'code' => 'LAB-IOT',
                'name' => 'Laboratorium IoT',
                'capacity' => 25,
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'code' => 'LAB-TI1',
                'name' => 'Laboratorium Komputer 1',
                'capacity' => 30,
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'code' => 'RK-301',
                'name' => 'Ruang Kelas D3 01',
                'capacity' => 40,
                'created_by' => $admin,
                'created_at' => $now,
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | LECTURERS — Dosen FT UNJ (nama real/familiar)
        |--------------------------------------------------------------------------
        */
        DB::table('lecturers')->insert([
            [
                'name' => 'Moh. Salman, M.Kom',
                'nidn' => '2105078901',
                'email' => 'salman@unuja.ac.id',
                'phone' => '081234567890',
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'name' => 'Achmad Haris, M.Kom',
                'nidn' => '2105093302',
                'email' => 'haris@unuja.ac.id',
                'phone' => '081234567891',
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'name' => 'Ahmad Fathoni, M.Kom',
                'nidn' => '2105098803',
                'email' => 'fathoni@unuja.ac.id',
                'phone' => '081234567892',
                'created_by' => $admin,
                'created_at' => $now,
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | SCHEDULES
        |--------------------------------------------------------------------------
        */

        // DB::table('schedules')->insert([
        //     [
        //         'course_id' => 1,
        //         'lecturer_id' => 1,
        //         'room_id' => 3,
        //         'day_of_week' => 1, // Senin
        //         'start_time' => '08:00',
        //         'end_time' => '10:30',
        //         'created_by' => $admin,
        //         'created_at' => $now,
        //     ],
        //     [
        //         'course_id' => 5, // Struktur Data
        //         'lecturer_id' => 1,
        //         'room_id' => 2,
        //         'day_of_week' => 1, // Senin
        //         'start_time' => '10:30',
        //         'end_time' => '12:00',
        //         'created_by' => $admin,
        //         'created_at' => $now,
        //     ],
        //     [
        //         'course_id' => 6, // Sistem Operasi
        //         'lecturer_id' => 2,
        //         'room_id' => 3,
        //         'day_of_week' => 2, // Selasa
        //         'start_time' => '08:00',
        //         'end_time' => '10:00',
        //         'created_by' => $admin,
        //         'created_at' => $now,
        //     ],
        //     [
        //         'course_id' => 7, // Pemrograman Web
        //         'lecturer_id' => 3,
        //         'room_id' => 2,
        //         'day_of_week' => 2, // Selasa
        //         'start_time' => '10:00',
        //         'end_time' => '12:00',
        //         'created_by' => $admin,
        //         'created_at' => $now,
        //     ],
        //     [
        //         'course_id' => 2, // Jaringan Komputer
        //         'lecturer_id' => 2,
        //         'room_id' => 2,
        //         'day_of_week' => 3, // Rabu
        //         'start_time' => '09:00',
        //         'end_time' => '11:00',
        //         'created_by' => $admin,
        //         'created_at' => $now,
        //     ],
        //     [
        //         'course_id' => 3, // Basis Data
        //         'lecturer_id' => 3,
        //         'room_id' => 1,
        //         'day_of_week' => 3, // Rabu
        //         'start_time' => '13:00',
        //         'end_time' => '15:00',
        //         'created_by' => $admin,
        //         'created_at' => $now,
        //     ],
        //     [
        //         'course_id' => 8, // Rekayasa Perangkat Lunak
        //         'lecturer_id' => 1,
        //         'room_id' => 3,
        //         'day_of_week' => 4, // Kamis
        //         'start_time' => '08:00',
        //         'end_time' => '10:00',
        //         'created_by' => $admin,
        //         'created_at' => $now,
        //     ],
        //     [
        //         'course_id' => 9, // Kecerdasan Buatan
        //         'lecturer_id' => 2,
        //         'room_id' => 3,
        //         'day_of_week' => 4, // Kamis
        //         'start_time' => '10:00',
        //         'end_time' => '12:00',
        //         'created_by' => $admin,
        //         'created_at' => $now,
        //     ],
        //     [
        //         'course_id' => 4, // IoT
        //         'lecturer_id' => 3,
        //         'room_id' => 1,
        //         'day_of_week' => 5, // Jumat
        //         'start_time' => '08:00',
        //         'end_time' => '10:00',
        //         'created_by' => $admin,
        //         'created_at' => $now,
        //     ],
        //     [
        //         'course_id' => 10, // Pemrograman Mobile
        //         'lecturer_id' => 1,
        //         'room_id' => 2,
        //         'day_of_week' => 5, // Jumat
        //         'start_time' => '10:00',
        //         'end_time' => '12:00',
        //         'created_by' => $admin,
        //         'created_at' => $now,
        //     ],
        //     [
        //         'course_id' => 11, // Cloud Computing
        //         'lecturer_id' => 2,
        //         'room_id' => 3,
        //         'day_of_week' => 6, // Sabtu
        //         'start_time' => '08:00',
        //         'end_time' => '10:00',
        //         'created_by' => $admin,
        //         'created_at' => $now,
        //     ],
        //     [
        //         'course_id' => 7, // Pemrograman Web (kelas lain)
        //         'lecturer_id' => 3,
        //         'room_id' => 1,
        //         'day_of_week' => 6, // Sabtu
        //         'start_time' => '10:00',
        //         'end_time' => '12:00',
        //         'created_by' => $admin,
        //         'created_at' => $now,
        //     ]
        // ]);

        DB::table('schedules')->insert([

            // =======================
            // 12 JADWAL HARI SENIN
            // =======================
            [
                'course_id' => 1,
                'lecturer_id' => 1,
                'room_id' => 3,
                'day_of_week' => 1,
                'start_time' => '08:00',
                'end_time' => '09:00',
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'course_id' => 2,
                'lecturer_id' => 1,
                'room_id' => 2,
                'day_of_week' => 1,
                'start_time' => '09:00',
                'end_time' => '10:00',
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'course_id' => 3,
                'lecturer_id' => 2,
                'room_id' => 3,
                'day_of_week' => 1,
                'start_time' => '10:00',
                'end_time' => '11:00',
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'course_id' => 4,
                'lecturer_id' => 3,
                'room_id' => 1,
                'day_of_week' => 1,
                'start_time' => '11:00',
                'end_time' => '12:00',
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'course_id' => 5,
                'lecturer_id' => 1,
                'room_id' => 1,
                'day_of_week' => 1,
                'start_time' => '12:30',
                'end_time' => '13:30',
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'course_id' => 6,
                'lecturer_id' => 1,
                'room_id' => 2,
                'day_of_week' => 1,
                'start_time' => '13:30',
                'end_time' => '14:30',
                'created_by' => $admin,
                'created_at' => $now,
            ],


            // ===============================
            // Hari lain = 1 jadwal saja
            // ===============================
            [
                'course_id' => 6,
                'lecturer_id' => 2,
                'room_id' => 3,
                'day_of_week' => 2, // Selasa
                'start_time' => '08:00',
                'end_time' => '10:00',
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'course_id' => 2,
                'lecturer_id' => 2,
                'room_id' => 2,
                'day_of_week' => 3, // Rabu
                'start_time' => '09:00',
                'end_time' => '11:00',
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'course_id' => 7,
                'lecturer_id' => 1,
                'room_id' => 3,
                'day_of_week' => 4, // Kamis
                'start_time' => '08:00',
                'end_time' => '10:00',
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'course_id' => 4,
                'lecturer_id' => 3,
                'room_id' => 1,
                'day_of_week' => 5, // Jumat
                'start_time' => '08:00',
                'end_time' => '10:00',
                'created_by' => $admin,
                'created_at' => $now,
            ],
            [
                'course_id' => 1,
                'lecturer_id' => 2,
                'room_id' => 3,
                'day_of_week' => 6, // Sabtu
                'start_time' => '08:00',
                'end_time' => '10:00',
                'created_by' => $admin,
                'created_at' => $now,
            ],

        ]);
    }
}
