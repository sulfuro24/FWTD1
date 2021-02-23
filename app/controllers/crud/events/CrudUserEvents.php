<?php
namespace controllers\crud\events;

use Ubiquity\controllers\crud\CRUDEvents;
 /**
  * Class CrudUserEvents
  */
class CrudUserEvents extends CRUDEvents{
    public function onBeforeUpdateRequest(array &$requestValues, bool $isNew)
    {
        parent::onBeforeUpdateRequest($requestValues, $isNew);
    }

    public function onBeforeUpdate(object $instance, bool $isNew)
    {
        parent::onBeforeUpdate($instance, $isNew);
    }


}
