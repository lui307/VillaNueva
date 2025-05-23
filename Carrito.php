<?php include 'views/client/templates/encabezado.php';
require_once 'controllers/CarritoController.php';
// Verifica si el usuario está autenticado y obtiene el ID del usuario
$idUsuario = isset($_SESSION["IdCliente"]) ? $_SESSION["IdCliente"] : null;
if (!$idUsuario) {
    // Redirige al usuario a la página de inicio de sesión si no está autenticado
    // header('Location: /LicoreriaProject/pages-login.php');
    echo "
    <script>
        window.open('http://localhost/LicoreriaProject/views/admin/pages-login.php','_self');
    </script>";
    exit();
}
// Inicializa el controlador de carrito y obtiene los productos del carrito
$carritoController = new CarritoController();
$resultadoCarrito = $carritoController->MirarCarrito($idUsuario);
$objetoCarrito = $resultadoCarrito['items'];
$total = $resultadoCarrito['total'];
// Verifica si se ha enviado una solicitud POST para añadir al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'addtocart') {
    $idProducto = $_POST['product-id'];
    $cantidad = $_POST['product-quantity'];
    $fecha = date('Y-m-d H:i:s'); // Fecha y hora actual
    // Añade el producto al carrito
    $carritoController->AñadirProductCarrito($idUsuario, $idProducto, $cantidad, $fecha);
    // Redirige a la página del carrito o muestra un mensaje de éxito
    echo "
    <script>
        window.open('http://localhost/LicoreriaProject/Carrito.php','_self');
    </script>";
    exit();
}
?>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h2>TU CARRITO DE COMPRAS</h2>
            <p>Total un (1 producto) S/700</p>
            <p>
                Tus articulos esta reservados en tu carrito, realiza la compra para poder hacer el envio
            </p>
            <?php foreach ($objetoCarrito as $obj) { ?>
                <div class="card mb-3 w-100">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="/LicoreriaProject/views/admin/<?php echo $obj["imagen"] ?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $obj["NombreProduct"] ?></h5>
                                <p class="card-text"><?php echo $obj["descripcion"] ?></p>
                                <p class="card-text"><small class="text-body-secondary"><?php echo $obj["fechaAgregado"] ?></small></p>
                                <!-- <input type="number" name="cantidad" id="cantidad" value="1" min="1" max="<?php echo $obj["cantidad"] ?>"> -->
                                <input type="number" class="form-control quantity" data-id="<?php echo htmlspecialchars($obj['idProducto']); ?>" value="<?php echo htmlspecialchars($obj['cantidad']); ?>" min="1" max="<?php echo htmlspecialchars($obj['unidades']); ?>">
                                <p class="card-text"><strong>Precio: <span class="price" data-price="<?php echo htmlspecialchars($obj['precio']); ?>"><?php echo htmlspecialchars($obj['precio']); ?></span></strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="col text-center p-4">
            <div id="paypal-button-container"></div>
            <button type="button" class="btn btn-primary text-center mb-4" style="width: 90%;" onclick="window.location.href='/LicoreriaProject/checkout.php';">
                <h4>vaciar carrito</h4>
            </button>
            <h3><strong>RESUMEN DEL PEDIDO</strong></h3>
            <p>Entrega Gratis</p>
            <p><strong>Total: <span id="total"><?php echo number_format($total, 2); ?></span></strong></p>
        </div>
    </div>
</div>

<script src="https://www.paypal.com/sdk/js?client-id=Ab1cKI3fm9Qw4AruQhvhmW2Q2HD5O4V-DVgLyBGhLXx8vLXYQ7ihLuIIeQTEL5SfKBUn8y9DgfEiDp-S&currency=USD"></script>
<script>

    const quantityInputs = document.querySelectorAll('.quantity');
    const totalElement = document.getElementById('total');

    function updateTotal() {
        let total = 0;
        quantityInputs.forEach(input => {
            const quantity = parseInt(input.value);
            const price = parseFloat(input.nextElementSibling.querySelector('.price').getAttribute('data-price'));
            total += quantity * price;
        });
        totalElement.textContent = total.toFixed(2); // Actualiza el total
    }

    quantityInputs.forEach(input => {
        input.addEventListener('input', function() {
            // Aquí puedes enviar una solicitud AJAX si quieres actualizar el total en el servidor
            updateTotal();
        });
    });
    paypal.Buttons({
        createOrder: function(data, actions) {
            const total = parseFloat(totalElement.textContent).toFixed(2);
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: total // Aquí puedes usar el total del carrito
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                // 1️⃣ Vaciar el carrito del localStorage
                localStorage.removeItem('carrito');

                // 2️⃣ Registrar la compra en la base de datos con AJAX
                fetch('procesar_compra.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            orderID: data.orderID,
                            amount: orderData.purchase_units[0].amount.value,
                            productos: JSON.parse(localStorage.getItem('carrito')) || []
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href= "/LicoreriaProject/checkout.php";
                        } else {
                            alert('Error al registrar la compra.');
                        }
                    });
            });
        }
    }).render('#paypal-button-container');
</script>
<?php include 'views/client/templates/footer.php';  ?>