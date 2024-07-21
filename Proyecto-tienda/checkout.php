<?php
require 'config/config.php';
require 'config/database.php';

$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? isset($_SESSION['carrito']['productos']) : null;

print_r($_SESSION);
$lista_carrito = array();

if ($producto != null) {
  foreach ($producto as $clave => $cantidad) {
    $sql = $con->prepare("SELECT id, nombre, precio, $cantidad AS cantidad FROM producto WHERE id=? AND activo=1");
    $sql->execute([$clave]);
    $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tienda_online</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link href="css/estilos.css" rel="stylesheet">
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

            <a href="carrito.php" class="btn btn-primary">
              Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_card; ?></span></a>
          </ul>
        </div>
      </div>
    </div>

    <main>
      <div class="container">
        <div class="table-reponsive">
          <table class="table">
            <thead>
              <th>producto</th>
              <th>precio</th>
              <th>cantidad</th>
              <th>subtotal</th>
              <th></th>
            </thead>
            <tbody>
              <tr>
                <?php if ($lista_carrito == null) {
                  echo '<tr><td colspan="5" class="text-center"><b>lista vacia</b></td></tr>';
                } else {
                  $total = 0;
                  foreach ($lista_carrito as $productos) {
                    $id = $productos['id'];
                    $nombre = $productos['nombre'];
                    $precio = $productos['precio'];
                    $subtotal = $cantidad * $precio;
                    $total += $subtotal;

                ?>
              <tr>
                <td><?php echo $nombre; ?></td>
                <td><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></td>
                <td>
                  <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad ?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizaCantidad(this.value,<?php echo $_id; ?>)">
                </td>
                <td>
                  <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]" <?php echo MONEDA . number_format($subtotal, 2, '.', ','); ?>"></div>
                </td>
                <td>
                  <a href="&" id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a>
                </td>
              </tr>
            <?php } ?>
            <tr>
              <td colspan="3"></td>
              <td colspan="2">
                <p class="h3" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
              </td>
            </tr>
            </tbody>
          <?php } ?>
          </table>
          <div class="row">
            <div class="col-md-5 offset-md-7 d-grid gap-2">
              <button class="btn btn-primary btn-lg">Realizar pago</button>

            </div>

          </div>

        </div>
      </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-ms">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="eliminaModalLabel">Alerta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            ¿Desea eliminar el producto del carrito?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button id="btn-elimina" type="button" class="btn btn-danger" onclick="elimina()">Eliminar</button>
          </div>
        </div>
      </div>
    </div>


  </header>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <script>

    let eliminaModal = document.getElementById('eliminaModal')
    eliminaModal.addEventListener('show.bs.modal', function(event){
      let button = event.relatedTarget
      let id =button.getAttribute('data-bs-id')
      let buttonElimina = eliminaModal.querySelector('.moda-footer #btn-elinima')
      buttonElimina.value = id
    })

    function actualizaCantidad(cantidad, id) {
      let url = 'clases/actualizar_carrito,php'
      let formdata = new FormData()
      formdata.append('action', 'agregar')
      formdata.append('id', id)
      formdata.append('cantidad', cantidad)

    }
    fetch(url, {
        method: 'POST',
        body: FormData,
        mode: "cors"

      }).then(response => response.json())
      .then(data => {
        if (data.ok) {
          let divsubtotal = document.getElementById("subtotal_" + id)
          divsubtotal.innerHTML = data.sub

          let total = 0.00
          let list = document.getElementsByName('subtotal[]')

          for (let i = 0; i < list.length; i++) {
            total += parseFloat(list[i].innerHTML.replace(/[$,]/g, ''))
          }

          total = new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2
          }).format(total)
          document.getElementById('total').innerHTML = '<?php echo MONEDA ?>' + total


        }
      })
  </script>
</body>

</html>