<?php
namespace controllers;

 use http\Client\Curl\User;
 use models\Organization;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\orm\DAO;
 use Ubiquity\orm\repositories\ViewRepository;


 /**
 * Controller OrgaController
 **/
class OrgaController extends ControllerBase{

    public function initialize() {
        parent::initialize();
        $this->repo??=new ViewRepository($this,Organization::class);
    }
    #[Route('orga')]
	public function index(){
        $orga = DAO::getAll(Organization::class,"",true);
        $this->loadView('OrgaController/index.html',['orgas'=>$orga]);
    }


	#[Route(path: "/orga/{id}",name: "orga.getOne")]
	public function getOne($id){
        $orga=DAO::getById(Organization::class,$id,['users.groupes','groupes.users']);
        $this->loadDefaultView(['orga'=>$orga]);
	}

}
