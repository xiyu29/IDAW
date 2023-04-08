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
                            <h2 class="post-meta">Bienvenue à IMangerMieux</h2>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page body -->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <span class="subheading">
                        <form>
                            <table align="center" class="tableIndex">
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
                                        <input type="password" id="mdp" class="inputText">
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
                                        <!-- <a href="newCompte.php" class="btn btn-primary">creer un compte</a> -->
                                        <button onclick="newCompte()" class="btn btn-primary" id="new">Créer un compte</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </span>
                </div>
            </div>
        </div>

        

<script>

    function newCompte(){
        event.preventDefault();
        console.log("click");
        window.location.href = path +  "frontend/newCompte.php";
    }

    function goToPage(url) {
        window.location.href = url;
    }
</script>

<?php


    require_once('template_foot.php');

?>