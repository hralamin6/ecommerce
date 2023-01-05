<?php

    namespace Database\Seeders;

    use App\Models\Districts;
    use App\Models\SubDistricts;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\File;

    class DistrictSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {

            $district = File::get('database/district.json');
            $data = json_decode($district);
            foreach ($data as $value) Districts::create(['name' => $value->name, 'status' => 0 ]);
            $subdistrict = File::get('database/subdistrict.json');
            $data = json_decode($subdistrict);
            foreach ($data as $value) SubDistricts::create(['name' => $value->name, 'status' => 0, 'district_id'=> $value->district_id ]);


        }
    }
