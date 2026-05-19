<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // general
            ['key' => 'site_name_ar',    'value' => 'SkyRoute',                    'type' => 'text',     'label' => 'اسم الموقع (عربي)',         'group' => 'general'],
            ['key' => 'site_name_en',    'value' => 'SkyRoute',                    'type' => 'text',     'label' => 'اسم الموقع (إنجليزي)',       'group' => 'general'],
            ['key' => 'site_tagline_ar', 'value' => 'رحلاتك بين يديك',             'type' => 'text',     'label' => 'وصف الموقع (عربي)',          'group' => 'general'],
            ['key' => 'site_tagline_en', 'value' => 'Your flights at your fingertips', 'type' => 'text', 'label' => 'وصف الموقع (إنجليزي)',     'group' => 'general'],
            ['key' => 'contact_email',   'value' => '',                            'type' => 'text',     'label' => 'البريد الإلكتروني للتواصل', 'group' => 'general'],

            // appearance
            ['key' => 'site_logo',       'value' => '',                            'type' => 'image',    'label' => 'شعار الموقع',               'group' => 'appearance'],
            ['key' => 'site_favicon',    'value' => '',                            'type' => 'image',    'label' => 'أيقونة الموقع (Favicon)',   'group' => 'appearance'],
            ['key' => 'primary_color',   'value' => '#1a5fff',                    'type' => 'color',    'label' => 'اللون الرئيسي',             'group' => 'appearance'],

            // hero
            ['key' => 'hero_title_ar',   'value' => 'رحلتك القادمة تبدأ من هنا', 'type' => 'text',     'label' => 'عنوان الهيرو (عربي)',        'group' => 'hero'],
            ['key' => 'hero_title_en',   'value' => 'Your next journey starts here', 'type' => 'text',  'label' => 'عنوان الهيرو (إنجليزي)',   'group' => 'hero'],
            ['key' => 'hero_sub_ar',     'value' => 'قارن أسعار مئات شركات الطيران في ثوانٍ، واحجز بأفضل سعر مضمون.', 'type' => 'textarea', 'label' => 'وصف الهيرو (عربي)', 'group' => 'hero'],
            ['key' => 'hero_sub_en',     'value' => 'Compare hundreds of airlines in seconds and book at the best guaranteed price.', 'type' => 'textarea', 'label' => 'وصف الهيرو (إنجليزي)', 'group' => 'hero'],

            // footer
            ['key' => 'footer_text',     'value' => '© 2026 SkyRoute · Travelpayouts Partner', 'type' => 'text', 'label' => 'نص التذييل', 'group' => 'footer'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
