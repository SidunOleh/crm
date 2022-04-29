<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;use Illuminate\Database\Query\Expression;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('email')->unique();
            $table->string('password');

            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();

            $table->boolean('is_active')->default(true);
            $table->boolean('is_admin')->default(false);

            $table->json('permissions')->default(json_encode([
                'projects' => [
                    'create' => 0,
                    'read'   => 0,
                    'update' => 0,
                    'delete' => 0,
                ],
                'contacts' => [
                    'create' => 0,
                    'read'   => 0,
                    'update' => 0,
                    'delete' => 0,
                ],
                'tasks' => [
                    'create' => 0,
                    'read'   => 0,
                    'update' => 0,
                    'delete' => 0,
                ],
            ]));

            $table->foreignId('company_id')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->rememberToken();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
