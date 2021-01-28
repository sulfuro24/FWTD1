<?php
namespace controllers;
use Ubiquity\attributes\items\router\Get;
use Ubiquity\attributes\items\router\Post;
use Ubiquity\utils\http\URequest;
use Ubiquity\utils\http\USession;

/**
  * Controller TodosController
  */
class TodosController extends ControllerBase{

    const CACHE_KEY = 'datas/lists/';
    const EMPTY_LIST_ID='not saved';
    const LIST_SESSION_KEY='list';
    const ACTIVE_LIST_SESSION_KEY='active-list';

    public function initialize()
    {

        parent::initialize(); // TODO: Change the autogenerated stub
        $this->menu();
    }

    public function index()
    {
        if (USession::exists(self::LIST_SESSION_KEY)) {
            $list = USession::get(self::LIST_SESSION_KEY);
            $this->displayList($list);
        }
        $this->showMessage('Bienvenue','Todolist permet de gérer des liste...','info','info circle',[['url'=>Router::path('todos.new'),'caption'=>'Créer une nouvelle liste','style'=>'basic inverted']]);
	}

	#[Post(path: "todos/add",name:"todos.add")]
	public function addElement(){
		$list=USession::get(self::LIST_SESSION_KEY);
		if(URequest::has('elements')){
		    $elements=explode("\n",URequest::post('elements'));
		    foreach($elements as $elm){
		        $list[]=$elm;
            }
        }else{
            $list[]=URequest::post('element');
        }
		USession::set(self::LIST_SESSION_KEY);
		$this->displayList($list);
	}


	#[Get(path: "todos/delete/(.+?)/",name:"todos.delete")]
	public function deleteElement($index){
		
	}


	#[Post(path: "todos/edit/(.+?)/",name:"todos.edit")]
	public function editElement($index){
		
	}


	#[Get(path: "todos/loadList/(.+?)/",name:"todos.loadList")]
	public function loadList($uniqid){
		
	}


	#[Get(path: "todos/new/{force}",name:"todos.new")]
	public function newlist($force=fasle){
		USession::set(self::LIST_SESSION_KEY);
		$this.$this->displayList([]);
	}


	#[Get(path: "todos/saveListe/",name:"todos.save")]
	public function saveList(){
		
	}


	#[Post(path: "todos/loadListe/",name:"todos.loadListPost")]
	public function loadListFromForm(){
		
	}

    private function menu(){
        $this->loadView("TodosController/menu.html");
    }

    private function displayList($list){
        $this->loadView("TodosController/displayList.html",['list'=>$list]);
    }

    private function showMessage(string $header, string $message, string $type = '', string $icon = 'info circle',array $buttons=[]) {
        $this->loadView('main/message.html', compact('header', 'type', 'icon', 'message','buttons'));
    }
}
