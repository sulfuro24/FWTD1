<?php
namespace controllers;

 use models\Group;
 use models\User;
 use services\dao\OrgaRepository;
 use services\ui\UIGroups;
 use Ubiquity\attributes\items\di\Autowired;
 use Ubiquity\attributes\items\router\Route;
 use Ubiquity\controllers\auth\AuthController;
 use Ubiquity\controllers\auth\WithAuthTrait;
 use Ubiquity\orm\DAO;
 use Ubiquity\utils\http\USession;

 /**
 * Controller MainController
 **/
class MainController extends ControllerBase{
    use WithAuthTrait;
    public function initialize() {
        $this->ui=new UIGroups($this);
        parent::initialize();
    }
    #[Route(path: '_default',name: 'home')]
	public function index(){
        $this->jquery->getHref('a[data-ajax]',parameters: ['historize'=>false,'hasloader']);
        $this->jquery->renderView("MainController/index.html");
    }

protected function getAuthController(): AuthController
{
    return new MyAuth($this);
}
    #[Route(path: 1,name: "main.testAjax")]
    public function testAjax(){
        $user=DAO::getById(User::class,[1],false);
        $this->loadView('MainController/test/ajax.html',['user'=>$user]);
    }
    #[Route('user/details/{id}',name:'user.details')]
    public function userDetails($id){
        $user=DAO::getById(User::class,[$id],true);
        echo "Organisation : ".$user->getOrganization();
    }
    #[Autowired]
    private OrgaRepository $repo;

    public function setRepo(OrgaRepository $repo): void {
        $this->repo = $repo;
    }
    public function listGroups(){
        $idOrga=USession::get('idOrga');
        $groups=DAO::getAll(Group::class,'idOrganization= ?',false,[$idOrga]);
        $this->uiService->listGroups($groups);
    }
}
