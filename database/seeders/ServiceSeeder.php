<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'lang' => 'tr',
                'category_id' => 1,
                'name' => 'Enjeksiyon Hizmeti',
                'slug' => 'enjeksiyon-hizmeti',
                'content'=>'Enjeksiyon ',
                'price' => 5000,
                'image' => 'img/services/1.jpg',
                'is_featured' => 1,
                'status' => 1,
                'title' => 'Enjeksiyon Hizmeti',
                'keywords' => 'Enjeksiyon Hizmeti, Enjeksiyon Hizmeti Hizmeti, Enjeksiyon Hizmeti Fiyatı',
                'description' => 'Enjeksiyon Hizmeti için hizmet',
            ],
            [
                 'lang' => 'tr',
                'category_id' => 1,
                'name' => 'Serum Hizmeti',
                'slug' => 'serum-hizmeti',
                'content'=>'Serum ',
                'price' => 5000,
                'image' => 'img/services/1.jpg',
                'is_featured' => 1,
                'status' => 1,
                'title' => 'Serum Hizmeti',
                'keywords' => 'Serum Hizmeti, Serum Hizmeti Hizmeti, Serum Hizmeti Fiyatı',
                'description' => 'Serum Hizmeti için hizmet',
            ],
            [
                'lang' => 'tr',
                'category_id' => 1,
                'name' => 'Pansuman Hizmeti',
                'slug' => 'pansuman-hizmeti',
                'content'=>'Pansuman',
                'price' => 5000,
                'image' => 'img/services/1.jpg',
                'is_featured' => 1,
                'status' => 1,
                'title' => 'Pansuman Hizmeti',
                'keywords' => 'Pansuman Hizmeti, Pansuman Hizmeti Hizmeti, Pansuman Hizmeti Fiyatı',
                'description' => 'Pansuman  için hizmet',
            ],
            [
               'lang' => 'tr',
                'category_id' => 1,
                'name' => 'Damar Yolu Açma',
                'slug' => 'damar-yolu-açma',
                'content'=>'Damar Yolu Açma',
                'price' => 5000,
                'image' => 'img/services/1.jpg',
                'is_featured' => 1,
                'status' => 1,
                'title' => 'Damar Yolu Açma',
                'keywords' => 'Damar Yolu Açma Hizmeti, Damar Yolu Açma Hizmeti, Damar Yolu Açma Hizmeti Fiyatı',
                'description' => 'Damar Yolu Açma için hizmet',
            ],
              [
               'lang' => 'tr',
                'category_id' => 1,
                'name' => 'Evde Sağlık Hizmetleri',
                'slug' => 'evde-sağlık-hizmetleri',
                'content'=>"Evde takibi zorunlu özürlü, yaşlı, yatalak ve benzeri durumda olan hastalar
ile evde sağlık hizmeti alması gerektiği bu Yönerge’de belirtilen usul ve
esaslara göre tespit edilen kişilere yönelik birinci basamak koruyucu sağlık,
tanı, tedavi, rehabilitasyon ve danışmanlık hizmetleri, ilgili mevzuatı gereği
toplum sağlığı merkezi, aile sağlığı merkezi ve aile hekimleri vasıtası ile verilir",
                'price' => 5000,
                'image' => 'img/services/1.jpg',
                'is_featured' => 1,
                'status' => 1,
                'title' => 'Evde Sağlık Hizmetleri',
                'keywords' => 'Evde Sağlık Hizmeti, Evde muayane Hizmeti, Evde Sağlık Hizmeti Fiyatı',
                'description' => 'Evde Sağlık  için hizmet',
            ],

            [
             'lang' => 'tr',
                'category_id' => 1,
                'name' => 'Tansiyon Ölçümü',
                'slug' => 'tansiyon-ölçümü',
                'content'=>'Tansiyon Ölçümü ',
                'price' => 5000,
                'image' => 'img/services/1.jpg',
                'is_featured' => 1,
                'status' => 1,
                'title' => 'Tansiyon Ölçümü',
                'keywords' => 'Tansiyon Ölçümü, Tansiyon Ölçümü Hizmeti, Tansiyon Ölçümü Fiyatı',
                'description' => 'Tansiyon Ölçümü için hizmet',
            ],
                [
             'lang' => 'tr',
                'category_id' => 1,
                'name' => 'Sonda Takma',
                'slug' => 'sonda-takma',
                'content'=>'Sonda Takma ',
                'price' => 5000,
                'image' => 'img/services/1.jpg',
                'is_featured' => 1,
                'status' => 1,
                'title' => 'Sonda Takma',
                'keywords' => 'Sonda Takma, Sonda Takma Hizmeti, Sonda Takma Fiyatı',
                'description' => 'Sonda Takma için hizmet',
            ],
                   [
             'lang' => 'tr',
                'category_id' => 1,
                'name' => 'Multi Vitamin',
                'slug' => 'multi-vitamin',
                'content'=>'Multi Vitamin ',
                'price' => 5000,
                'image' => 'img/services/1.jpg',
                'is_featured' => 1,
                'status' => 1,
                'title' => 'Multi Vitamin',
                'keywords' => 'Multi Vitamin, Multi Vitamin Hizmeti,Multi Vitamin Fiyatı',
                'description' => 'Multi Vitamin için hizmet',
            ],
                [
             'lang' => 'tr',
                'category_id' => 1,
                'name' => 'Kulak Yıkama',
                'slug' => 'kulak-yıkama',
                'content'=>'Kulak Yıkama ',
                'price' => 5000,
                'image' => 'img/services/1.jpg',
                'is_featured' => 1,
                'status' => 1,
                'title' => 'Kulak Yıkama',
                'keywords' => 'Kulak Yıkama, Kulak Yıkama Hizmeti,Kulak Yıkama Fiyatı',
                'description' => 'Kulak Yıkama için hizmet',
            ],
             [
             'lang' => 'tr',
                'category_id' => 1,
                'name' => 'Dikiş',
                'slug' => 'dikiş',
                'content'=>'Dikiş',
                'price' => 5000,
                'image' => 'img/services/1.jpg',
                'is_featured' => 1,
                'status' => 1,
                'title' => 'Dikiş',
                'keywords' => 'Dikiş, Dikiş Hizmeti,Kulak Dikiş Fiyatı',
                'description' => 'Dikiş  için hizmet',
            ],
             [
             'lang' => 'tr',
                'category_id' => 1,
                'name' => 'Şeker Ölçümü',
                'slug' => 'şeker-ölçümü',
                'content'=>'Şeker Ölçümü',
                'price' => 5000,
                'image' => 'img/services/1.jpg',
                'is_featured' => 1,
                'status' => 1,
                'title' => 'Şeker Ölçümü',
                'keywords' => 'Şeker Ölçümü, Şeker Ölçümü,Kulak Dikiş Fiyatı',
                'description' => 'Şeker Ölçümü  için hizmet',
            ],



        ];

        foreach ($services as $service) {
            Service::create($service);
        }


    }
}
