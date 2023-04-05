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
                                <label>Login</label>
                            </td>
                            <td>
                                <input type="text" id="login" class="inputText">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Mot de passe</label>
                            </td>
                            <td>
                                <input type="text" id="mdp" class="inputText">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Nom</label>
                            </td>
                            <td>
                                <input type="text" id="nom" class="inputText">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Prénom</label>
                            </td>
                            <td>
                                <input type="text" id="prenom" class="inputText">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" id="email" class="inputText">
                            </td>
                        </tr>
                    </table>
                </form>
                <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="http://localhost/Projet_Antoine_Xi/frontend/homePage.php">←Revenir</a></div>
                <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="http://localhost/Projet_Antoine_Xi/frontend/ajoutRepas.php">Ajouter→</a></div>
            </span>
        </div>
    </div>
</div>

<?php
    require_once('template_foot.php');
?>