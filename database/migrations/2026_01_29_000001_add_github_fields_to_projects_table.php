<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('github_owner')->nullable()->after('author_id');
            $table->string('github_repo')->nullable()->after('github_owner');
            $table->string('github_url')->nullable()->after('github_repo');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['github_owner', 'github_repo', 'github_url']);
        });
    }
};
