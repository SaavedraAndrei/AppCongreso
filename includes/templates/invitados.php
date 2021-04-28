<?php
try {
    require_once('includes/funciones/db_conexion.php');
    $sql = "SELECT * FROM `ponente` ";
    $resultado = $conn->query($sql);
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>

<section class="invitados contenedor seccion">
    <h2>Nuestros jugadores</h2>
    <ul class="lista-invitados clearfix">

        <?php while ($invitados = $resultado->fetch_assoc()) { ?>

            <li>
                <div class="invitado">
                    <a class="invitado-info" href="#invitado<?php echo $invitados['idPonente']; ?>">
                        <img src="img/<?php echo $invitados['ponFoto'] ?>" alt="Imagen invitado">
                        <p><?php echo $invitados['ponNombre'] . " " . $invitados['ponApellidoPaterno'] ?></p>
                    </a>
                </div> <!-- END .invitado -->
            </li>

            <div style="display:none;">

                <div class="invitado-info" id="invitado<?php echo $invitados['idPonente']; ?>">
                    <h2><?php echo $invitados['ponNombre'] ?></h2>
                    <img src="img/<?php echo $invitados['ponFoto'] ?>" alt="">
                    <p><?php echo $invitados['ponDescripcion'] ?></p>
                </div>

            </div>

        <?php } ?>

    </ul> <!-- END lista-invitados -->
</section> <!-- END .invitados -->

<?php
$conn->close();
?>