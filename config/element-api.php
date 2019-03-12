


<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;
use craft\elements\GlobalSet;

use CarolinaRSP\Controllers\Api\RecentWorkController;
use CarolinaRSP\Controllers\Api\ServicesController;
use CarolinaRSP\Controllers\Api\TestimonialsController;

use CarolinaRSP\Transformers\RecentWorkTransformer;
use CarolinaRSP\Transformers\ServicesTransformer;
use CarolinaRSP\Transformers\TestimonialsTransformer;


if(Craft::$app->request->isConsoleRequest) {
    return [];
}

// Lets new up the controllers here. Gotta love some janky DI.
$controllers = (object) [
    'recentWorkController' =>  new RecentWorkController(new RecentWorkTransformer()),
    'servicesController'  => new ServicesController(new ServicesTransformer()),
    'testimonialsController' => new TestimonialsController(new TestimonialsTransformer()),
];


return [
    'endpoints' => [
        RecentWorkController::API_VERSION.RecentWorkController::ENDPOINT => $controllers->recentWorkController->get(),
        RecentWorkController::API_VERSION.RecentWorkController::ENDPOINT.'/<slug:{slug}>' => function($slug) use ($controllers) {
            return $controllers->recentWorkController->getContentBySlug($slug);},

        ServicesController::API_VERSION.ServicesController::ENDPOINT => $controllers->servicesController->get(),
        ServicesController::API_VERSION.ServicesController::ENDPOINT.'/<slug:{slug}>' => function($slug) use ($controllers) {
            return $controllers->servicesController->getContentBySlug($slug);},

        TestimonialsController::API_VERSION.TestimonialsController::ENDPOINT => $controllers->testimonialsController->get(),
        TestimonialsController::API_VERSION.TestimonialsController::ENDPOINT.'/<slug:{slug}>' => function($slug) use ($controllers) {
            return $controllers->testimonialsController->getContentBySlug($slug);},

        "api/v1/globals/<handle:{handle}>" => function ($handle) {
            return [
                'elementType' => GlobalSet::class,
                'one' => true,
                'criteria' => [
                    'handle' => $handle
                ],
                'transformer' => function(GlobalSet $globalSet) {
                    return $globalSet->fieldValues;
                },
            ];
        },
    ]
];

