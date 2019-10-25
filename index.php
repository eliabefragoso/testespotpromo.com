<?php include('json.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Teste Spot Promo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>Cidades</h2>
  <ul class="list-group">
    <?php 
        $cidades = json_decode($response);
        $cidades = $cidades->{'CIDADES'}; 
        foreach($cidades as $c){
            $cit = 'Codigo da Cidade: '.$c->{'codCidade'}.' Cidade: '.$c->{'cidade'}.' UF: '.$c->{'uf'};
            echo '<li class="list-group-item" id="'.$c->{'codCidade'}.'">'.$cit; ?>
             <button type="button" onclick="editar('<?php echo $c->{'codCidade'}?>','<?php echo $c->{'cidade'}?>','<?php echo $c->{'cidade'}?>')"class="btn btn-warning">Editar</button></li>
      <?php  } ?>
       

   
  </ul>
</div>
<div class="modal" tabindex="-1" role="dialog" id="dlgProdutos">
    <div class="modal-dialog" role="document"> 
        <div class="modal-content">
            <form class="form-horizontal" id="formProduto" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Novo produto</h5>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>                
</body>
<script type="text/javascript">
    function editar(codCidade,cidade,estado) {
        $('#dlgProdutos').modal('show');
         cidade = {
            cod:codCidade,
            cit:cidade,
            uf:estado 
         };
         $.post("/editar.php", cidade, function(data) {
            
        });

     }  
</script>
</html>
