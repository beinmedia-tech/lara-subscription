<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('subscription.tables.plan_features'), function (Blueprint $table) {
            // Columns
            $table->id();
            $table->foreignId('plan_id')->constrained(config('subscription.tables.plans'));
            $table->string('slug');
            $table->json('name');
            $table->json('description')->nullable();
            $table->string('value');
            $table->smallInteger('resettable_period')->unsigned()->default(0);
            $table->string('resettable_interval')->default('month');
            $table->mediumInteger('sort_order')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->unique(['plan_id', 'slug']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(config('subscription.tables.plan_features'));
    }
}
