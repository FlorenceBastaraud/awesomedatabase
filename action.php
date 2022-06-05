<?php

  require_once 'dbase.php';
  $db = new Database();

  // affichage membres tableau
  if(isset($_POST['action']) && $_POST['action'] == "view"){
    $sortie = '';
    $data = $db->read();
    if($db->totalRowCount()>0){
      $sortie .= '<table class="table table-striped table-sm table-bordered">
      <thead>
        <tr class="text-center">
          <th>ID</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Adresse E-mail</th>
          <th>Téléphone</th>
          <th>Gérer</th>
        </tr>
      </thead>
      <tbody>';
      foreach($data as $row){
        $sortie .= '
        <tr class="text-center text-secondary">
          <td>'.$row['id'].'</td>
          <td>'.$row['nom'].'</td>
          <td>'.$row['prenom'].'</td>
          <td>'.$row['email'].'</td>
          <td>'.$row['telephone'].'</td>
          <td>
              <a href="#" class="text-dark infoBtn" id="'.$row['id'].'" title="Détails"><i class="fa fa-info mr-2"></i></a>

              <a href="#" class="text-dark editBtn" id="'.$row['id'].'" data-toggle="modal" data-target="#editModal" title="Modifier"><i class="fas fa-edit mr-2"></i></a>

              <a href="#" class="text-dark delBtn" id="'.$row['id'].'" title="Supprimer"><i class="fas fa-trash-alt mr-2"></i></a>
          </td>
        </tr>
        ';
      }
      $sortie .= '</tbody></table>';
      echo $sortie;
    }
    else{
      echo '<h3 class="text-center text-secondary mt-5">Il n\'y a pas de membres inscrit dans votre base de données.</h3>';
    }
  };

  // ajout
  if(isset($_POST['action']) && $_POST['action'] == "insert"){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    $db->insert($nom, $prenom, $email, $telephone);
  }

  // modif
  if(isset($_POST['edit_id'])){
    $id = $_POST['edit_id'];

    $row = $db->getMembreById($id);
    echo json_encode($row);
  }

  if(isset($_POST['action']) && $_POST['action'] == "update"){
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    $db->update($id, $nom, $prenom, $email, $telephone);

  }

  // supp
  if(isset($_POST['del_id'])){
    $id = $_POST['del_id'];

    $db->delete($id);
  }


  // afficher details membres
  if(isset($_POST['info_id'])){
    $id = $_POST['info_id'];

    $row = $db->getMembreById($id);
    echo json_encode($row);
  }


  // exporter tableau
  if(isset($_GET['export']) && $_GET['export'] == "excel"){
    header("Content-type: application/xls");
    header("Content-Disposition: attachment; filename=membres.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $data = $db->read();
    echo '<table border="1">';
    echo '<tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Email</th>            
            <th>Télephone</th>
          </tr>';

    foreach($data as $row){
      echo '
      <tr>
        <td>'.$row['id'].'</td>
        <td>'.$row['nom'].'</td>
        <td>'.$row['prenom'].'</td>
        <td>'.$row['email'].'</td>
        <td>'.$row['telephone'].'</td>
      </tr>';
    }
    echo '</table>';

  }


?>