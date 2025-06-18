<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
Schema::create('blog_posts', function (Blueprint $table) {
$table->id();
$table->string('title');
$table->string('slug')->unique();
$table->text('content');
$table->unsignedBigInteger('author_id');
$table->enum('status', ['draft', 'published', 'archived'])->default('draft');
$table->timestamps();
$table->softDeletes();

// Foreign key constraint
$table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
});
}

public function down(): void
{
Schema::dropIfExists('blog_posts');
}
};