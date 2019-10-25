<?php 
include('DB.class.php');
try{
    $cod = $_POST['cod'];
    $cidade = $_POST['cit'];
    $uf = $_POST['uf'];

    $update = DB::getConn()->prepare("UPDATE cidades SET cidade=?, uf=? WHERE cod=?");
    $verificar->execute(array($cidade,$uf,$cod));
    echo json_encode('Atualização Realizada Com Sucesso!');
}catch(PDOException $e){
    
    logErros($e);
    echo json_encode($e);
}     
echo json_encode($_POST['cod']);

?> 