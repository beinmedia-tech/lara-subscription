<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanSubscriptionUsageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(config('subscription.tables.plan_subscription_usage'), function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->constrained(config('subscription.tables.plan_subscriptions'))
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('feature_id')->constrained(config('subscription.tables.plan_features'))
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->smallInteger('used')->unsigned();
            $table->dateTime('valid_until')->nullable();
            $table->string('timezone')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['subscription_id', 'feature_id']);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(config('subscription.tables.plan_subscription_usage'));
    }
}
