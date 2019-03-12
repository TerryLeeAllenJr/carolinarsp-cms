<?php
/**
 * CarolinaRSP\Traits\SortByEntryType
 */
namespace CarolinaRSP\Traits;

use yii\base\Event;
use craft\base\Element;
use craft\events\RegisterElementSortOptionsEvent;
use craft\elements\db\ElementQuery;
use craft\elements\db\EntryQuery;
use craft\events\CancelableEvent;

/**
 * Trait SortByEntryType
 *
 * Provides a hacky solution to enable sorting by entry type.
 * @package CarolinaRSP\Traits
 */
trait SortByEntryType
{
    /**
     * hackSortByEntryType
     *
     * Hooks into Element::EVENT_REGISTER_SORT_OPTIONS and ElementQuery::EVENT_BEFORE_PREPARE to update the query
     * and allow sorting by Entry Type.
     */
    private function enableSortByEntryType()
    {

        Event::on(
            Element::class,
            Element::EVENT_REGISTER_SORT_OPTIONS,
            function(RegisterElementSortOptionsEvent $event) {
                $event->sortOptions['entries.typeId'] = 'Entry Type';
            }
        );

        Event::on(
            ElementQuery::class,
            ElementQuery::EVENT_BEFORE_PREPARE,
            function(CancelableEvent $event) {
                $query = $event->sender; // instance of the query
                if ($query instanceof EntryQuery) { // only do it on entry queries
                    if (isset($query->orderBy['entries.typeId'])) { // also only if the user is trying to order by the types
                        $direction = $query->orderBy['entries.typeId']; // grab the direction input from the user
                        unset($query->orderBy['entries.typeId']); // remove the initial order by
                        $query->join[] = ['LEFT JOIN', '{{%entrytypes}} entrytypes', '[[entries.typeId]] = [[entrytypes.id]]']; // join in the entry types table
                        $query->orderBy['entrytypes.name'] = $direction; // asign direction
                    }
                }
            }
        );
    }
}
