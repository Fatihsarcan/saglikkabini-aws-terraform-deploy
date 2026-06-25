<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
           About::create([
           'lang' => 'tr',
            'name' => 'Pirireis Sağlık Kabini ',
            'content' => 'Mersin’de hizmet veren bir sağlık kabini olarak, alanında uzman ve deneyimli ekibimizle, sizlere en kaliteli sağlık hizmetini sunmak için buradayız.',
            'vision' => 'Profesyonel yaklaşımımız, güler yüzlü hizmet anlayışımız ve hasta odaklı çözümlerimizle, sağlığınızı güvenle bize emanet edebilirsiniz.',
            'mission' => 'Bize her zaman telefonla ulaşabilir, ihtiyaç duyduğunuz her an yanınızda olduğumuzu hissedebilirsiniz.',
            'image' => 'img/berber1.jpg'
        ]);

        About::create([
           'lang' => 'en',
            'name' => 'Pirireis Sağlık Kabini ',
            'content' => 'Mersin’de hizmet veren bir sağlık kabini olarak, alanında uzman ve deneyimli ekibimizle, sizlere en kaliteli sağlık hizmetini sunmak için buradayız.',
            'vision' => 'Profesyonel yaklaşımımız, güler yüzlü hizmet anlayışımız ve hasta odaklı çözümlerimizle, sağlığınızı güvenle bize emanet edebilirsiniz.',
            'mission' => 'Bize her zaman telefonla ulaşabilir, ihtiyaç duyduğunuz her an yanınızda olduğumuzu hissedebilirsiniz.',
            'image' => 'img/berber1.jpg'
        ]);
    }
}
