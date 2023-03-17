<form method="post" action="insert.php">
  <label for="name">Nom aliment:</label>
  <input type="text" name="nom_aliment" id="nom_aliment"><br>
  <label for="email">Calorie par 100g:</label>
  <input type="text" name="calorie" id="calorie"><br>
  <label for="phone">Type</label>
  <input type="text" name="type" id="type"><br>
  <input type="submit" name="submit" value="Insert">
</form>

<?php
    if(isset($_POST['submit'])){
        if (isset($_POST['nom_aliment']) && isset($_POST['calorie']) && isset($_POST['type'])) {
            $nom_aliment = $_POST['nom_aliment'];
            $calorie = $_POST['calorie'];
            $type = $_POST['type'];
        

            require_once('check_connexion.php');

            $sql = "INSERT INTO aliment (`Nom_aliment`, `Calorie_par_100g`, `Type`) VALUES ('$nom_aliment', $calorie, '$type')";

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