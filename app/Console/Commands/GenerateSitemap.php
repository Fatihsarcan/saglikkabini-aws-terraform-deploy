<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Service;
use App\Models\Blog;
use App\Models\Team;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Sitemap dosyasını oluşturur';

    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/hakkimizda'))
            ->add(Url::create('/iletisim'))
            ->add(Url::create('/hizmetler'))
            ->add(Url::create('/ekibimiz'))
            ->add(Url::create('/blogs'));

        Service::all()->each(fn($service) => $sitemap->add(Url::create("/hizmetler/{$service->slug}")));
        Blog::all()->each(fn($blog) => $sitemap->add(Url::create("/makale/{$blog->slug}")));
        Team::all()->each(fn($team) => $sitemap->add(Url::create("/ekibimiz/{$team->slug}")));

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap oluşturuldu ✅');
    }
}
