

<!doctype html>
<html lang="fr">

<head>
    <meta charset='utf-8'>
    <link rel="stylesheet" type="text/css" href="./aliments_front/style.css">
    <script src="./aliments_front/config.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>tabletest</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!--  -->
    <!-- bibliotheque DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
</head>

<body>
    <table id="myTable">
        <thead>
            <tr>
                <th>nom de l'Aliment</th>
                <th>type d'aliment</th>
                <th>supprimer</th>
                <th>modifier</th>
            </tr>
        </thead>
        <tbody id="tableBody">
        </tbody>
    </table>
    <form id="addAlimentform" action="" onsubmit="onFormSubmit();">
        <div class="form-group row">
            <label for="inputNom" class="col-sm-2 col-form-label">Nom Aliment</label>
            <div class="col-sm-3">
                <input type="text" required="true" class="form-control" id="inputNom">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputType" class="col-sm-2 col-form-label">Type </label>
            <div class="col-sm-3">
                <input type="text" required="true" class="form-control" id="inputType">
            </div>
            <div class="form-group row">
                <span class="col-sm-2"></span>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary form-control">Submit</button>
                </div>
            </div>
			<br>
			<div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="./homePage.php">← Retour </a></div>
    </form>
    <script>
        var editor; // use a global for the submit and return data rendering in the examples

        $(document).ready(function () {
            getAllAliments();
        });
        function getAllAliments() {
            $('#myTable').DataTable({
                "ajax": {
                    "url": API_BASE_URL,
                    "dataSrc": ""
                },
                "columns": [
                    { "data": "nomAliment" },
                    { "data": "type" },
                    {
                        "data": "idAliment",
                        "render": function (data) {
                            return "<button class='btn btn-danger' onclick='deleteAliment(" + data + ")'>Supprimer</button>";                            
                        }
                    },
                    {
                        "data": "idAliment",
                        "render": function (data) {
                            return "<button class='btn btn-warning' onclick='modifyAliment(" + data + ")'>Modifier</button>";
                        }
                    }
                ]
            });
        }

        function getOneAliment(id, callback) {
            $.ajax({
                url: API_BASE_URL + id,
                type: "GET",
                success: function (data) {
                    console.log(data);
                    callback(data);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
        function modifyAliment(id) {
            // Récupération de l'aliment à modifier
            getOneAliment(id, function (aliment) {
                // Création du formulaire
                let form = $("<form></form>");
                // Remplacement de la ligne de la table par le formulaire
                let tr = $("<tr></tr>");
                tr.append("<h2> Modifier </h2>");
                tr.append("<td><input type='text' name='nomAliment'></td><td></td>");
                tr.append("<td><input type='text' name='type'></td><td></td>");
                tr.find("td:last").append(form);
                tr.insertAfter("#tableBody tr:last");
                // Création du bouton de validation
                let button = $("<button type='submit' class='btn btn-warning'>Modifier</button> </br>");
                form.append(button);
                // Création du bouton d'annulation
                let buttonCancel = $("<button type='button' class='btn btn-danger'>Annuler</button>");
                buttonCancel.click(function () {
                    tr.remove();
                });
                form.append(buttonCancel);
                //préremplissage du formulaire avec les données de l'aliment
                tr.find("input[name='nomAliment']").val(aliment.nomAliment);
                tr.find("input[name='type']").val(aliment.type);
                // Ajout de l'évènement de soumission du formulaire
                form.submit(function (event) {
                    event.preventDefault();
                    let nomAliment = tr.find("input[name='nomAliment']").val();
                    let type = tr.find("input[name='type']").val();
                    let aliment = {
                        nomAliment: nomAliment,
                        type: type,
                    };
                    console.log(aliment);
                    aliment = JSON.stringify(aliment);
                    updateAliment(id, aliment);
                    tr.remove();
                });
            });
        }
        function updateAliment(id, aliment) {
            $.ajax({
                url: API_BASE_URL + id,
                type: "PUT",
                contentType: "application/json",
                data: aliment,
                success: function (data) {
                    console.log("data updated");
                    //refresh the table
                    $('#myTable').DataTable().ajax.reload();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
        function onFormSubmit() {
            // prevent the form to be sent to the server
            event.preventDefault();
            let nomAliment = $("#inputNom").val();
            let type = $("#inputType").val();;
            let aliment = {
                nomAliment: nomAliment,
                type: type,
            };
            //connvertir le tableau en JSON
            aliment = JSON.stringify(aliment);
            addAliment(aliment);
        }
        function addAliment(aliment) {
            $.ajax({
                url: API_BASE_URL,
                type: "POST",
                contentType: "application/json",
                data: aliment,
                success: function () {
                    console.log("data added");
                    //refresh the table
                    $('#myTable').DataTable().ajax.reload();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
        function deleteAliment(id) {
            const url = API_BASE_URL + id;
            console.log(id);
            $.ajax({
                url: url,
                type: "DELETE",
                success: function () {
                    console.log("deleted");
                    //remove in the table the element with the id
                    $('#myTable').DataTable().ajax.reload();
                },
                error: function (error) {
                    console.log(error);
                }
            });
            console.log(url);
        }

    </script>
</body>

</html>