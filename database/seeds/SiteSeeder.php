<?php

use Illuminate\Database\Seeder;
use App\Site;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $site = new Site() = '';
        $site->title = '';
        $site->description = '';
        $site->url = '';
        $site->ga = '';
        $site->submitted = '';
        $site->git_url = '';
        $site->created_by = '';
        $site->save();
    }
}
