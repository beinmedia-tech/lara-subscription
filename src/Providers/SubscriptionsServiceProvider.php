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
        $this->mergeConfigFrom(realpath(__DIR__.'/../../config/config.php'), 'beinmedia.subscriptions');

        // Bind eloquent models to IoC container
        $this->registerModels([
            'beinmedia.subscriptions.plan' => Plan::class,
            'beinmedia.subscriptions.plan_feature' => PlanFeature::class,
            'beinmedia.subscriptions.plan_subscription' => PlanSubscription::class,
            'beinmedia.subscriptions.plan_subscription_usage' => PlanSubscriptionUsage::class,
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
        // Publish Resources
        $this->publishesConfig('beinmedia/lara-subscription');
        $this->publishesMigrations('beinmedia/lara-subscription');
        ! $this->autoloadMigrations('beinmedia/lara-subscription') || $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }
}
