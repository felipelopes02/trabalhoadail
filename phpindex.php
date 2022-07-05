<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $banco = new PDO('mysql:host=localhost:3306;dbname=myhelper',"root","");
    $sql = "select * from cadastro";
    if(array_key_exists("nome", $_REQUEST)
    && array_key_exists("email", $_REQUEST) ) {
        $sql.=" WHERE   ";
        $sql.="    nome like '%".$_REQUEST['nome']."%'  ";
        $sql.=" and email like '%".$_REQUEST['email']."%'     ";
    }else if(array_key_exists("nome",$_REQUEST)){
        $sql.=" WHERE   ";
        $sql.="    nome like '%".$_REQUEST['nome']."%'  ";
    }else if(array_key_exists("email",$_REQUEST)){
        $sql.=" WHERE   ";
        $sql.="    email like '%".$_REQUEST['email']."%'  ";
    }

    $resultado = $banco->query($sql);
    $objeto = $resultado->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($objeto);
}else if($_SERVER['REQUEST_METHOD'] == 'PUT'){
    $banco = new PDO('mysql:host=localhost:3306;dbname=myhelper',"root","");
    $json = file_get_contents('php://input');
    $objeto = json_decode($json);
    $sql = "INSERT INTO cadastro
    (nome,email) 
    VALUES (?,?)";
    $comando = $banco->prepare($sql);
    $comando->execute([
        $objeto->nome,
        $objeto->email,
    ]);
}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $banco = new PDO('mysql:host=localhost:3306;dbname=myhelper',"root","");
    $json = file_get_contents('php://input');
    $objeto = json_decode($json);
    $dados = array();
    $sql = "UPDATE cadastro SET nome = ?, email = ? WHERE codigo = ? ";
    array_push($dados,$objeto->nome);
    array_push($dados,$objeto->email);
    array_push($dados,$objeto->codigo);
    $comando = $banco->prepare($sql);
    $comando->execute($dados);

}else if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    $banco = new PDO('mysql:host=localhost:3306;dbname=myhelper',"root","");
    $json = file_get_contents('php://input');
    $objeto = json_decode($json);
    $sql = "DELETE FROM cadastro WHERE codigo = ?";
    $comando = $banco->prepare($sql);
    $comando->execute([$objeto->codigo]);
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $banco = new PDO('mysql:host=localhost:3306;dbname=myhelper',"root","");
    $sql = "select * from academico";
    if(array_key_exists("nome", $_REQUEST)
    && array_key_exists("turma", $_REQUEST) ) {
        $sql.=" WHERE   ";
        $sql.="    nome like '%".$_REQUEST['nome']."%'  ";
        $sql.=" and turma like '%".$_REQUEST['turma']."%'     ";
    }else if(array_key_exists("nome",$_REQUEST)){
        $sql.=" WHERE   ";
        $sql.="    nome like '%".$_REQUEST['nome']."%'  ";
    }else if(array_key_exists("turma",$_REQUEST)){
        $sql.=" WHERE   ";
        $sql.="    turma like '%".$_REQUEST['turma']."%'  ";
    }

    $resultado = $banco->query($sql);
    $objeto = $resultado->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($objeto);
}else if($_SERVER['REQUEST_METHOD'] == 'PUT'){
    $banco = new PDO('mysql:host=localhost:3306;dbname=myhelper',"root","");
    $json = file_get_contents('php://input');
    $objeto = json_decode($json);
    $sql = "INSERT INTO academico
    (nome,turma,nota) 
    VALUES (?,?,?)";
    $comando = $banco->prepare($sql);
    $comando->execute([
        $objeto->nome,
        $objeto->turma,
        $objeto->nota
    ]);
}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $banco = new PDO('mysql:host=localhost:3306;dbname=myhelper',"root","");
    $json = file_get_contents('php://input');
    $objeto = json_decode($json);
    $dados = array();
    $sql = "UPDATE academico SET nome = ?, turma = ?, nota = ? WHERE codigo = ? ";
    array_push($dados,$objeto->nome);
    array_push($dados,$objeto->turma);
    array_push($dados,$objeto->nota);
    array_push($dados,$objeto->codigo);
    $comando = $banco->prepare($sql);
    $comando->execute($dados);
}else if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    $banco = new PDO('mysql:host=localhost:3306;dbname=myhelper',"root","");
    $json = file_get_contents('php://input');
    $objeto = json_decode($json);
    $sql = "DELETE FROM academico WHERE codigo = ?";
    $comando = $banco->prepare($sql);
    $comando->execute([$objeto->codigo]);
}

?>