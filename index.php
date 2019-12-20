<?php 

  require_once './back/bbdd.php';
  include './back/funciones_varias.php';
  
  $search_param="";
  $single_result=false;

  // Recibimos un mensajes nuevo para el chat  
  if( !empty($_POST) ){
    
    if( isset($_POST['CUERPO']) && $_POST['CUERPO']!=""){
      $id_rep = $_POST['ID'];
      $tipo = $_POST['TIPO'];
      $remitente = $_POST['REMITENTE'];
      $cuerpo = $_POST['CUERPO'];
      
      $sql_insert = "INSERT INTO `mensajes`(`ID`, `TIPO`, `REMITENTE`, `CUERPO`, `VISTO`) 
      VALUES ('$id_rep', '$tipo' , '$remitente' , '$cuerpo' , 1 )";
      
      ejecutarConsulta( $sql_insert );
    
    }

    
  }




  if( isset($_GET['id']) && $_GET['id']!="" ){

    $id = $_GET['id'];
    $search_param = $id;

    
    $consulta="select * from vistachat where id= '{$id}'";
    
    $registro= ejecutarConsulta( $consulta );
    $single_result= $registro;

    if($registro){
                 
      $consulta_msg="select * from mensajes where id= '{$id}'";
      

     /*  echo "<pre>";
      print_r($registro); */

      $msgs=[];
      $msgs = ejecutarConsulta( $consulta_msg );
      $ultimo = $msgs[count($msgs)-1] ;

      $estado = new Estado( $registro['ESTADO'] );

      

      //print_r($ultimo);
     /*  print_r( $msgs );
      echo "</pre>"; */

      

    }

  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />

  <!--FontAwesome-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <!--Custom Styles-->
  <link rel="stylesheet" href="css/custom.css">
  <script src="./js/custom.js"></script>

  <title>SystemApp | Administrador</title>
</head>

<body>
  <!-- AREA NAVBAR-->
  <nav class="navbar navbar-expand-lg navbar-inverse sticky-top d-none">
    <div class="container">
      <a class="navbar-brand" href="#">SystemServices</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

          <li class="nav-item active">
            <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Libreta Diaria</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Lista Personalizable</a>
          </li>

      </div>
    </div>
  </nav>

  <header id="header" class="sticky-top">
    <div class="container">
      <div class="row">

        <div class="col-md-8">
          <h2><i class="fas fa-cog"></i> Sistema de gestion <small>| SystemServices</small> </h2>
        </div>

        <form method="GET" class="col-md-4  d-flex align-items-center">
          <div class="input-group">
            <input name="id" type="text" class="form-control" placeholder="Nro. orden, tlf, etc"
              aria-label="Recipient's username" aria-describedby="button-addon2" value="<?php echo $search_param;?>">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary color-main" type="submit" id="button-addon2"><i
                  class="fas fa-search icon-search"></i></button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </header>
  <!--
  <section id="breadcrumb">
    <div class="container">
      <ol class="breadcrumb">
        <li class="active">
          Dashboard
        </li>
      </ol>
    </div>
  </section>
-->
  <main id="main">
    <div class="container mt-4">
      <div class="row">
        <!-- ASIDE -->
        <div class="col-md-3">
          <ul class="list-group">
            <li class="list-group-item active color-main">Dashboard</li>
            <li class="list-group-item"><i class="far fa-clipboard"></i> Libreta diaria(NO) <span
                class="badge badge-secondary float-right">25</span></li>
            <li class="list-group-item">Ordenes pendientes(NO) <span class="badge badge-secondary float-right">25</span>
            </li>
            <li class="list-group-item">Demoradas(NO) <span class="badge badge-secondary float-right">25</span></li>
            <li class="list-group-item">Garantias de fabrica(NO) </li>
          </ul>
        </div>

        <div class="col-md-9">

          <!-- CARD ARTICULO -->
          <div class="card <?php if( !$single_result ){ echo "d-none";} ?>">
            <div class="card-header color-main">
              Datos del articulo
            </div>

            <div class="card-body">
              
              <div class="dropdown dropleft float-right">
                <button class="btn btn-outline-info font-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  +
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                  <button class="dropdown-item disabled" type="button">Cambiar estado</button>
                  <button class="dropdown-item disabled" type="button">Actualizar ubicación</button>
                  <button class="dropdown-item" type="button" data-toggle="modal" data-target="#modalChat">Ver todo el chat</button>
                </div>
              </div>


              <div class="media text-muted clearfix">
                <span class="estado" <?php echo  $estado->color; ?>><?php echo  $estado->etiq; ?></span>
                <div>
                  <h3><?php echo $registro['ID'] . " - " . $registro['TITULO'] . " - " . $registro['MARCA'];?></h3>
                  <p class="mb-1"><strong><i class="fas fa-map-marker-alt"></i> Ult. Ubicacion:</strong>
                    <?php echo $registro['UBICACION'];?></p>
                  <p><i class="far fa-clock"></i> Tiene XX dias en la tienda</p>
                </div>
              </div>
              <div class="card col-md-8 offset-md-4 color-msg-user">
                <div class="card-body">
                  <p class="card-text"><strong><?php echo $ultimo['REMITENTE'];?>:</strong>
                    <?php echo $ultimo['CUERPO'];?></p>
                  <small class="float-right font-weight-light font-italic"><?php echo $ultimo['TIME'];?></small>
                </div>
              </div>
              <div class="d-flex flex-row-reverse">
                <a href="#" class="btn btn-link" data-toggle="modal" data-target="#modalChat">
                  Ver todo el chat
                </a>
              </div>

            </div>

            <!-- CARD PARA LISTAR -->

            <!-- <div class="card-body pt-1 pb-1">
              <div class="media text-muted d-flex align-items-center">
                <span class="estado">E</span>
                <div class="">
                  <h4 class="mb-0 align-middle">145000 - Licuadora industrial - Moulinex</h4>
                  <small><strong><i class="fas fa-map-marker-alt"></i> Ult. Ubicacion:</strong> Estanterias
                    Administración - <i class="far fa-clock"></i> Tiene 50 dias en la tienda</small>
                </div>
              </div>
              <div class="card color-msg-user mt-2">
                <div class="card-body pt-1 pb-1">
                  <p class="card-text"><strong>Daniel:</strong> Some quick example text to build on the card title and
                    make up the bulk of the card's content.</p>
                  <small class="float-right font-weight-light font-italic">15/12/2019 - 10:50am</small>
                </div>
              </div>
              <div class="d-flex flex-row-reverse">
                <a href="#" class="btn btn-link" data-toggle="modal" data-target="#modalChat">
                  Ver todo el chat
                </a>
              </div>
            </div>
            <hr> -->



          </div>



        </div>

      </div>
    </div>
  </main>






  <!--MODALS-->
  <div class="modal fade" id="modalChat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="card">
          <div class="card-header color-main">
            Chat
            <button type="button" class="close fuente-blanca" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="card-body">
            <div class="media text-muted mb-3">
              <span class="estado" <?php echo  $estado->color; ?>><?php echo  $estado->etiq; ?></span>
              <div>
                <h5>145000 - Licuadora industrial - Moulinex</h4>
              </div>
            </div>
            <hr>

            <div id="chat-panel" style="height:70vh;">
            <div style="overflow-y: scroll; height:70%;">
            <?php 

              foreach( $msgs as $msg){
                
                if($msg['TIPO']==0){ //Mensaje del sistema
                  echo "
                  
                  <div class='card col-md-11 color-msg-sistem fuente-msg mb-3'>
                    <div class='card-body pt-2 pb-2 pr-2 pl-2'>
                      <p class='card-text'><strong>{$msg['REMITENTE']}:</strong>{$msg['CUERPO']}</p>
                      <small class='float-right font-weight-light font-italic'>{$msg['TIME']}</small>
                    </div>
                  </div>
                  
                  ";

                }else{ //Mensaje de usuario
                  echo "

                  <div class='card col-md-11 offset-md-1 color-msg-user fuente-msg mb-3'>
                    <div class='card-body pt-2 pb-2 pr-2 pl-2'>
                    <p class='card-text'><strong>{$msg['REMITENTE']}:</strong>{$msg['CUERPO']}</p>
                    <small class='float-right font-weight-light font-italic'>{$msg['TIME']}</small>
                    </div>
                  </div>
                  
                  ";

                }

              }

            
            ?>
            </div>
              <form class="form-group mt-3" method="POST">
                  <input name="ID" type="text" hidden value="<?php if( isset($id) ){ echo $id; } ?>">
                  <input name="REMITENTE" type="text" hidden value="Admin-Web"> <!--TODO: hacer sistema de usuarios-->
                  <input name="TIPO" type="text" hidden value="1">
                  <textarea  name="CUERPO" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                  <button class="btn btn-primary color-main mt-2 float-right">Enviar</button>
              </form>
            </div>


          </div>



        </div>
      </div>



    </div>
  </div>
  </div>


  

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>