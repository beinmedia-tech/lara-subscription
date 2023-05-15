<?php

declare(strict_types=1);

return [

    // Manage autoload migrations
    'autoload_migrations' => true,

    // Subscriptions Database Tables
    'tables' => [

        'plans' => 'plans',
        'plan_features' => 'plan_features',
        'plan_subscriptions' => 'plan_subscriptions',
        'plan_subscription_usage' => 'plan_subscription_usage',

    ],

    // Subscriptions Models
    'models' => [

        'plan' => \BeInMedia\LaraSubscription\Models\Plan::class,
        'plan_feature' => \BeInMedia\LaraSubscription\Models\PlanFeature::class,
        'plan_subscription' => \BeInMedia\LaraSubscription\Models\PlanSubscription::class,
        'plan_subscription_usage' => \BeInMedia\LaraSubscription\Models\PlanSubscriptionUsage::class,

    ],

];
