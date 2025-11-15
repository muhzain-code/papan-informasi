<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- Konfigurasi settings ---
        $settings = [
            // Text
            ['key' => 'site_name', 'value' => 'Website Saya', 'type' => 'text'],
            ['key' => 'site_description', 'value' => 'Deskripsi singkat website saya', 'type' => 'text'],
            ['key' => 'contact_email', 'value' => 'admin@example.com', 'type' => 'email'],
            ['key' => 'contact_phone', 'value' => '+628123456789', 'type' => 'text'],
            ['key' => 'address', 'value' => 'Jl. Contoh No.123, Kota, Negara', 'type' => 'text'],

            // Gambar
            ['key' => 'logo', 'value' => 'storage/settings/logo.png', 'type' => 'image'],
            ['key' => 'favicon', 'value' => 'storage/settings/favicon.ico', 'type' => 'image'],
            ['key' => 'banner', 'value' => 'storage/settings/banner.jpg', 'type' => 'image'],

            // Video
            ['key' => 'intro_video', 'value' => 'storage/settings/intro.mp4', 'type' => 'video'],

            // Sosial media / link
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/username', 'type' => 'link'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/username', 'type' => 'link'],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com/channel/xxxx', 'type' => 'link'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/username', 'type' => 'link'],

            // Boolean / on-off
            ['key' => 'maintenance_mode', 'value' => 'off', 'type' => 'boolean'],

            // Lain-lain
            ['key' => 'footer_text', 'value' => 'Hak Cipta © 2025 Website Saya', 'type' => 'text'],
            ['key' => 'analytics_code', 'value' => '<script>/* GA Code */</script>', 'type' => 'text'],
        ];

        // Insert atau update otomatis
        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'type' => $setting['type']]
            );
        }

        $this->command->info('✅ Default settings berhasil di-seed!');
    }
}
