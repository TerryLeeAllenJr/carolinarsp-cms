<?php
/**
 * CarolinaRSP\Transformers\ServicesTransformer.php
 */
namespace CarolinaRSP\Transformers;

use craft\elements\Entry;

/**
 * Class ServicesTransformer
 * @package CarolinaRSP\Transformers
 */
class ServicesTransformer extends AbstractTransformer
{
    /**
     * @param Entry $entry
     * @return array
     */
    public function transform(Entry $entry)
    {
        return [
            'title' => $entry->title,
            'text' => $entry->text,
            'featuredImage' => $this->getImage($entry,'featuredImage'),
            'slug' => $entry->slug,
            'published' => $entry->enabledForSite,
            'postDate' => $entry->postDate,
            'expiryDate' => $entry->expiryDate
        ];

    }

}
