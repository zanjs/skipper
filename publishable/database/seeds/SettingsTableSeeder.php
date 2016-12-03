<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->delete();

        \DB::table('settings')->insert([
            0 => [
                'id'           => 1,
                'key'          => 'title',
                'display_name' => '网站名称',
                'value'        => 'Site Title',
                'details'      => '',
                'type'         => 'text',
                'order'        => 1,
            ],
            1 => [
                'id'           => 2,
                'key'          => 'description',
                'display_name' => '网站描述',
                'value'        => 'Site Description',
                'details'      => '',
                'type'         => 'text',
                'order'        => 2,
            ],
            2 => [
                'id'           => 3,
                'key'          => 'keyword',
                'display_name' => '网站描述',
                'value'        => 'Site Keyword',
                'details'      => '',
                'type'         => 'text',
                'order'        => 3,
            ],
            3 => [
                'id'           => 4,
                'key'          => 'logo',
                'display_name' => '网站 Logo',
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 4,
            ],
            4 => [
                'id'           => 5,
                'key'          => 'admin_bg_image',
                'display_name' => 'Skipper 背景图片',
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => 5,
            ],
            5 => [
                'id'           => 6,
                'key'          => 'admin_title',
                'display_name' => 'Skipper 名称',
                'value'        => 'Skipper',
                'details'      => '',
                'type'         => 'text',
                'order'        => 6,
            ],
            6 => [
                'id'           => 7,
                'key'          => 'admin_description',
                'display_name' => 'Skipper 描述',
                'value'        => 'Welcome to Skipper. Let us explore together',
                'details'      => '',
                'type'         => 'text',
                'order'        => 7,
            ],
            7 => [
                'id'           => 8,
                'key'          => 'google_analytics_client_id',
                'display_name' => 'Google Analytics Client ID',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => 8,
            ],
        ]);
    }
}
