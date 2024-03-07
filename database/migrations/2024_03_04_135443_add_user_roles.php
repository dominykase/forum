<?php

use App\Modules\Users\Enums\RoleEnum;
use App\Modules\Users\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Role::query()->insert([
            ['name' => RoleEnum::USER, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => RoleEnum::MODERATOR, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => RoleEnum::ADMIN, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedSmallInteger('role')->default(1);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        Schema::dropIfExists('roles');
    }
};
