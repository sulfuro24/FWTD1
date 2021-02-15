<?php
namespace controllers;

 use http\Client\Curl\User;
 use models\Groupe;
 use models\Organization;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\orm\DAO;
 use Ubiquity\orm\repositories\ViewRepository;
 use Ubiquity\utils\http\URequest;


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
	#[Route()]
    public function getOrga($name,$aliases){
        $orga=DAO::getOne(Organization::class,"name=? and aliases=? ",parameters: [$name,$aliases]);
    }
    public function testInsert(){
        $groupe= new Groupe();
        URequest::setValuesToObject($groupe);
        $idOrga=URequest::post('idOrga');
        $orga=DAO::getById(Organization::class,$idOrga);
        $groupe->setOrganization($orga);
        DAO::insert($orga);
    }
    public function testUpdate(){
        $groupe=DAO::getById(Groupe::class,URequest::post('idGroup'));
        URequest::setValuesToObject($groupe);
        $idOrga=URequest::post('idOrga');
        $orga=DAO::getById(Organization::class,$idOrga);
        $groupe->setOrganization($orga);
        $idUser=explode('.',URequest::post('idUser'));
        $users=DAO::getAllByIds(User::class,$idUser);
        foreach ($users as $user){
            $groupe->addUser($user);
        }
        DAO::update($orga,true);
    }

}
