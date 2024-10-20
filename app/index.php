<?php
    include 'databaseConnect.php';
    $konexioa = konektatuDatuBasera();
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bideojokoen Zerrenda</title>
    <link rel="stylesheet" href="main_style.css">
    <script src="main_script.js"></script>
</head>
<body>
    <h1>Bideojokoen Zerrenda</h1>
    <div class="bideojoko-zerrenda">
       <?php
        $sql = "SELECT * FROM bideojokoa";
        $result = $konexioa->query($sql);

        if (!$result) {
            echo "Errorea datu basearekin: " . $konexioa->error;
        } else if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                $game_id = $row["titulu"] . '-' . $row["egilea"]; // Crear un id único combinando título y autor
                echo "<div class='bideojoko' onclick='toggleDetalles(\"$game_id\")'>";
                echo "<h2 class='bideojoko-titulua'>" . $row["titulu"] . "</h2>";
                echo "</div>";
                echo "<table id='detalles-$game_id' style='display:none;'>";
                echo "<tr><th>Atributua</th><th>Balioa</th></tr>";
                echo "<tr><td>Titulua</td><td>" . $row["titulu"] . "</td></tr>";
                echo "<tr><td>Egilea</td><td>" . $row["egilea"] . "</td></tr>";
                echo "<tr><td>Prezioa</td><td>" . $row["prezioa"] . "</td></tr>";
                echo "<tr><td>Mota</td><td>" . $row["mota"] . "</td></tr>";
                echo "<tr><td>Deskribapena</td><td>" . $row["deskripzioa"] . "</td></tr>";
                echo "<tr><td>Urtea</td><td>" . $row["urtea"] . "</td></tr>";
                echo "</table>";


                /* Generar un id único para cada videojuego
                $game_id = $row["id"];
                echo "<div class='bideojoko' onclick='toggleDetalles($game_id)'>";
                // Mostrar datos sin aplicar htmlspecialchars()
                echo "<h2 class='bideojoko-titulua'>". $row["titulua"] . "</h2>";
                echo "</div>";
                echo "<table id='detalles-$game_id' style='display:none;'>";
                echo "<tr><th>Atributua</th><th>Balioa</th></tr>";
                echo "<tr><td>Titulua</td><td>" . $row["titulua"] . "</td></tr>";
                echo "<tr><td>Prezioa</td><td>" . $row["prezioa"] . "</td></tr>";
                echo "<tr><td>Mota</td><td>" . $row["mota"] . "</td></tr>";
                echo "<tr><td>Urtea</td><td>" . $row["urtea"] . "</td></tr>";
                echo "</table>";*/
            }
        } else {
            echo "<p>Bideojokorik ez dago.</p>";
        }

        $konexioa->close();
       ?>
    </div>

    <!-- Botones de acción -->
    <button class="aldatu-botoia" onclick="window.location.href='modify_user.php'" style="position: absolute; top: 10px; right: 10px;">Aldatu/Hasi Saioa</button>
    <button class="gehitu-botoia" onclick="erakutsiFormularioaGehitu()" style="position: absolute; top: 50px; right: 10px;">Bideojokoa Gehitu</button>

    <!-- Modal para agregar un nuevo videojuego -->
    <div id="modal-gehitu" class="modal" style="display:none;">
        <div class="modal-edukia">
            <span class="itxi" onclick="itxiFormularioaGehitu()">&times;</span>
            <form action="main_functions.php" method="post">
                <h3>Bideojoko Berria Gehitu</h3>
                <label for="gehituTitulua">Izenburua:</label>
                <input type="text" id="gehituTitulua" name="titulua" required><br>

                <label for="gehituPrezioa">Prezioa:</label>
                <input type="text" id="gehituPrezioa" name="prezioa" required><br>

                <label for="gehituMota">Mota:</label>
                <input type="text" id="gehituMota" name="mota" required><br>

                <label for="gehituDeskribapena">Deskribapena:</label>
                <textarea id="gehituDeskribapena" name="deskribapena" required></textarea><br>

                <label for="gehituArgitaratzeData">Argitaratze Urtea:</label>
                <input type="text" id="gehituArgitaratzeData" name="argitaratze_urtea" required><br>

                <button type="submit" class="gorde-botoia">Gehitu</button>
            </form>
        </div>
    </div>

    <script>
        function toggleDetalles(game_id) {
            var table = document.getElementById('detalles-' + game_id);
            if (table.style.display === 'none') {
                table.style.display = 'table';
            } else {
                table.style.display = 'none';
            }
        }

        function erakutsiFormularioaGehitu() {
            document.getElementById('modal-gehitu').style.display = 'block';
        }

        function itxiFormularioaGehitu() {
            document.getElementById('modal-gehitu').style.display = 'none';
        }
    </script>
</body>
</html>


