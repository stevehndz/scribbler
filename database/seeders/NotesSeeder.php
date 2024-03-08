<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notes = [];

        for ($i = 0; $i < 100; $i++) {
            $n = [
                "title" => "Title " . $i,
                "description" => "Description " . $i,
                "user_id" => ($i % 12) + 1
            ];

            array_push($notes, $n);
        }

        DB::table('notes')->insert($notes);

    }
}
