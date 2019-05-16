<?php
class ProjectDAO{
    private $pdo;
    public function __construct(){
        $this->pdo = ConnectionManager::getConnection();
    }

    public function check_name(Developer $developer,Project $project){
        $req = $this->pdo->prepare( "SELECT P.id FROM projects P INNER JOIN developers D ON P.dev_id = D.id WHERE LOWER(P.name) = :name AND D.id = 'dev_id'");
        $req->execute(array('name' => strtolower($project->getName()), 'dev_id' => $developer->getId()()));
        $res = $req->fetch();
        return $res['id'];
    }

    public function add(Project $project){
        $req = $this->pdo->prepare("INSERT INTO projects(dev_id,name,name,description,type,domain,key) VALUES(:user_id,:name,:descritpion,:website,:type,:domain,:key)");
        $req->execute(array('dev_id' => $project->getDevId(),'name' => $project->getName(),'description' => $project->getDescription(),'type' => $project->getType(),'domain' => $project->getDomain(),'key' => hash('sha512',$project->getKey(),true)));
        $last_id_req = $this->pdo->query('SELECT LAST_INSERT_ID() last_id');
        $last_id_req->execute();
        $response = $last_id_req->fetch();
        return $response['last_id'];
    }

    public function getProjectById($id){
        $req = $this->pdo->prepare("SELECT * FROM projects WHERE id = :id");
        $req->execute(array('id' => $id));
        $res = $req->fetch();
        return new Project($res['id'],$res['dev_id'],$res['name'],$res['description'],$res['type'],$res['domain'],$res['key'],$res['create_datetime']);
    }
}

?>