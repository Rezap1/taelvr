<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'Fakultas Teknik Universitas Suryakancana', 'type' => 'text', 'group' => 'general', 'description' => 'Nama website yang tampil di header dan title'],
            ['key' => 'site_description', 'value' => 'Website Resmi Pendaftaran Mahasiswa Baru Fakultas Teknik Universitas Suryakancana Cianjur', 'type' => 'textarea', 'group' => 'general', 'description' => 'Deskripsi singkat website untuk keperluan SEO'],
            ['key' => 'site_logo', 'value' => null, 'type' => 'image', 'group' => 'general', 'description' => 'Logo utama website (header)'],
            ['key' => 'site_favicon', 'value' => null, 'type' => 'image', 'group' => 'general', 'description' => 'Ikon kecil di tab browser (favicon)'],
            
            // Contact
            ['key' => 'contact_email', 'value' => 'info@ftunsur.ac.id', 'type' => 'text', 'group' => 'contact', 'description' => 'Email resmi fakultas'],
            ['key' => 'contact_phone', 'value' => '+62 263 262788', 'type' => 'text', 'group' => 'contact', 'description' => 'Nomor telepon resmi fakultas'],
            ['key' => 'contact_address', 'value' => 'Jl. Pasir Gede Raya, Kel. Bojongherang, Kec. Cianjur, Kab. Cianjur, Jawa Barat 43216', 'type' => 'textarea', 'group' => 'contact', 'description' => 'Alamat lengkap kampus'],
            ['key' => 'contact_map', 'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.5471927702815!2d107.1423851!3d-6.8247754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68525b6a71e7c5%3A0x6b80112fb1812833!2sFakultas%20Teknik%20Universitas%20Suryakancana!5e0!3m2!1sen!2sid!4v1699940123456!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'type' => 'textarea', 'group' => 'contact', 'description' => 'Kode embed iframe Google Maps'],

            // Social Media
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/ftunsur', 'type' => 'text', 'group' => 'social', 'description' => 'Link Facebook'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/ftunsur', 'type' => 'text', 'group' => 'social', 'description' => 'Link Instagram'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/c/ftunsur', 'type' => 'text', 'group' => 'social', 'description' => 'Link YouTube'],
            ['key' => 'social_tiktok', 'value' => 'https://tiktok.com/@ftunsur', 'type' => 'text', 'group' => 'social', 'description' => 'Link TikTok'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com/school/ftunsur', 'type' => 'text', 'group' => 'social', 'description' => 'Link LinkedIn'],

            // SEO & Analytics
            ['key' => 'seo_keywords', 'value' => 'kampus teknik, ft unsur, teknik informatika, teknik sipil, teknik industri, cianjur', 'type' => 'textarea', 'group' => 'seo', 'description' => 'Kata kunci (keywords) untuk SEO (pisahkan dengan koma)'],
            ['key' => 'seo_google_site_verification', 'value' => '', 'type' => 'text', 'group' => 'seo', 'description' => 'Google Site Verification Code'],
            ['key' => 'seo_bing_site_verification', 'value' => '', 'type' => 'text', 'group' => 'seo', 'description' => 'Bing Site Verification Code'],
            ['key' => 'seo_google_analytics', 'value' => '', 'type' => 'text', 'group' => 'seo', 'description' => 'Google Analytics Tracking ID (G-XXXXXXX)'],
            
            // Footer
            ['key' => 'footer_copyright', 'value' => '© 2026 Fakultas Teknik Universitas Suryakancana. All Rights Reserved.', 'type' => 'text', 'group' => 'general', 'description' => 'Teks copyright di bagian bawah website'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
