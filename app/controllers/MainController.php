<?php
namespace controllers;
 use models\Basket;
 use models\Order;
 use models\Product;
 use models\Section;
 use Ubiquity\controllers\admin\popo\Route;
 use Ubiquity\controllers\auth\AuthController;
 use Ubiquity\controllers\auth\WithAuthTrait;
 use Ubiquity\core\postinstall\Display;
 use Ubiquity\orm\DAO;

 /**
  * Controller MainController
  */
class MainController extends ControllerBase{
    use WithAuthTrait;

    #[Route(path : "_default")]
	public function index(){
        $user=$this->getAuthController()->_getActiveUser();
        $nbcommande=DAO::count(Order::class,"iduser=?",[$user->getId()]);
        $nbPanier =DAO::count(Basket::class,"iduser=?",[$user->getId()]);
        $sections=DAO::getAll(Section::class);
        $prodReds=DAO::getAll(Product::class,"promotion!=0.00");
        $this->loadDefaultView(compact("user","nbcommande","sections","nbPanier","prodReds"));
	}

    protected function getAuthController(): AuthController
    {
        return new Login($this);
    }
    #[Route(path: "section/{idSection}")]
    public function detailSection($idSection){
        $this->loadView();
    }
   /* public function getPrixPanier($user){
        $list=DAO::getAll(Product::class,"iduser=? and ",[$user->getId()]);
        foreach ($p : $list){

        }
    }*/
}
