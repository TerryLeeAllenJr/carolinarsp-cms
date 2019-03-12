<?php
/**
 * CarolinaRSP\Transformers\AbstractTransformer.php
 */
namespace CarolinaRSP\Transformers;

use League\Fractal\TransformerAbstract;
use craft\elements\Entry;
use Exception;

/**
 * Class Abstract
 * @package CarolinaRSP\Transformers
 */
class AbstractTransformer extends TransformerAbstract
{

    /**
     * @param Entry $entry
     * @param string $fieldName
     * @return array|null
     */
    protected function getImage(Entry $entry, string $fieldName)
    {
        try {
            $image = $entry->{$fieldName}->first();
            return [
                'url'           => $image->url,
                'title'         => $image->title,
                'width'         => $image->width,
                'height'        => $image->height,
                'mimeType'      => $image->mimeType,
                'extension'     => $image->extension,
                'focalPoint'    => $image->focalPoint,
                'hasFocalPoint' => $image->hasFocalPoint
            ];
        } catch(Exception $e) {
            return null;
        }
    }
}
