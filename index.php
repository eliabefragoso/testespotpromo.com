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
             <button type="button" onclick="editar('<?php echo $c->{'codCidade'}?>','<?php echo $c->{'cidade'}?>','<?php echo $c->{'uf'}?>')"class="btn btn-warning">Editar</button></li>
      <?php  } ?>
       

   
  </ul>
</div>
<div class="modal" tabindex="-1" role="dialog" id="dlgcidade">
    <div class="modal-dialog" role="document"> 
        <div class="modal-content">
            <form class="form-horizontal" id="formCidade" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Cidade</h5>
                </div>
                <div class="modal-body">
                <div class="form-group">
                <input type="hidden" value="" id="cod">   
               <label for="NomeCidade" class="control-label">Nome Cidade</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="nomeCidade">
                        </div>
                    </div>
                    <label for="UF" class="control-label">UF</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="uf">
                        </div>
                    </div>
                
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
        $("#cod").val(codCidade); 
        $("#nomeCidade").val(cidade);
        $("#uf").val(estado);
        $('#dlgcidade').modal('show');       
        
     }
     function salvar(){
        cidade = {
            cod:$("#cod").val(),
            cit:$("#nomeCidade").val(),
            uf:$("#uf").val() 
         };
         $.post("/editar.php", cidade, function(data) {
             alert(data);
        });
     }
     $("#formCidade").submit( function(event){ 
        event.preventDefault(); 
        
        salvar();    
        $("#dlgcidade").modal('hide');
    });
    
   
</script>
</html>
