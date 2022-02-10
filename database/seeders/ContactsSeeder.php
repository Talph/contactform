<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $numberOfContacts = 6;
        $faker = Faker::create();
        $rand = random_int(1, 3);
        $array = array('male', 'female', 'other');

        $gender = array_rand($array, $rand);

        foreach ($gender as $key) {

            for ($i = 0; $i < $numberOfContacts; $i++) {
                Contact::create([
                    'name' => $faker->name($gender = 'male' | 'female'),
                    'email' => $faker->email(),
                    'gender' => $array[$key],
                    'content' => $faker->realText($maxNbChars = 80, $indexSize = 1)
                ]);
            }
        }
    }
}
