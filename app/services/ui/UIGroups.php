<?php
namespace services\ui;
use Ajax\php\ubiquity\UIService;
use Ajax\semantic\html\collections\form\HtmlForm;
use Ajax\semantic\widgets\dataform\DataForm;
use Ajax\service\JArray;


use models\User;
use Ubiquity\controllers\Controller;
use Ubiquity\controllers\Router;
use Ubiquity\utils\http\URequest;

 /**
  * Class UIGroups
  */
class UIStore extends UIService{
    public function __construct(Controller $controller) {
        parent::__construct($controller);
        if(!URequest::isAjax()) {
            $this->jquery->getHref('a[data-target]', '', ['hasLoader' => 'internal', 'historize' => false,'listenerOn'=>'body']);
        }
    }
}
