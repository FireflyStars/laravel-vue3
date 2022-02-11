<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Subject;
use App\Models\UserSubject;

class UserSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);
        $subjects = Subject::all();
        foreach($subjects as $item){
            UserSubject::create(['user_id'=> $user->id, 'subject_id'=> $item->id]);
        }
    }
}
