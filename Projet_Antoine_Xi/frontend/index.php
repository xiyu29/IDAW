<?php

    require_once('template_head.php');
    //require_once('template_menu.php');

?>

        <!-- Navigation-->
        
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/legumes.jpeg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <!-- <h1>Connexion</h1> -->
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
                                            </td>
                                            <td align="right">
                                                <button onclick="connexion()" class="btn btn-primary" id="submit">Se connecter</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            </td>
                                            <td align="right">
                                                <a href="newCompte.php" class="btn btn-primary">creer un compte</a>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

<script>

    function connexion(){
        console.log("connexion");
    }

    function newCompte(){
        console.log("click");
        window.location.href = "http://localhost/Projet_Antoine_Xi/frontend/newCompte.php";
    }
</script>

<?php


    require_once('template_foot.php');

?>