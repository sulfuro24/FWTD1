<?php
namespace controllers;

 use models\User;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\controllers\auth\AuthController;
 use Ubiquity\orm\DAO;
 use Ubiquity\utils\flash\FlashMessage;
 use Ubiquity\utils\http\URequest;
 use Ubiquity\utils\http\UResponse;
 use Ubiquity\utils\http\USession;

 /**
 * Controller MyAuth
 **/
class MyAuth extends AuthController {
    #[Route(path:'/login',name:'login')]
	public function index(){
        $this->loadView("MyAuth/index.html");
    }
    public function onConnect($connected){
        $urlParts=$this->getOriginalURL();
        USession::set($this->_getUserSessionKey(), $connected);
        if(isset($urlParts)){
            Startup::forward(implode("/",$urlParts));
        }else{
            UResponse::header('location','/');
        }
    }
    public function _connect(){
        if(URequest::isPost()){
            $email=URequest::post($this->_getLoginInputName());
            if($email!=null) {
                $user = DAO::getOne(User::class, "email=?",false,[$email]);
                if(isset($user)){
                    USession::set('idOrga',$user->getOrganization());
                    return $user;
                }
            }
        }
        return;
    }

    public function _displayInfoAsString() {
        return true;
    }

    protected function finalizeAuth() {
        if(!URequest::isAjax()){
            $this->loadView('@activeTheme/main/vFooter.html');
        }
    }

    protected function initializeAuth() {
        if(!URequest::isAjax()){
            $this->loadView('@activeTheme/main/vHeader.html');
        }
    }

    protected function noAccessMessage(FlashMessage $fMessage)
    {
        $fMessage->setTitle('Accès interdit');
        $fMessage->setContent("Vous n'êtes pas autorisé à accéder à cette requête");
    }

    protected function terminateMessage(FlashMessage $fMessage)
    {

    }


    public function _getBodySelector() {
        return '#page-container';
    }

    public function _isValidUser($action = null)
    {
        // TODO: Implement _isValidUser() method.
    }
}
