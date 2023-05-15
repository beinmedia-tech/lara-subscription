<?php

declare(strict_types=1);

namespace BeInMedia\LaraSubscription\Providers;

use BeInMedia\LaraSubscription\Models\Plan;
use Illuminate\Support\ServiceProvider;
use Rinvex\Support\Traits\ConsoleTools;
use BeInMedia\LaraSubscription\Models\PlanFeature;
use BeInMedia\LaraSubscription\Models\PlanSubscription;
use BeInMedia\LaraSubscription\Models\PlanSubscriptionUsage;
use BeInMedia\LaraSubscription\Console\Commands\MigrateCommand;
use BeInMedia\LaraSubscription\Console\Commands\PublishCommand;
use BeInMedia\LaraSubscription\Console\Commands\RollbackCommand;

class SubscriptionsServiceProvider extends ServiceProvider
{
    use ConsoleTools;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/config.php', 'subscriptions');

        // Bind eloquent models to IoC container
        $this->registerModels([
            'subscription.plan' => Plan::class,
            'subscription.plan_feature' => PlanFeature::class,
            'subscription.plan_subscription' => PlanSubscription::class,
            'subscription.plan_subscription_usage' => PlanSubscriptionUsage::class,
        ]);
        if ($this->app->runningInConsole()) {
            $this->commands([
                MigrateCommand::class,
                RollbackCommand::class,
            ]);
        }
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('subscription.php'),
            __DIR__.'/../../database/migrations' => base_path('database/migrations'),
        ]);
    }
}
