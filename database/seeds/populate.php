<?php

use Illuminate\Database\Seeder;

class populate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



      $usersData = [
        [
          'name' => 'teen1',
          'email' => 'teen1@mail.com',
          'password' => Hash::make('123456'),
          'type' => 'teen',
        ],
        [
          'name' => 'teen2',
          'email' => 'teen2@mail.com',
          'password' => Hash::make('123456'),
          'type' => 'teen',
        ],
        [
          'name' => 'teen3',
          'email' => 'teen3@mail.com',
          'password' => Hash::make('123456'),
          'type' => 'teen',
        ],
        [
          'name' => 'teen4',
          'email' => 'teen4@mail.com',
          'password' => Hash::make('123456'),
          'type' => 'teen',
        ],
      ];
      $leader = App\User::get()->first();
      foreach ($usersData as $data) {
        $user = App\User::create($data);
        App\leader_teen::create([
          'leader' => $leader->id,
          'teen' => $user->id
        ]);
        $activities = App\activity::get();
        foreach ($activities as $activity) {
          App\user_activity::create([
                'value' => $activity->type == App\activity::TYPE[0]?rand(0,1):rand(0,3),
                'user' => $user->id,
                'activity' => $activity->id
          ]);
        }
      }
    }
}
