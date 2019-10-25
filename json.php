<?php 


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://relatorios.spotpromo.com.br/teste/mobile/jsonTest.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/x-www-form-urlencoded",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

include('DB.class.php');

$cidades = json_decode($response);
        $cidades = $cidades->{'CIDADES'}; 
        foreach($cidades as $c){
            $verificar = DB::getConn()->prepare("SELECT `cod` FROM `usuarios` WHERE `cod`=?");
			$verificar->execute(array($c->{'codCidade'}))
				if($verificar->rowCount()<1){
                    $inserir = DB::getConn()->prepare("INSERT INTO `cidades` SET `cod`=?, `cidade`=?, `uf`=?");
                    $inserir->execute(array($c->{'codCidade'},$c->{'cidade'},$c->{'uf'})); 
                }
        }    

?>