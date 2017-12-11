<?php
include "./classes/br/com/projeto/EmissaoRelatorioController.php";
$emissaoRelatorioController = new EmissaoRelatorioController();
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Leitura XML</title>
        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/popper/popper.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/popper/popper.js"></script>

        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom fonts for this template -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <hr>
        <div class="container">
            <h3>Resumo de Contribuição</h3>
            <div class="card">
                <div class="card-block">
                    <div class="container">
                        <br>
                        <form  id="mainForm"  id="formEmissao" method="POST" enctype="multipart/form-data">
                            <input name="emissao" value="true" type="hidden"/>
                            <div class="form-group">
                                <div class="alert alert-<?= $emissaoRelatorioController->alertType ?> alert-dismissible fade show" role="alert">
                                    <strong>Aviso!</strong> <?= $emissaoRelatorioController->message ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="file" required="true" accept="text/xml" type="file" class="form-control-file" aria-describedby="fileHelp">
                                <small id="fileHelp" class="form-text text-muted">Só será possível a leitura de arquivo XML válido...</small>
                            </div>
                            <button id="btnEmitir" type="submit" class="btn btn-primary">
                                <span class="fa fa-print"></span> Emitir
                            </button>
                        </form>
                        <div id="output">
                            <?php if ($emissaoRelatorioController->lstContribuinte !== null) { ?>
                                <script>
                                    setTimeout(function () {
                                        $("#mainForm").fadeOut(function () {
                                            $("#relatorio").fadeIn();
                                        });
                                    }, 2200);
                                </script>
                                <div id="relatorio" style="display: none">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" onclick="window.location.href = '';">
                                            <span class="fa fa-print"></span> Emitir Novamente
                                        </button>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Contribuinte</th>
                                                <th scope="col">Venal Territorial</th>
                                                <th scope="col">Venal Predial </th>
                                                <th scope="col">Débito</th>
                                                <th scope="col">Àrea Construida</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($emissaoRelatorioController->lstContribuinte as $contribuinte) { ?>
                                                <tr>        
                                                    <td><?= $contribuinte->nome ?></td>
                                                    <td><?= $emissaoRelatorioController::calcVenalTerritorial($contribuinte) ?></td>
                                                    <td><?= $emissaoRelatorioController::calcVenalPredial($contribuinte) ?></td>
                                                    <td><?= $emissaoRelatorioController::calcCobranca($contribuinte) ?></td>
                                                    <td><?= $contribuinte->area_construida ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </body>
</html>
