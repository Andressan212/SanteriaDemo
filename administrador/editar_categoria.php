<?php

require_once("../includes/verificar.php");
require_once("../includes/conexion.php");

if (!isset($_GET["id"])) {

    header("Location: categorias.php");
    exit();
}

$id = $_GET["id"];

$sql = $conexion->prepare("

SELECT *

FROM categorias

WHERE id = ?

LIMIT 1

");

$sql->execute([$id]);

if ($sql->rowCount() == 0) {

    header("Location: categorias.php");
    exit();
}

$categoria = $sql->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Categoría</title>

    <link rel="stylesheet" href="../css/administrador.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>

    <div class="adminLayout">

        <?php include("../includes/menu.php"); ?>

        <div class="content">

            <div class="encabezadoDashboard">

                <div>

                    <h1>Editar Categoría</h1>

                    <p>Modifique los datos de la categoría.</p>

                </div>

            </div>

            <div class="formAdmin">

                <form action="../acciones/actualizar_categoria.php"

                    method="POST"

                    enctype="multipart/form-data">

                    <input

                        type="hidden"

                        name="id"

                        value="<?php echo $categoria["id"]; ?>">

                    <div class="grupo">

                        <label>Nombre</label>

                        <input

                            type="text"

                            name="nombre"

                            value="<?php echo htmlspecialchars($categoria["nombre"]); ?>"

                            required>

                    </div>

                    <div class="grupo">

                        <label>Descripción</label>

                        <textarea

                            name="descripcion"

                            rows="5"><?php echo htmlspecialchars($categoria["descripcion"]); ?></textarea>

                    </div>

                    <div class="grupo">

                        <label>Estado</label>

                        <select name="estado">

                            <option value="1" <?php if ($categoria["estado"] == 1) echo "selected"; ?>>

                                Activa

                            </option>

                            <option value="0" <?php if ($categoria["estado"] == 0) echo "selected"; ?>>

                                Inactiva

                            </option>

                        </select>

                    </div>

                    <div class="grupo">

                        <label>Nueva Imagen (Opcional)</label>

                        <input

                            type="file"

                            name="imagen"

                            accept="image/*">

                    </div>

                    <?php if (!empty($categoria["imagen"])) { ?>

                        <div class="grupo">

                            <label>Imagen actual</label>

                            <img

                                src="../img/categorias/<?php echo $categoria["imagen"]; ?>"

                                style="width:120px;border-radius:10px;">

                        </div>

                    <?php } ?>

                    <div class="botonesFormulario">

                        <button

                            class="btnGuardar"

                            type="submit">

                            <i class="fa-solid fa-floppy-disk"></i>

                            Actualizar

                        </button>

                        <a

                            href="categorias.php"

                            class="btnCancelar">

                            <i class="fa-solid fa-arrow-left"></i>

                            Volver

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</body>

</html>