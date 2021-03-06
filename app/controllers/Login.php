<?php
namespace controllers;
use models\User;
use Ubiquity\controllers\auth\AuthController;
use Ubiquity\controllers\Startup;
use Ubiquity\orm\DAO;
use Ubiquity\utils\http\USession;
use Ubiquity\utils\http\URequest;
use controllers\auth\files\LoginFiles;
use Ubiquity\controllers\auth\AuthFiles;


class Login extends AuthController{

	protected function onConnect($connected) {
		$urlParts=$this->getOriginalURL();
		USession::set($this->_getUserSessionKey(), $connected);
		if(isset($urlParts)){
			$this->_forward(implode("/",$urlParts));
		}else{
            Startup::forward("");
		}
	}

	protected function _connect() {
        if(URequest::isPost()){
            $email=URequest::post($this->_getLoginInputName());
            $password=URequest::post($this->_getPasswordInputName());
            return DAO::uGetOne(User::class, "email=? and password= ?",false,[$email,$password]);
        }
        return null;
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Ubiquity\controllers\auth\AuthController::isValidUser()
	 */
	public function _isValidUser($action=null) {
		return USession::exists($this->_getUserSessionKey());
	}

	public function _getBaseRoute() {
		return 'Login';
	}
	
	protected function getFiles(): AuthFiles{
		return new LoginFiles();
	}

    public function _getLoginInputName(){
        return "email";
    }

    protected function finalizeAuth() {
        if(!URequest::isAjax() && Startup::getAction()!=='direct'){
            $this->loadView('@activeTheme/main/vFooter.html');
        }
    }

    protected function initializeAuth() {
        if(!URequest::isAjax() && Startup::getAction()!=='direct'){
            $this->loadView('@activeTheme/main/vHeader.html');
        }
    }

}
