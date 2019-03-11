<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;
use craft\elements\GlobalSet;

return [
    'endpoints' => [

        "api/globals/<handle:{handle}>" => function ($handle) {
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

        "api/services" => [
            'elementsPerPage' => Craft::$app->request->getQueryParam('limit', 100),
            'elementType' => Entry::class,
            'criteria' => [
                'section' => 'services',
            ],
            'transformer' => function (Entry $entry) use ($v1) {

                return [
                    'id' => $entry->id,
                    'slug' => $entry->slug,
                    //'featured' => $isFeaturedArticle,
                    'title' => $entry->title,
                    //'apiEndpoint' => UrlHelper::url("{$v1}articles/{$entry->slug}"),
                    'pubDate' => $entry->postDate,



                ];
            },
        ],

        "api/services/<slug:{slug}>" => function ($slug) {
            return [
                'elementType' => Entry::class,
                'one' => true,
                'criteria' => [
                    'section' => 'services',
                    'slug' => $slug
                ],
                'transformer' => function(Entry $entry) {
                    return [
                        'title' => $entry->title,
                        'featuredImage' => extractImageData($entry->featuredImage->all()),
                        'content' => $entry->text,
                    ];
                },
            ];
        },


    ]
];

function extractImageData($images) : array
{
    $parsed = [];
    foreach($images AS $image) {
        $parsed[] = (object) [
            'url' => $image->url,
            'focalPoint' => $image->focalPoint,
            'width' => $image->width,
            'height' => $image->height,
            'mimeType' => $image->mimeType,
            'title' => $image->title
        ];
    }

    return $parsed;
}
