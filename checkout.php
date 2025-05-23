<?php
session_name('licoreria');
session_start();
require_once __DIR__.'/controllers/CarritoController.php';
require_once __DIR__.'/controllers/OrdenesController.php';
// Verifica si el usuario está autenticado
if (!isset($_SESSION['IdCliente'])) {
    header('Location: /LicoreriaProject/login.php'); // Redirige al login si el usuario no está autenticado
    exit();
}
$idUsuario = $_SESSION['IdCliente'];
// Inicializa los controladores
$carritoController = new CarritoController();
$ordenController = new OrdenesController();

// Obtén los productos del carrito del usuario
$productosCarrito = $carritoController->MirarCarrito($idUsuario);

// Procesa el checkout
if (!empty($productosCarrito)) {
    // Crea la orden
    $ordenController->checkout($idUsuario);
    
    // Vacía el carrito después de completar la compra
    $carritoController->vaciarCarrito($idUsuario);

    echo "<h2>carrito limpio</h2>";
    echo "<p></p>";
} else {
    echo "<h2>Carrito Vacío</h2>";
    echo "<p>No tienes productos en el carrito para completar la compra.</p>";
}
?>
<?php
// require_once 'CarritoModel.php';
// require_once 'OrdenModel.php';
// require_once 'DetalleOrdenModel.php';
// require_once 'CarritoController.php';
// require_once 'OrdenController.php';

// // Inicializa los modelos y controladores
// $ordenController = new OrdenesController();
// $idUsuario = $_POST['idUsuario']; // Asumiendo que idUsuario viene del formulario

// Procesa el checkout
// $ordenController->checkout($idUsuario);
?>

<!-- <h2>Compra Completada</h2>
<p>¡Tu pedido ha sido realizado exitosamente!</p> -->