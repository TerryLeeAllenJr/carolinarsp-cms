<?php
/**
 * CarolinaRSP\Controllers\Api\ServicesController
 */
namespace CarolinaRSP\Controllers\Api;

use CarolinaRSP\Transformers\RecentWorkTransformer;
use Craft;
use craft\elements\Entry;

use CarolinaRSP\Utilities\Env;
use League\Fractal\TransformerAbstract;

/**
 * Class ServicesController
 *
 * Provides logic for the Page Content API endpoints.
 *
 * @package CarolinaRSP\Controllers\Api\RecentWorkController
 */
class ServicesController extends AbstractApiController implements ApiControllerInterface
{

    // Tells the route file which API version to use.

    const API_VERSION = 'api/v1/';
    const ENDPOINT = 'services';



    /**
     * ServicesController constructor.
     * @param TransformerAbstract $transformer
     */
    public function __construct(TransformerAbstract $transformer)
    {
        parent::__construct($transformer, self::API_VERSION);
    }

    /**
     * @return array
     */
    public function get() : array
    {
        return $this->getEntries('services');
    }


}
