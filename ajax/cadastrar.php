<?php
include "db.php";
$erro = array();
$saida ="";

if(isset($_POST['id'])){
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $provincia = addslashes($_POST['provincia']);
    $bi = addslashes($_POST['bi']);
    $id = $_POST['id'];

    $sql ='UPDATE cidadao SET nome = :n, email =:e, provincia = :p, bi = :b WHERE id = :id';
    $cmd = $pdo->prepare($sql);
    $cmd->bindValue(":n",$nome);
    $cmd->bindValue(":e",$email);
    $cmd->bindValue(":p",$provincia);
    $cmd->bindValue(":b",$bi);
    $cmd->bindValue(":id",$id);
    $cmd->execute();
    if($cmd->rowCount() >= 1){
        $saida .= "<p class='alert alert-success text-center'>  Cidadao " .$nome. "Actualizado com sucesso</p>";
    }else{
        $saida .= "<p class='alert alert-danger text-center'> falha no cadastro</p>";
    }



}else{
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $provincia = addslashes($_POST['provincia']);
    $bi = addslashes($_POST['bi']);

if(empty($nome)){
    $erro['e'] = "Digite o seu Nome";
}elseif(empty($email)){
    $erro['e'] = "Digite o seu email";
}elseif(empty($provincia)){
    $erro['e'] = "Escolha a sua provincia";
}elseif(empty($bi)){
    $erro['e'] = "Digite o numero do Bi";
}else{
    $sql = 'INSERT INTO cidadao (nome,email, provincia, bi) value(:n,:e,:p,:b)';
    $cmd = $pdo->prepare($sql);
    $cmd->bindValue(":n",$nome);
    $cmd->bindValue(":e",$email);
    $cmd->bindValue(":p",$provincia);
    $cmd->bindValue(":b",$bi);
    $cmd->execute();
    if($cmd->rowCount() >= 1){
        $saida .= "<p class='alert alert-success text-center'>  Cidadao " .$nome. " cadastrado com sucesso</p>";
    }else{
        $saida .= "<p class='alert alert-danger text-center'> falha no cadastro</p>";
    }
}


}
if(isset($erro['e'])){
    $saida .= "<p class='alert alert-danger text-center'>".$erro['e']."</p>";
}
 
echo $saida;