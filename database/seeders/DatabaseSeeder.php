<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\User;
use App\Models\Project;
use App\Models\Contact;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $company = Company::factory()->create();

        $users = User::factory(5)
            ->sequence(function ($sequence) {
                if ($sequence->index == 0) {                  
                    return [
                        'is_admin'    => 1,
                        'permissions' => [
                            'projects' => [
                                'create' => 1,
                                'read'   => 2,
                                'update' => 2,
                                'delete' => 2,
                            ],
                            'contacts' => [
                                'create' => 1,
                                'read'   => 2,
                                'update' => 2,
                                'delete' => 2,
                            ],
                            'tasks' => [
                                'create' => 1,
                                'read'   => 2,
                                'update' => 2,
                                'delete' => 2,
                            ],
                        ],
                    ];              
                } else {
                    return [];
                }          
            })
            ->create([
                'company_id' => $company->id,
        ]);

        foreach ($users as $user) {
            Project::factory(5)->create([
                'user_id' => $user->id,
            ]);

            Contact::factory(5)->create([
                'user_id' => $user->id,
            ]);

            Task::factory(5)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
