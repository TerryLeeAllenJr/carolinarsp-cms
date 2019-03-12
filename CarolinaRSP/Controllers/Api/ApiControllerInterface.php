<?php
/**
 * CarolinaRSP\Controllers\Api\ApiControllerInterface.php
 */
namespace CarolinaRSP\Controllers\Api;

use League\Fractal\TransformerAbstract;

interface ApiControllerInterface
{

    public function __construct(TransformerAbstract $transformer);

    public function get() : array;

}
