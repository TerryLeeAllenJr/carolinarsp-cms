<?php
/**
 * CarolinaRSP\Transformers\TestimonialsTransformer.php
 */
namespace CarolinaRSP\Transformers;

use craft\elements\Entry;

/**
 * Class ServicesTransformer
 * @package CarolinaRSP\Transformers
 */
class TestimonialsTransformer extends AbstractTransformer
{
    /**
     * @param Entry $entry
     * @return array
     */
    public function transform(Entry $entry)
    {
        return [
            'title' => $entry->title,
            'fullName' => $entry->submittingFullName,
            'position' => $entry->submittingPosition,
            'testimpnial' => $entry->testimonial,
            'slug' => $entry->slug,
            'published' => $entry->enabledForSite,
            'postDate' => $entry->postDate,
            'expiryDate' => $entry->expiryDate
        ];

    }

}
