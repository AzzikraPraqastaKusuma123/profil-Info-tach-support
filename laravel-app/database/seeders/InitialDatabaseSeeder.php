<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InitialDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Admin
        DB::table('admins')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'name' => 'Administrator PT. ITS',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Seed Services
        $services = [
            [
                "icon" => "monitor", "title" => "Service Laptop & PC", "category" => "Hardware",
                "desc" => "Kami menangani berbagai kerusakan laptop dan PC dengan penanganan cepat dan bergaransi. Dipercaya oleh ratusan pengguna di Jabodetabek.",
                "features" => json_encode(["Ganti LCD/LED", "Upgrade RAM & SSD", "Perbaikan Motherboard", "Install Ulang OS", "Cleaning & Servis Berkala", "Penggantian Baterai"])
            ],
            [
                "icon" => "wifi", "title" => "Instalasi Jaringan", "category" => "Network",
                "desc" => "Pemasangan dan konfigurasi jaringan LAN/WiFi untuk rumah, kantor, dan gedung komersial dengan perangkat berkualitas tinggi.",
                "features" => json_encode(["Setting Router & Switch", "Instalasi Kabel LAN CAT6", "Konfigurasi WiFi Enterprise", "VPN Setup", "Network Monitoring", "Troubleshooting Jaringan"])
            ],
            [
                "icon" => "camera", "title" => "Pasang CCTV", "category" => "Security",
                "desc" => "Instalasi CCTV profesional untuk keamanan rumah, toko, kantor, dan area publik dengan kamera resolusi tinggi dan bisa dipantau jarak jauh.",
                "features" => json_encode(["CCTV Indoor & Outdoor", "Resolusi HD/Full HD/4K", "Pemantauan via Smartphone", "DVR & NVR Setup", "Kabel & Aksesoris Lengkap", "Garansi Instalasi"])
            ],
            [
                "icon" => "globe", "title" => "Pembuatan Website", "category" => "Digital",
                "desc" => "Desain dan pengembangan website profesional yang responsif, cepat, dan SEO-friendly untuk meningkatkan eksistensi bisnis Anda secara online.",
                "features" => json_encode(["Website Company Profile", "Landing Page", "Website Toko Online", "Sistem Informasi Custom", "Domain & Hosting", "Maintenance Berkala"])
            ],
            [
                "icon" => "wrench", "title" => "Maintenance IT", "category" => "Maintenance",
                "desc" => "Layanan perawatan rutin perangkat komputer dan infrastruktur jaringan untuk memastikan sistem IT Anda selalu berjalan optimal dan bebas masalah.",
                "features" => json_encode(["Perawatan PC Berkala", "Update Software & Antivirus", "Backup Data Rutin", "Monitoring Jaringan", "Penanganan Masalah Cepat", "Laporan Bulanan"])
            ],
            [
                "icon" => "headphones", "title" => "Konsultasi IT", "category" => "Consulting",
                "desc" => "Dapatkan saran dan rekomendasi ahli untuk kebutuhan infrastruktur IT bisnis Anda. Kami membantu Anda membuat keputusan teknologi yang tepat.",
                "features" => json_encode(["Analisis Kebutuhan IT", "Perencanaan Infrastruktur", "Rekomendasi Perangkat", "Audit Keamanan Jaringan", "Optimasi Sistem", "Pendampingan Proyek IT"])
            ]
        ];
        foreach ($services as $s) {
            $s['created_at'] = now();
            $s['updated_at'] = now();
            DB::table('services')->insert($s);
        }

        // 3. Seed Clients
        $clients = [
            ["name" => "PT. Toyota Indonesia", "logo" => "/clients/Toyota.png", "industry" => "Manufaktur"],
            ["name" => "MNC Group", "logo" => "/clients/MNC.png", "industry" => "Media & Telekomunikasi"],
            ["name" => "PT. PLN (Persero)", "logo" => "/clients/PLN.png", "industry" => "Energi"],
            ["name" => "PT. Pertamina", "logo" => "/clients/pertamina.png", "industry" => "Energi"],
            ["name" => "PT. Epson Indonesia", "logo" => "/clients/epson.png", "industry" => "Teknologi"],
            ["name" => "PT. Yamaha Indonesia", "logo" => "/clients/yamaha.png", "industry" => "Otomotif"],
            ["name" => "PT. Pos Indonesia", "logo" => "/clients/pos.png", "industry" => "Logistik"],
            ["name" => "PT. INKA (Persero)", "logo" => "/clients/inka.png", "industry" => "Manufaktur"],
            ["name" => "Telkom Indonesia", "logo" => "/clients/telkom.png", "industry" => "Telekomunikasi"],
            ["name" => "Siloam Hospitals", "logo" => "/clients/siloam.png", "industry" => "Kesehatan"],
            ["name" => "WIKA", "logo" => "/clients/wika.png", "industry" => "Konstruksi"],
            ["name" => "Wings Group", "logo" => "/clients/wings.png", "industry" => "FMCG"],
            ["name" => "Wyndham Hotels", "logo" => "/clients/wyndham.png", "industry" => "Hospitality"],
            ["name" => "Tamansari Hive", "logo" => "/clients/tamansari.png", "industry" => "Properti"],
            ["name" => "PT. Pertani", "logo" => "/clients/Pertani.png", "industry" => "Agrikultur"],
            ["name" => "DIKA", "logo" => "/clients/dika.png", "industry" => "Konsultan"],
            ["name" => "BW", "logo" => "/clients/BW.png", "industry" => "Konsultan"],
            ["name" => "Yayasan", "logo" => "/clients/yayasan.png", "industry" => "Pendidikan/Sosial"],
            ["name" => "Umroh & Haji", "logo" => "/clients/umroh.png", "industry" => "Travel"],
            ["name" => "Mangkuluhur", "logo" => "/clients/mangkuluhur.png", "industry" => "Properti"],
            ["name" => "Reka", "logo" => "/clients/reka.png", "industry" => "Desain & Konstruksi"],
            ["name" => "Intrama", "logo" => "/clients/intrama.png", "industry" => "Perdagangan"],
            ["name" => "Promisco", "logo" => "/clients/promisco.png", "industry" => "Retail"],
            ["name" => "Adi Upaya", "logo" => "/clients/adi upaya.png", "industry" => "Layanan"]
        ];
        foreach ($clients as $c) {
            $c['created_at'] = now();
            $c['updated_at'] = now();
            DB::table('clients')->insert($c);
        }

        // 4. Seed Information (Articles)
        $articles = [
            ["category" => "Tips IT", "title" => "10 Tips Menjaga Laptop Agar Awet dan Tidak Cepat Rusak", "excerpt" => "Laptop adalah investasi penting yang perlu dijaga dengan baik. Berikut 10 tips praktis yang bisa Anda terapkan untuk memperpanjang usia laptop Anda.", "date" => "12 Mei 2025", "author" => "Tim IT Support", "read_time" => "5 menit"],
            ["category" => "Keamanan", "title" => "Pentingnya CCTV untuk Keamanan Bisnis Anda di Era Modern", "excerpt" => "Dengan meningkatnya angka kejahatan, sistem keamanan CCTV bukan lagi sekadar pilihan, melainkan kebutuhan pokok bagi setiap bisnis.", "date" => "5 Mei 2025", "author" => "Tim IT Support", "read_time" => "4 menit"],
            ["category" => "Jaringan", "title" => "Perbedaan WiFi 2.4GHz vs 5GHz: Mana yang Tepat untuk Anda?", "excerpt" => "Bingung memilih frekuensi WiFi yang tepat? Artikel ini menjelaskan perbedaan, kelebihan, dan kekurangan masing-masing frekuensi secara mudah dipahami.", "date" => "28 Apr 2025", "author" => "Tim IT Support", "read_time" => "6 menit"],
            ["category" => "Website", "title" => "Mengapa Bisnis UMKM Wajib Punya Website di Tahun 2025?", "excerpt" => "Di era digital ini, website bukan lagi kemewahan. Temukan alasan mengapa UMKM Anda harus segera go online dan bagaimana cara memulainya.", "date" => "20 Apr 2025", "author" => "Tim IT Support", "read_time" => "7 menit"],
            ["category" => "Tips IT", "title" => "Cara Mudah Mempercepat Komputer Windows yang Lemot", "excerpt" => "Komputer Anda terasa lambat dan membuat frustasi? Ikuti langkah-langkah mudah ini untuk meningkatkan performa PC Anda secara signifikan.", "date" => "15 Apr 2025", "author" => "Tim IT Support", "read_time" => "5 menit"],
            ["category" => "Keamanan", "title" => "Waspada Virus & Malware: Panduan Lengkap Proteksi Komputer", "excerpt" => "Serangan siber semakin canggih. Pelajari cara melindungi perangkat Anda dari berbagai ancaman digital yang mengintai setiap saat.", "date" => "8 Apr 2025", "author" => "Tim IT Support", "read_time" => "8 menit"]
        ];
        foreach ($articles as $a) {
            $a['created_at'] = now();
            $a['updated_at'] = now();
            $a['content'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
            DB::table('information')->insert($a);
        }
    }
}
