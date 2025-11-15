<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    public function run()
    {
        /*
        |--------------------------------------------------------------------------
        | 1. UNUJA TUAN RUMAH KONGRES VIII BEM PTNU
        |--------------------------------------------------------------------------
        */
        News::create([
            'title' => 'UNUJA Tuan Rumah Kongres VIII BEM PTNU: Momen Strategis Mahasiswa Nahdliyin Bangun Kolaborasi',
            'content' => "
Universitas Nurul Jadid (UNUJA) kembali menunjukkan eksistensinya sebagai kampus pesantren yang progresif dengan menjadi tuan rumah Kongres VIII BEM Perguruan Tinggi Nahdlatul Ulama (PTNU). Acara ini diikuti oleh ratusan delegasi mahasiswa dari seluruh Indonesia, menjadikannya salah satu pertemuan terbesar yang mempertemukan kader-kader muda Nahdliyin dalam satu forum intelektual. Penunjukan UNUJA sebagai tuan rumah tidak hanya menjadi bentuk kepercayaan nasional, tetapi juga pengakuan terhadap kapasitas kampus dalam penyelenggaraan kegiatan berskala besar.

Kegiatan dibuka dengan sesi penyambutan oleh pimpinan universitas dan tokoh NU, yang menekankan pentingnya mahasiswa untuk terus mengambil peran strategis dalam isu-isu kebangsaan, pendidikan, hingga pemberdayaan masyarakat. Para peserta diajak mengeksplorasi gagasan baru mengenai arah pergerakan mahasiswa di lingkungan PTNU, terutama dalam menghadapi dinamika sosial dan perkembangan teknologi yang semakin cepat. Kehadiran tokoh-tokoh nasional memberikan suasana diskusi yang kaya dan menambah khazanah pengetahuan bagi seluruh delegasi.

Selama kongres berlangsung, berbagai rangkaian kegiatan digelar, mulai dari sidang pleno, dialog interaktif, hingga forum kajian strategis. Dalam forum ini, mahasiswa tidak hanya membahas isu internal organisasi, tetapi juga merumuskan sikap kolektif terhadap isu publik. UNUJA menyediakan fasilitas terbaik untuk mendukung kenyamanan peserta, mulai dari ruang diskusi, akomodasi, hingga sarana penunjang kegiatan akademik dan organisasi.

Tak hanya menjadi ruang bertukar gagasan, kongres juga membuka kesempatan kolaborasi antar-BEM PTNU di seluruh Indonesia. Berbagai rencana kerja lintas kampus dibahas, termasuk program sosial, peningkatan literasi digital, dan penguatan jejaring advokasi mahasiswa. Para delegasi juga mengunjungi beberapa unit unggulan UNUJA untuk melihat langsung inovasi kampus dalam bidang pendidikan dan pengabdian masyarakat.

Kongres VIII BEM PTNU di UNUJA diharapkan menjadi momentum kebangkitan gerakan mahasiswa Nahdliyin yang lebih solid, modern, dan responsif terhadap tantangan zaman. Penyelenggaraan yang sukses meneguhkan posisi UNUJA sebagai kampus pesantren yang tidak hanya kuat secara akademik, tetapi juga aktif berperan dalam dinamika nasional.
            ",
            'thumbnail' => null,
            'published_at' => Carbon::parse('2025-03-17 23:09'),
            'created_by' => 1,
            'slug' => 'unuja-tuan-rumah-kongres-viii-bem-ptnu-momen-strategis-mahasiswa-nahdliyin-bangun-kolaborasi',
            'status' => 'published',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 2. AUDIT ISO 21001:2018
        |--------------------------------------------------------------------------
        */
        News::create([
            'slug' => 'unuja-perkuat-tata-kelola-pendidikan-melalui-audit-iso-21001-2018',
            'title' => 'UNUJA Perkuat Tata Kelola Pendidikan Melalui Audit ISO 21001:2018',
            'content' => "
UNUJA kembali menegaskan komitmennya dalam peningkatan mutu pendidikan melalui pelaksanaan audit ISO 21001:2018. Standar internasional ini secara khusus dirancang untuk memastikan bahwa lembaga pendidikan menjalankan sistem manajemen yang fokus pada peningkatan layanan bagi peserta didik. Pelaksanaan audit melibatkan peninjauan mendalam terhadap berbagai aspek tata kelola universitas, mulai dari sistem akademik, administrasi, hingga pelayanan mahasiswa.

Pimpinan universitas dalam sambutannya menekankan bahwa audit ISO bukan hanya menjadi agenda formalitas, tetapi benar-benar menjadi instrumen untuk mengukur efektivitas pengelolaan pendidikan di UNUJA. Dengan audit berkala, universitas dapat memastikan bahwa setiap unit kerja menjalankan proses secara terukur, transparan, dan memenuhi standar mutu internasional. Selain itu, audit ini juga menjadi sarana untuk memaksimalkan layanan kampus berbasis teknologi dan kebutuhan mahasiswa modern.

Selama proses audit berlangsung, auditor melakukan serangkaian pemeriksaan dokumen, wawancara dengan berbagai unit layanan, serta observasi langsung pada aktivitas operasional. Berbagai capaian penting universitas turut diapresiasi, termasuk peningkatan layanan digital, penguatan sistem penjaminan mutu internal, dan program-program akademik yang lebih adaptif terhadap perkembangan zaman. Namun demikian, auditor juga memberikan beberapa rekomendasi untuk penguatan berkelanjutan pada beberapa bagian administrasi.

Implementasi ISO 21001:2018 memberikan dampak positif terhadap budaya kerja civitas akademika. Setiap unit didorong untuk mengedepankan profesionalisme, responsivitas, dan dokumentasi proses yang baik. Hal ini memperkuat kepercayaan publik terhadap UNUJA sebagai kampus berkualitas yang berkomitmen tinggi pada layanan pendidikan yang bermutu dan berkelanjutan.

Dengan selesainya audit ini, UNUJA optimis dapat terus memperbaiki diri dan memperkuat posisinya sebagai salah satu perguruan tinggi pesantren yang memiliki tata kelola modern, berdaya saing, serta relevan dengan kebutuhan masyarakat dan perkembangan global.
            ",
            'thumbnail' => null,
            'published_at' => Carbon::parse('2025-03-15 15:52'),
            'created_by' => 1,
            'status' => 'published',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 3. KULIAH UMUM ULAMA AL-AZHAR
        |--------------------------------------------------------------------------
        */
        News::create([
            'slug' => 'unuja-perkuat-pemahaman-syariah-melalui-kuliah-umum-bersama-ulama-al-azhar',
            'title' => 'UNUJA Perkuat Pemahaman Syariah Melalui Kuliah Umum Bersama Ulama Al-Azhar',
            'content' => "
UNUJA kembali menunjukkan komitmennya dalam penguatan pengembangan keilmuan Islam melalui kuliah umum bersama ulama besar dari Universitas Al-Azhar Mesir. Kegiatan ini menjadi kesempatan berharga bagi mahasiswa dan dosen untuk memperluas wawasan keagamaan yang bersifat moderat, ilmiah, dan sejalan dengan tradisi Islam yang rahmatan lil alamin. Kuliah umum ini disambut antusias oleh ratusan peserta dari berbagai program studi.

Dalam pemaparannya, ulama Al-Azhar menjelaskan pentingnya memahami syariah Islam secara komprehensif dan kontekstual, bukan hanya dari teks, tetapi juga dari realitas sosial. Beliau menekankan bahwa generasi muda Muslim harus mampu menjadi agen yang membawa nilai-nilai Islam yang damai, toleran, dan menghargai keberagaman. Mahasiswa diajak untuk tidak hanya memahami fiqh secara normatif, tetapi juga hikmah dan tujuan syariah (maqashid syariah).

Acara ini diisi dengan dialog interaktif yang memungkinkan mahasiswa mengajukan berbagai pertanyaan tentang isu-isu keagamaan kontemporer, mulai dari moderasi beragama, fiqh peradaban, hingga perkembangan ilmu keislaman di dunia internasional. Diskusi berlangsung hangat dan membuka pemahaman baru bagi peserta yang terlibat. Hal ini juga memperkuat hubungan akademik antara UNUJA dengan lembaga pendidikan internasional.

Selain itu, kegiatan ini memperlihatkan pentingnya kolaborasi global antar-institusi pendidikan Islam. Melalui kunjungan ini, UNUJA berharap dapat melanjutkan kerja sama akademik dengan Al-Azhar dalam bentuk pertukaran dosen, seminar internasional, dan pengembangan kurikulum berbasis moderasi beragama. Hal ini sekaligus memperkuat visi UNUJA sebagai pusat pengembangan studi Islam yang moderat.

Kuliah umum ini diharapkan mampu memberikan inspirasi bagi mahasiswa dalam memperdalam keilmuan Islam dengan pendekatan yang lebih luas dan relevan dengan kebutuhan masyarakat. UNUJA berkomitmen untuk terus menghadirkan kegiatan akademik berkualitas yang memperkaya wawasan civitas akademika.
            ",
            'thumbnail' => null,
            'published_at' => Carbon::parse('2025-03-09 23:58'),
            'created_by' => 1,
            'status' => 'published',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 4. KUNJUNGAN TSUST TAIWAN
        |--------------------------------------------------------------------------
        */
        News::create([
            'slug' => 'kunjungan-tsust-taiwan-ke-unuja-perkuat-kolaborasi-akademik-dan-daya-saing-lulusan',
            'title' => 'Kunjungan TSUST Taiwan ke UNUJA: Perkuat Kolaborasi Akademik dan Daya Saing Lulusan',
            'content' => "
Delegasi dari Tzu Chi University of Science and Technology (TSUST) Taiwan melakukan kunjungan resmi ke UNUJA dalam rangka memperkuat kerja sama internasional di bidang pendidikan, penelitian, dan pengembangan sumber daya manusia. Kunjungan ini merupakan tindak lanjut dari komunikasi akademik yang telah terbangun sebelumnya, sekaligus membuka peluang bagi mahasiswa UNUJA untuk mendapatkan kesempatan belajar dan magang di luar negeri.

Dalam pertemuan tersebut, kedua institusi membahas berbagai bentuk kolaborasi, termasuk program pertukaran mahasiswa, pengembangan kurikulum berbasis industri, serta kerja sama penelitian di bidang teknologi kesehatan, lingkungan, dan sosial humaniora. Pihak TSUST mengapresiasi langkah UNUJA yang dinilai progresif dalam membangun atmosfer akademik bertaraf global, terutama melalui berbagai program internasionalisasi kampus.

Delegasi TSUST juga diajak mengunjungi beberapa unit unggulan UNUJA seperti laboratorium teknologi, pusat riset, dan inkubator bisnis. Mereka melihat langsung bagaimana mahasiswa dilatih untuk memiliki kemampuan inovasi, kreativitas, dan karakter pesantren yang kuat. Kunjungan ini memberikan kesan positif dan membuka peluang kolaborasi yang lebih strategis di masa mendatang.

Selain aspek akademik, kunjungan ini juga membahas pentingnya pengembangan soft skills dan kemampuan bahasa asing sebagai penunjang daya saing lulusan. TSUST menawarkan beberapa program pelatihan intensif dan kesempatan belajar di Taiwan yang dapat diikuti oleh mahasiswa dan dosen UNUJA. Hal ini diharapkan dapat meningkatkan kualitas dan kompetensi lulusan di pasar global.

Kolaborasi UNUJA dan TSUST diharapkan menjadi pintu pembuka bagi kerja sama internasional lainnya. Dengan semakin banyaknya peluang global, UNUJA menegaskan komitmennya untuk melahirkan lulusan berkarakter pesantren namun memiliki wawasan global dan kompetensi internasional.
            ",
            'thumbnail' => null,
            'published_at' => Carbon::parse('2025-02-25 20:07'),
            'created_by' => 1,
            'status' => 'published',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 5. KOPERTAIS IV AWARD 2025
        |--------------------------------------------------------------------------
        */
        News::create([
            'slug' => 'kopertais-iv-award-2025-unuja-raih-empat-penghargaan-bergengsi',
            'title' => 'Kopertais IV Award 2025: UNUJA Raih Empat Penghargaan Bergengsi',
            'content' => "
UNUJA kembali mencatatkan prestasi membanggakan dengan berhasil meraih empat penghargaan sekaligus pada ajang Kopertais Wilayah IV Award 2025. Penghargaan ini diberikan sebagai bentuk apresiasi atas dedikasi dan prestasi kampus dalam bidang akademik, pengabdian kepada masyarakat, manajemen mutu, dan inovasi kelembagaan. Keberhasilan ini tidak hanya menunjukkan kualitas internal universitas, tetapi juga reputasi UNUJA dalam jaringan perguruan tinggi keagamaan Islam.

Pada malam penganugerahan, perwakilan Kopertais IV menyampaikan bahwa UNUJA merupakan salah satu kampus yang menunjukkan perkembangan signifikan dalam beberapa tahun terakhir. Peningkatan layanan akademik, program digitalisasi, serta penguatan budaya riset menjadi faktor utama yang mengantarkan universitas meraih penghargaan bergengsi ini. Prestasi ini juga menjadi indikator bahwa kerja keras seluruh civitas akademika berjalan pada arah yang tepat.

Penghargaan yang diraih menjadi motivasi bagi UNUJA untuk terus memperkuat kualitas tata kelola institusi. Dalam proses penilaian, Kopertais menyoroti berbagai inovasi kampus seperti sistem akademik digital, peningkatan kualitas publikasi ilmiah dosen, serta pengembangan kurikulum berbasis kompetensi. Program pengabdian masyarakat yang dilakukan secara berkelanjutan juga mendapatkan apresiasi khusus dari tim penilai.

Dalam sambutannya, pimpinan UNUJA menyampaikan bahwa capaian ini merupakan hasil sinergi antara dosen, mahasiswa, tenaga kependidikan, serta seluruh unit kerja di kampus. Ke depan, UNUJA berkomitmen untuk terus berbenah dan meningkatkan kualitas layanan pendidikan guna menjawab kebutuhan masyarakat modern. Prestasi ini juga diharapkan menjadi motivasi bagi mahasiswa untuk terus meningkatkan kompetensi diri.

Dengan raihan empat penghargaan ini, UNUJA kembali menegaskan posisinya sebagai kampus pesantren modern yang tidak hanya unggul secara spiritual, tetapi juga berdaya saing tinggi dalam dunia pendidikan tinggi nasional. Tahun 2025 menjadi momentum penting bagi UNUJA untuk semakin berkembang dan memperluas kiprahnya di tingkat regional maupun nasional.
            ",
            'thumbnail' => null,
            'published_at' => Carbon::parse('2025-02-13 13:55'),
            'created_by' => 1,
            'status' => 'published',
        ]);

        // 6
        News::create([
            'slug' => 'unuja-dan-pemerintah-daerah-bahas-penguatan-sdm-menuju-transformasi-digital',
            'title' => 'UNUJA dan Pemerintah Daerah Bahas Penguatan SDM Menuju Transformasi Digital',
            'content' => '
        Universitas Nurul Jadid (UNUJA) kembali menggelar diskusi strategis bersama pemerintah daerah 
        dalam rangka memperkuat kualitas Sumber Daya Manusia menghadapi percepatan transformasi digital nasional. 
        Pertemuan ini diadakan di Ruang Rapat Rektorat dan dihadiri pimpinan UNUJA, kepala dinas dari berbagai sektor, 
        serta sejumlah praktisi teknologi yang telah berpengalaman dalam membangun ekosistem digital di daerah.

        Dalam pertemuan tersebut, UNUJA menegaskan komitmennya untuk terus memfasilitasi transfer pengetahuan dan 
        penyediaan tenaga ahli melalui berbagai program seperti Digital Talent Camp, pelatihan literasi digital, dan 
        kerja sama riset berbasis teknologi. Pemerintah daerah menyambut positif kolaborasi ini karena dinilai sebagai 
        langkah nyata dalam mempercepat adopsi teknologi di sektor layanan publik, UMKM, pendidikan, dan pengelolaan 
        data berbasis sistem informasi.

        Diskusi juga menyoroti pentingnya pengembangan infrastruktur digital, peningkatan kompetensi aparatur, dan 
        penyusunan roadmap kolaboratif antara kampus dan pemerintah. Dengan adanya kerja sama ini, kedua belah pihak 
        berharap dapat menciptakan lingkungan digital yang inklusif dan adaptif terhadap tantangan global.
    ',
            'thumbnail' => 'news6.jpg',
            'published_at' => now(),
            'created_by' => 1,
            'status' => 'published',
        ]);

        // 7
        News::create([
            'slug' => 'fakultas-teknik-unuja-luncurkan-program-riset-energi-terbarukan-untuk-komunitas-pesisir',
            'title' => 'Fakultas Teknik UNUJA Luncurkan Program Riset Energi Terbarukan untuk Komunitas Pesisir',
            'content' => '
        Fakultas Teknik Universitas Nurul Jadid secara resmi meluncurkan program riset energi terbarukan yang 
        difokuskan untuk membantu komunitas pesisir dalam memenuhi kebutuhan energi yang ramah lingkungan. 
        Program ini merupakan hasil dari pengamatan lapangan terhadap kesulitan masyarakat pesisir yang masih 
        mengandalkan sumber energi konvensional dan menghadapi biaya operasional yang tinggi.

        Salah satu fokus riset adalah pengembangan panel surya efisiensi menengah yang dapat dioperasikan di 
        lingkungan berkelembaban tinggi, serta teknologi turbin angin skala kecil yang mampu berfungsi stabil meski 
        dengan kecepatan angin yang berubah-ubah. Selain itu, mahasiswa juga dilibatkan dalam pembuatan prototipe 
        battery pack hemat biaya yang dirancang untuk kebutuhan penerangan dan alat tangkap ikan.

        Program riset ini diharapkan dapat menghasilkan model teknologi terbarukan yang dapat direplikasi di berbagai 
        wilayah pesisir lainnya. Fakultas Teknik menegaskan bahwa riset ini bukan hanya akademis, tetapi juga memiliki 
        misi sosial untuk mendukung kemandirian energi masyarakat.
    ',
            'thumbnail' => 'news7.jpg',
            'published_at' => now(),
            'created_by' => 1,
            'status' => 'published',
        ]);

        // 8
        News::create([
            'slug' => 'mahasiswa-unuja-sabet-penghargaan-nasional-dalam-ajang-inovasi-teknologi-pendidikan',
            'title' => 'Mahasiswa UNUJA Sabet Penghargaan Nasional dalam Ajang Inovasi Teknologi Pendidikan',
            'content' => '
        Prestasi membanggakan kembali diraih mahasiswa Universitas Nurul Jadid setelah tim inovasi teknologi pendidikan 
        berhasil meraih penghargaan nasional dalam gelaran Indonesian Education Technology Competition. Tim UNUJA 
        mengusung produk "EduSim VR", sebuah platform pembelajaran berbasis simulasi virtual reality yang dirancang 
        untuk memudahkan siswa memahami konsep-konsep abstrak dalam sains dan matematika.

        Produk EduSim VR dikembangkan selama hampir satu tahun melalui kolaborasi lintas fakultas, mulai dari Fakultas 
        Teknik, Fakultas Tarbiyah, hingga Fakultas Ekonomi. Juri memuji pendekatan interdisipliner yang digunakan tim, 
        karena platform tersebut mampu menggabungkan rekayasa perangkat lunak, pedagogi modern, dan user experience 
        yang menarik bagi siswa generasi digital.

        Penghargaan tersebut menjadi bukti bahwa mahasiswa UNUJA mampu bersaing di tingkat nasional dan memiliki potensi 
        besar untuk menjadi inovator di bidang teknologi pendidikan. Saat ini tim sedang mempersiapkan versi komersial 
        dari produk tersebut untuk digunakan oleh sekolah-sekolah mitra.
    ',
            'thumbnail' => 'news8.jpg',
            'published_at' => now(),
            'created_by' => 1,
            'status' => 'published',
        ]);

        // 9
        News::create([
            'slug' => 'unuja-dan-industri-perikanan-sepakat-bangun-sistem-monitoring-logistik-berbasis-iot',
            'title' => 'UNUJA dan Industri Perikanan Sepakat Bangun Sistem Monitoring Logistik Berbasis IoT',
            'content' => '
        Dalam upaya meningkatkan efisiensi logistik hasil laut, UNUJA menjalin kerja sama dengan beberapa pelaku industri 
        perikanan untuk membangun sistem monitoring berbasis Internet of Things (IoT). Sistem ini dirancang untuk 
        memantau kondisi suhu, kelembaban, dan pergerakan distribusi ikan mulai dari kapal hingga fasilitas penyimpanan.

        Kolaborasi ini diprakarsai oleh Pusat Penelitian dan Pengabdian kepada Masyarakat UNUJA setelah melihat adanya 
        tantangan besar dalam menjaga kualitas ikan selama proses transportasi. Melalui teknologi IoT, data kondisi 
        logistik dapat diakses secara real-time sehingga pelaku industri dapat mengambil keputusan cepat apabila terjadi 
        perubahan suhu atau kendala operasional lainnya.

        Pihak industri menyambut baik inisiatif ini karena diyakini dapat menekan angka kerusakan produk dan menghemat 
        biaya distribusi. Sementara itu, UNUJA berencana menjadikan proyek ini sebagai laboratorium riset terbuka agar 
        mahasiswa dapat turut terlibat dalam pengembangan dan penyempurnaan teknologi.
    ',
            'thumbnail' => 'news9.jpg',
            'published_at' => now(),
            'created_by' => 1,
            'status' => 'published',
        ]);

        // 10
        News::create([
            'slug' => 'program-pengabdian-unuja-berikan-pelatihan-manajemen-keuangan-untuk-umkm-desa',
            'title' => 'Program Pengabdian UNUJA Berikan Pelatihan Manajemen Keuangan untuk UMKM Desa',
            'content' => '
        Sebagai bagian dari komitmen untuk meningkatkan kesejahteraan masyarakat, UNUJA menggelar program pengabdian 
        berupa pelatihan manajemen keuangan khusus bagi pelaku UMKM desa. Pelatihan ini berfokus pada pencatatan 
        keuangan sederhana, perencanaan modal, analisis keuntungan, hingga pemanfaatan aplikasi keuangan digital.

        Peserta pelatihan merupakan para pelaku usaha kecil seperti pengrajin, pedagang, dan produsen makanan lokal yang 
        selama ini belum memiliki sistem keuangan yang tertata. Dengan adanya pendampingan dari tim dosen dan mahasiswa, 
        para pemilik usaha mulai memahami pentingnya transparansi, perencanaan jangka panjang, serta evaluasi berkala 
        terhadap arus kas.

        Program ini juga menghasilkan sejumlah rencana tindak lanjut, termasuk klinik keuangan bulanan dan pendampingan 
        langsung dalam mengembangkan strategi pemasaran digital. Diharapkan melalui program ini UMKM desa dapat tumbuh 
        lebih stabil dan mampu bersaing dengan pasar yang lebih luas.
    ',
            'thumbnail' => 'news10.jpg',
            'published_at' => now(),
            'created_by' => 1,
            'status' => 'published',
        ]);
        // 11
        News::create([
            'slug' => 'unuja-gelar-seminar-kepemimpinan-milenial-untuk-membangun-generasi-visioner',
            'title' => 'UNUJA Gelar Seminar Kepemimpinan Milenial untuk Membangun Generasi Visioner',
            'content' => '
        Universitas Nurul Jadid (UNUJA) melalui Biro Kemahasiswaan mengadakan Seminar Kepemimpinan Milenial 
        yang bertujuan membentuk generasi muda yang visioner, adaptif, dan memiliki kemampuan komunikasi publik yang kuat. 
        Seminar ini menghadirkan pembicara nasional dari kalangan profesional, aktivis muda, serta akademisi yang telah 
        mendapatkan pengakuan atas kontribusinya dalam pemberdayaan pemuda.

        Dalam pemaparannya, para pembicara menekankan pentingnya pemuda untuk mampu membaca perubahan zaman dan berani 
        mengambil peran strategis dalam masyarakat. Peserta seminar juga mendapatkan pelatihan mini tentang manajemen 
        konflik, penyusunan program kerja organisasi, serta teknik presentasi profesional.

        Acara ditutup dengan sesi mentoring intensif antara pembicara dan mahasiswa terpilih, yang nantinya akan dipantau 
        selama enam bulan untuk melihat perkembangan kepemimpinan mereka dalam organisasi kampus dan kegiatan sosial.
    ',
            'thumbnail' => 'news11.jpg',
            'published_at' => now(),
            'created_by' => 1,
            'status' => 'published',
        ]);

        // 12
        News::create([
            'slug' => 'program-kemandirian-desa-didukung-unuja-melalui-inovasi-pertanian-modern',
            'title' => 'Program Kemandirian Desa Didukung UNUJA Melalui Inovasi Pertanian Modern',
            'content' => '
        UNUJA kembali menunjukkan kontribusi nyatanya dalam pembangunan desa melalui program kemandirian berbasis 
        inovasi pertanian modern. Tim dari Fakultas Pertanian dan Pusat Pengabdian turun langsung mendampingi petani 
        dalam meningkatkan produktivitas padi dan hortikultura dengan metode hidroponik, fertigasi, dan pemantauan tanah 
        berbasis sensor.

        Para petani mendapatkan pelatihan intensif tentang penggunaan pupuk cair organik, manajemen air, serta teknik 
        panen berkelanjutan yang dapat mengurangi biaya produksi tanpa menurunkan kualitas hasil. Program ini juga 
        memperkenalkan aplikasi monitoring berbasis mobile yang digunakan untuk mencatat perkembangan tanaman setiap hari.

        Dengan adanya pendampingan yang berkesinambungan, para petani mulai merasakan perubahan signifikan dalam efisiensi 
        kerja dan peningkatan hasil panen. Program ini diharapkan dapat menjadi model bagi desa-desa lain yang ingin 
        memperkuat ketahanan pangan secara mandiri.
    ',
            'thumbnail' => 'news12.jpg',
            'published_at' => now(),
            'created_by' => 1,
            'status' => 'published',
        ]);

        // 13
        News::create([
            'slug' => 'unuja-resmikan-laboratorium-multimedia-kreatif-untuk-dukung-industri-digital',   
            'title' => 'UNUJA Resmikan Laboratorium Multimedia Kreatif untuk Dukung Industri Digital',
            'content' => '
        Dalam rangka mendukung perkembangan industri kreatif digital, UNUJA meresmikan Laboratorium Multimedia Kreatif 
        yang dilengkapi dengan perangkat produksi video, studio podcast, ruang animasi, dan perangkat editing profesional. 
        Laboratorium ini dibangun sebagai fasilitas modern yang dapat dimanfaatkan oleh mahasiswa dari berbagai program 
        studi yang ingin mengembangkan keterampilan di bidang desain grafis, animasi, videografi, hingga produksi konten.

        Rektor UNUJA dalam sambutannya menyampaikan bahwa industri digital menjadi salah satu sektor paling cepat tumbuh 
        dalam era ekonomi modern. Oleh karena itu, kampus perlu menyediakan ruang eksperimen yang memungkinkan mahasiswa 
        untuk berlatih menghasilkan karya berkualitas tinggi sekaligus menyiapkan portofolio profesional.

        Lab ini juga direncanakan menjadi pusat kolaborasi dengan komunitas kreator lokal serta menjadi tuan rumah berbagai 
        workshop dan kompetisi seni digital. Harapannya, tenaga kreatif baru dapat lahir dari lingkungan kampus untuk 
        berkontribusi pada ekonomi kreatif nasional.
    ',
            'thumbnail' => 'news13.jpg',
            'published_at' => now(),
            'created_by' => 1,
            'status' => 'published',
        ]);

        // 14
        News::create([
            'slug' => 'unuja-tingkatkan-kerja-sama-internasional-melalui-program-pertukaran-dosen',
            'title' => 'UNUJA Tingkatkan Kerja Sama Internasional Melalui Program Pertukaran Dosen',
            'content' => '
        Dalam upaya memperluas jejaring akademik global, UNUJA menandatangani kerja sama baru dengan beberapa universitas 
        di Asia Tenggara untuk menjalankan program pertukaran dosen. Program ini memungkinkan dosen UNUJA mengajar di 
        kampus mitra dan sebaliknya, sehingga tercipta pertukaran ilmu, metode pengajaran, serta pengalaman riset yang 
        berharga bagi kedua belah pihak.

        Program pertukaran ini berlangsung selama dua hingga empat minggu dan mencakup kegiatan seperti kuliah umum, 
        lokakarya riset, serta pengembangan kurikulum berbasis internasional. Dosen UNUJA yang berpartisipasi akan 
        mendapatkan kesempatan untuk mempelajari praktik pendidikan di luar negeri sambil memperkenalkan model pendidikan 
        pesantren terpadu yang menjadi ciri khas UNUJA.

        Kerja sama ini menjadi langkah strategis untuk mengembangkan kualitas akademik dan memperkuat posisi UNUJA sebagai 
        kampus yang terbuka terhadap inovasi global dan kolaborasi internasional.
    ',
            'thumbnail' => 'news14.jpg',
            'published_at' => now(),
            'created_by' => 1,
            'status' => 'published',
        ]);

        // 15
        News::create([
            'slug' => 'prestasi-gemilang-ukm-robotik-unuja-raih-juara-dalam-lomba-robot-cerdas-nasional-2025',
            'title' => 'Prestasi Gemilang: UKM Robotik UNUJA Raih Juara Dalam Lomba Robot Cerdas Nasional 2025',
            'content' => '
        Unit Kegiatan Mahasiswa Robotik UNUJA kembali menorehkan prestasi membanggakan dengan meraih juara pada Lomba 
        Robot Cerdas Nasional 2025. Kompetisi yang berlangsung di Surabaya ini diikuti oleh lebih dari 40 tim dari 
        berbagai universitas ternama di Indonesia. Tim UNUJA berhasil memenangkan kategori Robot Navigasi Cerdas melalui 
        inovasi perangkat lunak yang mampu membaca lingkungan sekitarnya secara akurat menggunakan sensor LIDAR 
        miniatur dan algoritma penghindaran rintangan.

        Perjalanan tim menuju kemenangan tidak mudah. Mereka menghabiskan waktu berbulan-bulan untuk melakukan latihan, 
        uji lapangan, dan penyempurnaan perangkat. Salah satu keunggulan tim UNUJA adalah kemampuan mereka menggabungkan 
        kecerdasan buatan berbasis machine learning dengan sistem kontrol mekanik yang stabil.

        Prestasi ini tidak hanya membawa kebanggaan bagi kampus, tetapi juga menjadi inspirasi bagi mahasiswa lain untuk 
        terus berkarya dalam bidang teknologi robotika. Pihak kampus menyatakan akan memberikan dukungan penuh bagi 
        pengembangan lebih lanjut agar tim robotik bisa bersaing di kompetisi internasional.
    ',
            'thumbnail' => 'news15.jpg',
            'published_at' => now(),
            'created_by' => 1,
            'status' => 'published',
        ]);
    }
}
