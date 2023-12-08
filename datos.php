<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deportes</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #35478C, #7D7D7D);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }

        .main {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            display: flex;
            justify-content: space-between; /* Alinea los elementos al inicio y al final */
            align-items: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #35478C;
            color: #FFF;
        }

        button {
            background-color: #0c0962;
            color: #FFF;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #1BC5E0;
        }

        .imagen {
            width: 150px;
            flex: 0 0 auto;
            margin-left: 20px;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .volver {
            margin-top: 20px;
            text-align: center;
        }

        a {
            text-decoration: none;
            background-color: #0c0962;
            color: #FFF;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #1BC5E0;
        }
    </style>
</head>
<body>
    <div class="main">
        <?php
            include_once "conn.php";

            $consulta = $con->query('SELECT * FROM ges_deportes.deportes');
            echo "<table border='1'>";
            echo "<thead> <th>Nombre</th> <th>Jugadores</th> <th>Superficie</th> <th>URL Imagen</th> <th>Imagen</th><th>Detalles</th></thead>";
            while ($fila = $consulta->fetch()) {
                echo "<tr>";
                echo "<td>" . $fila['NOMBRE'] . "</td>";
                echo "<td>" . $fila['NUM_JUGADORES'] . "</td>";
                echo "<td>" . $fila['SUPERFICIE'] . "</td>";
                echo "<td>" . $fila['IMG'] . "</td>";
                echo "<td><button class='ver-imagen' data-img='" . base64_encode($fila['IMG_BLOB']) . "'>Ver Imagen</button></td>";
                echo "<td><a href='detalles.php?id=" . $fila['ID'] . "'>Ver Más</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        ?>
        <div class="imagen">
            <img src="img/cargando.jpg" alt="La imagen se mostrará aquí" id="img" style="width: 100%; height: 100%;">
        </div>
    </div>
    <div class="volver">
        <a href="menu.php">Volver atrás</a>
    </div>
    <script>
        var botones = document.querySelectorAll(".ver-imagen");
        var imagen = document.getElementById("img");

        botones.forEach(function(boton) {
            boton.addEventListener("click", function(e) {
                var base64Img = e.target.getAttribute("data-img");
                imagen.src = "data:image/jpeg;base64," + base64Img;
            });
        });
    </script>
</body>
</html>
