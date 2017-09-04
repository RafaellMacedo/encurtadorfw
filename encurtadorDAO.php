<?php

require_once 'bd.php';

class Encurtador extends Base {

    public function select() {
        $data = (object) $_POST;
        
        $db = $this->getDb();
        $stm = $db->prepare('SELECT * FROM encurtador');
        $stm->execute();
        $result = $stm->fetchAll( PDO::FETCH_ASSOC);
        
        echo json_encode(array(
          "data"   => $result,
          "succes" => true
        ));
    }
    
    public function insert(){
        $data = (object) $_POST;
        
        // $url = "https://www.youtube.com/watch?v=BjrGkBvfGsA";

        $db = $this->getDb();
        $stm = $db->prepare('INSERT INTO encurtador (url) VALUES (:url)');
        $stm->bindValue(':url', $data->url);
        $insert       = $stm->execute();
        $idencurtador = $db->lastInsertId();

        $url_encurtador = $idencurtador + 1;
        $url_encurtador = base_convert($url_encurtador, 10, 36);

        $stm = $db->prepare('UPDATE encurtador SET url_encurtador = :url_encurtador WHERE idencurtador = :idencurtador');
        $stm->bindValue(':url_encurtador', $url_encurtador);
        $stm->bindValue(':idencurtador',   $idencurtador);
        $insert = $stm->execute();
        
        echo json_encode(array(
          "success" => $insert,
          "data"    => $data
        ));
    }
}

$acao = $_POST["action"];

if($acao != ""){
    $encurtador = new Encurtador();
    $encurtador->$acao();
}
?>