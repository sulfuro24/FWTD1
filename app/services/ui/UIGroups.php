<?php
namespace services\ui;

 use Ubiquity\controllers\Controller;
 use Ubiquity\utils\http\URequest;

 /**
  * Class UIGroups
  */
class UIGroups extends Ajax\php\ubiquity\UIService{
    private $semantic;

    public function __construct(Controller $controller)
    {
        parent::__construct($controller);
        if (!URequest::isAjax()) {
            $this->jquery->getHref('a[data-target]', '', ['hasLoader' => 'internal', 'historize' => false, 'listenerOn' => 'body']);

        }
    }
    public function listGroups(array $groups){
        $this->semantic->dataTable();
    }
}
