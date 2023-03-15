<?php

include "db.php";
$base = "";
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sql = 'SELECT * from cidadao where id = :id';
    $cmd = $pdo->prepare($sql);
    $cmd->bindValue(":id", $id);
    $cmd->execute();
    $dados = $cmd->fetch();

    $base .= '
        <form action="" id="update" class="form-group">
        <div class="row">
            <div class="col">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o seu nome...." value="'.$dados['nome'].'">
            </div>
            <div class="col">
                <label class="form-label">Email</label>
                <input type="hidden" name="id" id="id" class="form-control"  value="'.$dados['id'].'">
                <input type="email" name="email" id="email" class="form-control" placeholder="Digite o seu email..." value="'.$dados['email'].'">
            </div>
        </div>
        <div class="row pt-3">
            <div class="col">
                <label for="" class="form-label">Provincia</label>
                <select name="provincia" id="provincia" class="form-control">
                    <option value="'.$dados['nome'].'">'.$dados['provincia'].'</option>
                    <option value="maputo">Maputo</option>
                    <option value="gaza">Gaza</option>
                    <option value="inhambane">Inhambane</option>
                    <option value="beira">Beira</option>
                    <option value="tete">Tete</option>
                </select>
            </div>
            <div class="col">
                <label for="" class="form-label">B.I./CPF</label>
                <input type="text" name="bi" id="" class="form-control" placeholder="numero do bilhete de identidade" value="'.$dados['bi'].'">
            </div>
        </div>
        <div class="row pt-4">
            <div class="">
                <input type="submit" value="Actualizar" id="update" class="btn btn-success col-12">
            </div>
        </div>
    </form>
    ';
}elseif(isset($_POST['del'])){
    // delete
    $id = $_POST['del'];
    $sql = 'DELETE from cidadao where id = :id';
    $cmd = $pdo->prepare($sql);
    $cmd->bindValue(":id", $id);
    $cmd->execute();
   
    if($cmd->rowCount() >= 1){
        $base .= "<p class='alert alert-success text-center'>  Cidadao Deletado com sucesso</p>";
    }else{
        $base .= "<p class='alert alert-danger text-center'>Falha Na Remocao</p>";
    }

}else{
    $sql = 'SELECT * from cidadao';
    $cmd = $pdo->prepare($sql);
    $cmd->execute();
    $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);

    foreach($dados as $k)
    $base .='
        <tr>
            <td>'.$k['nome'].'</td>
            <td>'.$k['email'].'</td>
            <td>'.$k['provincia'].'</td>
            <td>'.$k['bi'].'</td>
            <td><input type="submit" value="Editar"  class="btn btn-primary edit" id="'.$k['id'].'"></td>
            <td><input type="submit" value="Delete" class="btn btn-danger delete" id="'.$k['id'].'"></td>
        </tr>
    ';
    
}
echo $base;

