<?php
    require_once('check_connexion.php');
    $result = mysqli_query($conn, "SELECT Nom_type FROM type_nourriture");
?>


<form method="post" action="insert.php">
    <label for="Nom_aliment">Nom aliment:</label>
    <select name="Nom_aliment" id="Nom_aliment" style="width: 200px;">
        <?php
            while($row = mysqli_fetch_array($result)) {
                echo "<option width='200' value='" . $row['Nom_aliment'] . "'>" . $row['Nom_aliment'] . "</option>";
            }
        ?>
    </select><br>

    <label for="Nom_composant">Nom composant:</label>
    <select name="Nom_composant" id="Nom_composant" style="width: 200px;">
        <?php
            while($row = mysqli_fetch_array($result)) {
                echo "<option width='200' value='" . $row['Nom_aliment'] . "'>" . $row['Nom_aliment'] . "</option>";
            }
        ?>
    </select><br>
</form>

<?php
    if(isset($_POST['submit'])){
        if (isset($_POST['Nom_aliment']) && isset($_POST['Nom_composant'])) {
            $nom_aliment = $_POST['Nom_aliment'];
            $nom_composant = $_POST['Nom_composant'];
        

            require_once('check_connexion.php');

            $sql = "INSERT INTO composant (`Nom_aliment`, `Nom_composant`) VALUES ('$nom_aliment', $nom_composant)";

        //insert a new record
            if (mysqli_query($conn, $sql)) {
                echo '<script>alert("Insertion succeed");</script>';
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            $nom_aliment = NULL;
            $calorie = NULL;
            $type = NULL;
        
            require_once('close_connexion.php');
        }
        else{
            echo 'one or more values losing';
        }
    } 

    //virer les $_POST important!!
    // echo '
    //     <script>
    //         if ( window.history.replaceState ) {
    //             window.history.replaceState( null, null, window.location.href );
    //         }
    //     </script>
    // ';
    require_once('emptyPost.php');
?>