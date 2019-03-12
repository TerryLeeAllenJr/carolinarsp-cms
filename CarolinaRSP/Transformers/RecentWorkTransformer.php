<?php
/**
 * CarolinaRSP\Transformers\PageContentTransformer.php
 */
namespace CarolinaRSP\Transformers;

use League\Fractal\TransformerAbstract;
use craft\elements\Entry;

/**
 * Class PageContentTransformer
 * @package CarolinaRSP\Transformers
 */
class RecentWorkTransformer extends AbstractTransformer
{
    /**
     * @param Entry $entry
     * @return array
     */
    public function transform(Entry $entry)
    {
        return [
            'title' => $entry->title,
            'description' => $entry->recentWorkDescription,
            'workCompletedDatePretty' =>$entry->workCompletedDate->format('M Y'),
            'workCompletedDate' =>$entry->workCompletedDate,
            'featuredImage' => $this->getImage($entry,'recentWorkFeaturedImage'),
            'slug' => $entry->slug,
            'published' => $entry->enabledForSite,
            'postDate' => $entry->postDate,
            'expiryDate' => $entry->expiryDate
        ];

    }

}
