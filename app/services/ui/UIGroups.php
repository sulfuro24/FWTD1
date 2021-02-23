<?php
namespace services\ui;

 use Ubiquity\controllers\Controller;
 use Ubiquity\utils\http\URequest;

 /**
  * Class UIGroups
  * @property
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
        $dt=$this->semantic->dataTable('dt-groups',Group::class,$groups);
        $dt->setFields(['name','email']);
        $dt->fieldAsLabel('email','mail');
        $dt->addDeleteButton();
    }
    public function orgaForm(\model\Organization $orga){
        $frm=$this->semantic->dataForm('frmOrga',$orga);
        $frm->setFields(['id','name','domain','submit']);
        $frm->FieldsAsHidden(['id']);
        $frm->FieldAsLabeledInput('name',['rules'=>'empty']);
        $frm->fieldAsLabeledInput('domain',['rules'=>['empty','email']]);
        $frm->SetValidationParams(["on"=>"blur","inline"=>true]);
    }


}
