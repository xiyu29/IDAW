<!doctype html>
<html lang="fr">

<head>
    <meta charset='utf-8'>
    <script src="./aliments_front/config.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./aliments_front/style.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <title>tabletest</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
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
    <form id="addPersonForm" action="" onsubmit="onFormSubmit();">
        <div class="form-group row">
            <label for="inputNom" class="col-sm-2 col-form-label">Nom Aliment*</label>
            <div class="col-sm-3">
                <input type="text" required="true" class="form-control" id="inputNom">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputType" class="col-sm-2 col-form-label">Type  </label>
            <div class="col-sm-3">
                <input type="text" required="true" class="form-control" id="inputType" >
            </div>
            <div class="form-group row">
                <span class="col-sm-2"></span>
                <div class="col-sm-2">
                    <br>
                    <button type="submit" class="btn btn-primary form-control">Submit</button>
                </div>
            </div>
    </form>
    
    <script>
        let aliments = [];
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
                tr.insertBefore("#tableBody tr:last");
                // Création du bouton de validation
                let button = $("<button type='submit' class='btn btn-warning'>Modifier</button> </br>");
                form.append(button);
                // Création du bouton d'annulation
                let buttonCancel = $("<button type='button' class='btn btn-danger'>Annuler</button>");
                buttonCancel.click(function () {
                    tr.remove();
                });
                form.append(buttonCancel);
                //remplissage du formulaire avec les données de l'aliment
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
                    updatePersonne(id, aliment);
                    tr.remove();
                });
            });
        }
        function updatePersonne(id, aliment) {
            $.ajax({
                url: API_BASE_URL + id,
                type: "PUT",
                contentType: "application/json",
                data: aliment,
                success: function (data) {
                    getAllPersonnes();
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
            addPersonne(aliment);
        }
        function addAliment(aliment) {
            $.ajax({
                url: API_BASE_URL,
                type: "POST",
                contentType: "application/json",
                data: aliment,
                success: function (data) {
                    console.log(data);
                    // refresh the table
                    getAllAliments();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
        function deleteAliment(id) {
            $.ajax({
                url: API_BASE_URL + id,
                type: "DELETE",
                success: function (data) {
                    console.log(data);
                    $("#tableBody tr:last").remove();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

    </script>
</body>

</html>