<?php
/**
 * CarolinaRSP\Transformers\PageContentTransformer.php
 */
namespace CarolinaRSP\Transformers;

use craft\elements\Entry;

/**
 * Class RecentWorkTransformer
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
            'workCompletedDate' =>$entry->workCompletedDate,
            'featuredImage' => $this->getImage($entry,'recentWorkFeaturedImage'),
            'slug' => $entry->slug,
            'published' => $entry->enabledForSite,
            'postDate' => $entry->postDate,
            'expiryDate' => $entry->expiryDate
        ];

    }

}
