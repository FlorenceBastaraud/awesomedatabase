<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Awesome Database</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css"/>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="favicon.ico" />
</head>
<body>

  <!-- Header -->
  <nav class="navbar navbar-expand-md bg-success navbar-dark d-flex justify-content-center">
    <a class="navbar-brand" href="#"><img src="img/logo.png" alt="AwesomeDatabase logo"></a>
  </nav>

  <div class="container">

  <!-- Section 1: Intro -->
    <div class="row">
      <div class="col-lg-12 my-5">
        <h3 class="text-center text-success font-weight-bold  mt-5">La meilleure interface gestion pour votre base de données</h3>
        <div class="text-center"><h3><i>100% Intuitif, rapide, efficace</i></h3><i class="fas fa-file"></i></div>
      </div>
    </div>

  
  
  <!-- Tableau titre -->
    <div class="row">
      <div class="col-lg-6">
        <h4 class="mt-2 text-dark">Informations membres</h4>
      </div>
      <div class="col-lg-6 d-flex justify-content-end align-items-center">
        <button class="btn btn-dark m-1" type="button" data-toggle="modal" data-target="#ajoutMembre"><i class="fas fa-plus mr-3"></i>Ajouter membre</button>
        <a href="action.php?export=excel" class="btn btn-success">Exporter base de données</a>
      </div>
    </div>
    <hr class="my-2">
  <!-- Tableau contenu -->
    <div class="row">
      <div class="col-lg-12">
        <div id="afficherMembres" class="table-responsive">
                   <h4 class="text-center text-dark" style="margin-top: 150px;">Affichage des membres ...</h4>
        </div>
      </div>
    </div>


    <!-- fin container -->
  </div>


   <!--Ajout nouveau membre (formulaire popup) -->
   <div class="modal fade" id="ajoutMembre">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-plus mr-3"></i>Nouveau membre</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body px-4">
          <form action="" method="post" id="form-infos">
                <div class="form-group">
                  <input type="text" class="form-control" name="nom" placeholder="Nom" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Adresse E-mail" required>
                </div>
                <div class="form-group">
                  <input type="tel" class="form-control" name="telephone" placeholder="Téléphone" required>
                </div>
                <div class="form-group">
                <input type="submit" id="ajoutM" name="ajout" value="Valider nouveau membre" class="btn btn-success btn-block">
                </div>
          </form>
        </div>        
      </div>
    </div>
  </div>


<!--Modifier membre (formulaire popup) -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-plus mr-3"></i>Modifier informations membre</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body px-4">
          <form action="" method="post" id="modif-form-infos">
            <input type="hidden" name="id" id="id">
                <div class="form-group">
                  <input type="text" class="form-control" name="nom" id="nom" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="prenom" id="prenom" required>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="form-group">
                  <input type="tel" class="form-control" name="telephone" id="telephone" required>
                </div>
                <div class="form-group">
                <input type="submit" id="update" name="update" value="Modifier" class="btn btn-primary btn-block">
                </div>
          </form>
        </div>        
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="node_modules/jquery/dist/jquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="js/functions.js"></script>
</body>
</html>