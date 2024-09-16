<?php

use Illuminate\Database\Seeder;

class AttachmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $atach = array(
            [
                'type' => 'cover',
                'model' => 'audio',
                'model_id' => '0',
                'url' => 'pankord/no-img.jpg',
                'type_data' => '0',
                'user_id' => '0',
                'status' => '0',
                'storage' => 's3',
                'size' => '0',
            ]
        );
        DB::table('attachments')->insert($atach);
    }
}
