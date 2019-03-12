<?php

namespace CarolinaRSP\Controllers\Api;

use Craft;
use craft\elements\Category;
use craft\elements\Entry;
use League\Fractal\TransformerAbstract;
use Carbon\Carbon;

use CarolinaRSP\Traits\SortByEntryType;
use CarolinaRSP\Utilities\Env;

/**
 * Class AbstractApiController
 * @package Camel\Controllers\Api
 */
class AbstractApiController
{

    // Provides the ability to sort by entry type.
    use SortByEntryType;

    protected $transformer = null;
    protected $apiVersion    = null;

    public function __construct(TransformerAbstract $transformer, string $apiVersion)
    {
        $this->enableSortByEntryType();
        $this->transformer = $transformer;
        $this->apiVersion = $apiVersion;
    }


    public function getEntries(string $section)
    {
        return [
            'elementsPerPage' => Craft::$app->request->getQueryParam('limit', 100),
            'elementType' => Entry::class,
            'criteria' => [
                'section' => $section,
                'orderBy' => 'postDate DESC',
                'enabledForSite' => true,
                'expiryDate' => [
                    'or',
                    ':empty:',
                    '> ' . $this->getDate($this->getParam('date'))
                ] ,
                'postDate' => [
                    'or',
                    ':empty:',
                    '<= ' . $this->getDate($this->getParam('date'))
                ],
                'status' => (Env::get('APP_DEBUG',false)) ? ['live','pending'] : 'live'
            ],
            'transformer' => $this->transformer,
        ];
    }

    /**
     * @return null|string
     */
    public function getApiVersion()
    {
        return ($this->apiVersion) ?? 'api/v1';
    }

    /**
     * AbstractApiController|getContentBySlug()
     *
     * Gets relevant content givem $slug.
     * @param string $slug
     * @param TransformerAbstract $transformer
     * @return array
     */
    public function getContentBySlug(string $slug) : array
    {
        return [
            'elementType' => Entry::class,
            'one' => true,
            'criteria' => [
                'slug' => $slug
            ],
            'transformer' => $this->transformer,
        ];
    }

    /**
     * AbstractApiController|getCategoryId()
     *
     * Returns a category id for use in queries.
     *
     * @param string $category
     * @param string $categoryGroup
     * @return array
     */
    protected function getCategoryId($category, $categoryGroup) : array
    {
        return [
            'targetElement' => Category::find()
                ->group($categoryGroup)
                ->slug($category)
                ->one()
                ->id
        ];
    }

    /**
     * AbstractApiController|getPages()
     *
     * Loops through the entry to get the list of assigned Page categories.
     * @param Entry $entry
     * @param string $categorySlug
     * @return array
     */
    protected function getPages(Entry $entry, string $categorySlug)
    {
        return array_map(
            function($cat) { return $cat->title; },
            $entry->{$categorySlug}->all()
        );
    }

    /**
     * AbstractApiController|getParam()
     *
     * Provides a pretty wrapper around $app->request->getQueryParam().
     *
     * @param string $param
     * @param null $default
     * @return string
     */
    protected function getParam(string $param, $default = null)
    {
        return Craft::$app->request->getQueryParam($param, $default);
    }

    /**
     * AbstractApiController|getDate()
     *
     * Returns a Carbon formatted date given $dateTime. Will return current date if none is given.
     * @param string|null $dateTime
     * @return string
     */
    protected function getDate(string $dateTime = null) : string
    {

        $carbon = ($dateTime && Env::get('APP_DEBUG',false) == 'true') ? new Carbon($dateTime) : new Carbon(date('Y-m-d H:i:s'));

        return $carbon->toDateTimeString();
    }

}
