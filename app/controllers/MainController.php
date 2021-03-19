<?php
namespace controllers;
 use Ubiquity\controllers\admin\popo\Route;
 use Ubiquity\controllers\auth\AuthController;
 use Ubiquity\controllers\auth\WithAuthTrait;
 use Ubiquity\core\postinstall\Display;

 /**
  * Controller MainController
  */
class MainController extends ControllerBase{
    use WithAuthTrait;

    #[Route(path : "_default")]
	public function index(){
        $this->loadDefaultView();
	}

    protected function getAuthController(): AuthController
    {
        return new Login($this);
    }
}
