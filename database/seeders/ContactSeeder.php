<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::create([
            "phone_number"=>"+201155225015",
            "country"=>"uae",
            "message_en"=>"Hello Mr Mohamed Adel, This is a demo message from UAE....",
            "message_ar"=>"مرحباً السيد محمد عادل، هذه رسالة توضيحية من الإمارات العربية المتحدة....",
        ]);
        Contact::create([
            "phone_number"=>"+201155225015",
            "country"=>"sa",
            "message_en"=>"Hello Mr Mohamed Adel, This is a demo message from Saudi Arabia....",
            "message_ar"=>"مرحباً بالسيد محمد عادل، هذه رسالة توضيحية من المملكة العربية السعودية....",

        ]);
    }
}
