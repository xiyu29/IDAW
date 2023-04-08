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
                    <table align="center" class="table">
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
                                <select name="repas" id="repas" class="selectStyle">
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
                    <button onclick="ajoutNewRepas()" class="btn btn-primary text-uppercase" id="submit">Ajouter</button>
                </div>
            </span>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () { 
        getAllAliments(); 
    });
</script>
<?php
    require_once('template_foot.php');
?>