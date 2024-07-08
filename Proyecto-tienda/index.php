<?php
  require 'config/database.php';
  $db = new database;
  $con = $db->conectar();

  $sql = $con->prepare("SELECT id, nombre, precio FROM producto WHERE activo=1");
  $sql->execute();
  $resultado = $sql->fetchAll(PDO::FETCH_ASSOC)


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda_online</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <link  href="css/estilos.css" rel="stylesheet">
</head>
<body>

<header>
  <div class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="#" class="navbar-brand">
        
        <strong>Neotok Store</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarHeader">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a href="#" class="nav-link active">Catalogo</a>
            
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">Contacto</a>
            
          </li>
           
          <a href="carrito.php" class="btn btn-primary" >Carrito</a>
        </ul>
      </div>
    </div>
  </div>

  <main>
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">
            <img src="images/Productos/1/Camisa_Goyo.jpeg" alt="">
            <div class="card-title">
              
              <h5 class="card-text" > T-shirt de Satoru Gojo & Toji Fushiguro</p>
              <p class="card-text">$8</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="" class="btn btn-primary">Detalles</a>
                </div>
                <a href="" class="btn btn-success">Agregar a carrito</a>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


</header>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>

