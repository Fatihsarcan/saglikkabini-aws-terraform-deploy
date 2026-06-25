<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LanguageController;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Service;
use App\Models\Blog;
use App\Models\Team;

Route::middleware(['setLocale', 'mainSettings'])->group(function () {
    Route::get('/', [PageController::class, 'index'])->name('anasayfa');
    Route::get('/hakkimizda', [PageController::class, 'about'])->name('hakkimizda');
    Route::get('/iletisim', [PageController::class, 'contact'])->name('iletisim');
    Route::get('/hizmetler', [PageController::class, 'services'])->name('hizmetler');
    Route::get('/hizmetler/{slug}', [PageController::class, 'service'])->name('hizmet');

    Route::get('/language/{lang}', [LanguageController::class, 'switchLang'])->name('language');
    Route::get('/kategori/{slug}', [PageController::class, 'category'])->name('kategori.detay');
    Route::get('/ekibimiz', [PageController::class, 'team'])->name('ekibimiz');
    Route::get('/ekibimiz/{slug}', [PageController::class, 'team'])->name('ekibimiz.detay');
    Route::get('/artisan235711', [PageController::class, 'artisan'])->name('artisan');



    Route::get('/blogs', [PageController::class, 'blog'])->name('blog');

    Route::get('/makale/{slug}', [PageController::class, 'blogDetail'])->name('blog.detay.tr');
    Route::get('/article/{slug}', [PageController::class, 'blogDetail'])->name('blog.detay.en');

    Route::post('/iletisim', [PageController::class, 'contactSend'])->name('iletisim.post');
    Route::post('/subscribe', [PageController::class, 'subscribe'])->name('subscribe.post');
    Route::post('/randevu', [PageController::class, 'randevu'])->name('randevu.post');
});
Route::get('/generate-sitemap', function () {

    $sitemap = Sitemap::create()
        // Statik sayfalar
        ->add(Url::create('/'))
        ->add(Url::create('/hakkimizda'))
        ->add(Url::create('/iletisim'))
        ->add(Url::create('/hizmetler'))
        ->add(Url::create('/ekibimiz'))
        ->add(Url::create('/blogs'));

    // Dinamik Hizmetler
    Service::all()->each(function($service) use ($sitemap) {
        $sitemap->add(Url::create("/hizmetler/{$service->slug}"));
    });

    // Dinamik Blog Yazıları
    Blog::all()->each(function($blog) use ($sitemap) {
        $sitemap->add(Url::create("/makale/{$blog->slug}"));
    });

    // Dinamik Team Detayları
    Team::all()->each(function($team) use ($sitemap) {
        $sitemap->add(Url::create("/ekibimiz/{$team->slug}"));
    });

    $sitemap->writeToFile(public_path('sitemap.xml'));

    return "Sitemap oluşturuldu ✅";
});
