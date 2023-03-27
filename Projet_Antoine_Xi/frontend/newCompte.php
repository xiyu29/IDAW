<?php

    require_once('template_head.php');
    //require_once('template_menu.php');

?>

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
                                                <label>Family name</label>
                                            </td>
                                            <td>
                                                <input type="text" id="nom" class="inputText">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Given name</label>
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
                                        <tr>
                                            <td>
                                            </td>
                                            <td align="right">
                                                <button onclick="" class="btn btn-primary" id="submit">Créer</button>
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

<?php

    require_once('template_foot.php');

?>