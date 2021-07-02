<?php

namespace Encore\Admin\Auth\Database;

use App\Locale;
use App\Setting;
use Illuminate\Database\Seeder;
use Waavi\Translation\Models\Language;
use Waavi\Translation\Models\Translation;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        Administrator::truncate();
        Administrator::create([
            'username'  => 'admin',
            'password'  => bcrypt('admin'),
            'name'      => trans('admin::lang.administrator'),
        ]);

        // create a role.
        Role::truncate();
        $administrator = Role::create([
            'name'  => trans('admin::lang.administrator'),
            'slug'  => 'administrator',
        ]);

        // add role to user.
        Administrator::first()->roles()->save($administrator);

        // add default menus.
        Menu::truncate();

        // Dashboard
        $dashboard = Menu::create([
            'parent_id' => 0,
            'order' => 1,
            'title' => trans('admin::lang.dashboard'),
            'icon' => 'fa-bar-chart',
            'uri' => '/',
        ]);

        // Site content
        $content = Menu::create([
            'parent_id' => 0,
            'order'     => 2,
            'title'     => trans('admin::lang.site_content'),
            'icon'      => 'fa-file-word-o',
            'uri'       => '/',
        ]);

            Menu::create([
                'parent_id' => $content->id,
                'order'     => 1,
                'title'     => trans('admin::lang.slides'),
                'icon'      => 'fa-file-image-o',
                'uri'       => 'content/slides',
            ]);

            Menu::create([
                'parent_id' => $content->id,
                'order'     => 2,
                'title'     => trans('admin::lang.realisations'),
                'icon'      => 'fa-image',
                'uri'       => 'content/realisations',
            ]);

            Menu::create([
                'parent_id' => $content->id,
                'order'     => 3,
                'title'     => trans('admin::lang.projects'),
                'icon'      => 'fa-building-o',
                'uri'       => 'content/projects',
            ]);

            Menu::create([
                'parent_id' => $content->id,
                'order'     => 4,
                'title'     => trans('admin::lang.translations'),
                'icon'      => 'fa-file-text-o',
                'uri'       => 'content/translations',
            ]);

            Menu::create([
                'parent_id' => $content->id,
                'order'     => 5,
                'title'     => trans('admin::lang.testimonials'),
                'icon'      => 'fa-users',
                'uri'       => 'content/testimonials',
            ]);

        // Admin
        $admin = Menu::create([
            'parent_id' => 0,
            'order'     => 9999,
            'title'     => trans('admin::lang.admin'),
            'icon'      => 'fa-tasks',
            'uri'       => '',
        ]);

            Menu::create([
                'parent_id' => $admin->id,
                'order'     => 1,
                'title'     => trans('admin::lang.menu'),
                'icon'      => 'fa-bars',
                'uri'       => 'auth/menu',
            ]);

            Menu::create([
                'parent_id' => $admin->id,
                'order'     => 3,
                'title'     => trans('admin::lang.users'),
                'icon'      => 'fa-users',
                'uri'       => 'auth/users',
            ]);

            Menu::create([
                'parent_id' => $admin->id,
                'order'     => 2,
                'title'     => trans('admin::lang.settings'),
                'icon'      => 'fa-cogs',
                'uri'       => 'auth/settings',
            ]);

            Menu::create([
                'parent_id' => $admin->id,
                'order'     => 4,
                'title'     => trans('admin::lang.email_templates'),
                'icon'      => 'fa-envelope-o',
                'uri'       => 'auth/email-templates',
            ]);

            Menu::create([
                'parent_id' => $admin->id,
                'order'     => 5,
                'title'     => trans('admin::lang.operation_log'),
                'icon'      => 'fa-history',
                'uri'       => 'auth/logs',
            ]);

        // add role to menu.
        $admin->roles()->save($administrator);
        $content->roles()->save($administrator);
        $dashboard->roles()->save($administrator);

        // Settings
        Setting::create([
            'key' => 'contact_phone_number',
            'value' => '+32486404267',
            'status' => 'active'
        ]);

        Setting::create([
            'key' => 'contact_email_address',
            'value' => 'office@depanagebruxelles.be',
            'status' => 'active'
        ]);

        Setting::create([
            'key' => 'footer_contact_address',
            'value' => '1014 Lorem Ipsum Dolor Str. #21<br> Bruxelles, Belgique',
            'status' => 'active'
        ]);

        Setting::create([
            'key' => 'facebook',
            'value' => 'http://facebook.com',
            'status' => 'active'
        ]);

        Setting::create([
            'key' => 'google_plus',
            'value' => 'http://plus.google.com',
            'status' => 'active'
        ]);

        foreach (config('localization.locales') as $locale => $localization) {

            Language::create([
                'locale' => $locale,
                'name' => $localization['name'],
            ]);

            Locale::create([
                'locale' => $locale,
                'name' => $localization['name'],
                'native' => $localization['native'],
                'regional' => $localization['regional'],
                'status' => true,
                'default' => $locale === 'fr'
            ]);
        }
    }
}
