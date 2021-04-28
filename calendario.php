<?php include_once 'includes/templates/header.php'; ?>
<section class="seccion contenedor">
    <h2>Calendario de Eventos</h2>

    <?php
    try {
        require_once('includes/funciones/db_conexion.php');
        $sql = " SELECT idEvento, eveNombre, eveFecha, eveHora, categoria.idCategoria, catIcono, ponNombre, ponApellidoPaterno ";
        $sql .= " FROM evento ";
        $sql .= " INNER JOIN categoria ";
        $sql .= " ON evento.idCategoria = categoria.idCategoria ";
        $sql .= " INNER JOIN ponente ";
        $sql .= " ON evento.idPonente = ponente.idPonente ";
        $sql .= " ORDER BY idEvento ";
        $conn->set_charset('utf8');
        $resultado = $conn->query($sql);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }


    ?>


    <div class="calendario">
        <?php
        $calendario = array();
        while ($eventos = $resultado->fetch_assoc()) {


            // obtiene la fecha del evento

            $fecha = $eventos['eveFecha'];

            $evento = array(
                'titulo' => $eventos['eveNombre'],
                'fecha' => $eventos['eveFecha'],
                'hora' => $eventos['eveHora'],
                'categoria' => $eventos['idCategoria'],
                'icono' =>  $eventos['catIcono'],
                'invitado' => $eventos['ponNombre'] . " " . $eventos['ponApellidoPaterno']
            );

            $calendario[$fecha][] = $evento;

        ?>
        <?php   } // while de fetch_assoc()  
        ?>


        <?php
        // Imprime todos los eventos
        setlocale(LC_ALL, 'es_MX.UTF-8');
        foreach ($calendario as $dia => $lista_eventos) { ?>
            <h3>
                <i class="fa fa-calendar"></i>
                <?php
                // Windows
                setlocale(LC_TIME, 'spanish');

                echo utf8_encode(strftime("%A, %d de %B del %Y", strtotime($dia)));  ?>
            </h3>
            <?php foreach ($lista_eventos as $evento) { ?>
                <div class="dia">
                    <p class="titulo"><?php echo $evento['titulo']; ?></p>
                    <p class="hora">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        <?php echo $evento['fecha'] . " " . $evento['hora']; ?>
                    </p>
                    <p>
                        <i class="fa <?php echo $evento['icono']; ?>" aria-hidden="true"></i>
                        <?php echo $evento['categoria']; ?>
                    </p>
                    <p>
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <?php echo $evento['invitado']; ?>
                    </p>
                    </p>

                </div>

            <?php } // fin foreach eventos 
            ?>
        <?php } // fin foreach de dias 
        ?>
    </div>

    <?php
    $conn->close();
    ?>

</section>


<?php include_once 'includes/templates/footer.php'; ?>