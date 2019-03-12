<?php
/**
 * CarolinaRSP\Controllers\Api\PageContentController
 */
namespace CarolinaRSP\Controllers\Api;

use Craft;
use craft\elements\Entry;

use CarolinaRSP\Utilities\Env;

use League\Fractal\TransformerAbstract;

/**
 * Class RecentWorkController
 *
 * Provides logic for the Page Content API endpoints.
 *
 * @package CarolinaRSP\Controllers\Api\RecentWorkController
 */
class RecentWorkController extends AbstractApiController implements ApiControllerInterface
{

    // Tells the route file which API version to use.

    const API_VERSION = 'api/v1/';
    const ENDPOINT = 'recentWork';

    /**
     * RecentWorkController constructor.
     * @param TransformerAbstract $transformer
     */
    public function __construct(TransformerAbstract $transformer)
    {
        parent::__construct($transformer,self::API_VERSION);
    }

    /**
     * @return array
     */
    public function get() : array
    {
        return $this->getEntries('recentWork');
    }

}
