<?php
require_once('template_head.php');
//require_once('template_menu.php');
?>

<!-- Header class -->
<header class="masthead" style="background-image: url('assets/img/legumes.jpeg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h2>Ajouter un repas</h2>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- body -->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <span class="subheading">
                <form>
                    <table align="center">
                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <!-- Calendrier qui renvoie au format date -->
                                <input type="date" id="date" class="inputText">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Aliment du repas </label>
                            </td>
                            <td>
                                <!-- liste déroulante de tous les aliments dans la base de données-->
                                <select name="repas" id="repas">

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Quantité en grammes :</label>
                            </td>
                            <td>
                                <input type="text" id="quantité" class="inputText">
                            </td>
                        </tr>
                    </table>
                </form>
                <div class="d-flex justify-content-end mb-4">
                    <a class="btn btn-primary text-uppercase" href="./homePage.php">Revenir</a>
                    <div style="width: 25px;"></div>
                    <button onclick="ajoutRepas()" class="btn btn-primary text-uppercase" id="submit">Ajouter</button>
                </div>
                <div class="d-flex justify-content-end mb-4">
                
                </div> 
            </span>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () { getAllAliments(); });
    //fonction qui récupère tous les aliments de la base de données
    function getAllAliments() {
        $.ajax({
            url: "../backend/aliments_back/api.php/",
            type: "GET",
            dataType: "json",
            success: function (data) {
                var options = '';
                $.each(data, function (index, value) {
                    options += '<option value="' + value.idAliment + '">' + value.nomAliment + '</option>';                    
                });
                $('#repas').append(options);
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
    //fonction qui ajoute un repas à la base de données
    function ajoutRepas() {
        const id = sessionStorage.getItem('userId');
        //print id
        console.log(id);
        var date = $('#date').val();
        var repas = $('#repas').val();        
        var quantité = $('#quantité').val();
        $.ajax({
            url: "../backend/api.php/newRepas",
            method : "POST",
            data: JSON.stringify({
                type: 'newRepas',
                //id de l'utilisateur connecté
                "Id_personne": id,
                "Id_aliment": repas,
                "Date_conso": date,
                "Quantite": quantité
            }),
            dataType: "json",
            success: function (data) {
                console.log(data);
                alert("Repas ajouté");
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

</script>
<?php
require_once('template_foot.php');
?>