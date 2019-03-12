<?php
/**
 * CarolinaRSP\Controllers\Api\TestimonialsController
 */
namespace CarolinaRSP\Controllers\Api;

use Craft;
use craft\elements\Entry;
use League\Fractal\TransformerAbstract;
use CarolinaRSP\Utilities\Env;

/**
 * Class RecentWorkController
 *
 * Provides logic for the Page Content API endpoints.
 *
 * @package CarolinaRSP\Controllers\Api\RecentWorkController
 */
class TestimonialsController extends AbstractApiController implements ApiControllerInterface
{

    // Tells the route file which API version to use.

    const API_VERSION = 'api/v1/';
    const ENDPOINT = 'testimonials';

    /**
     * TestimonialsController constructor.
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
        return $this->getEntries('testimonials');
    }

}
