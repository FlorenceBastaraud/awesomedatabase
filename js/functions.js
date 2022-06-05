$(document).ready(function() {
  
    // afficher membres tableau
    showAllMembres();
    function showAllMembres(){
        $.ajax({
            url: "action.php",
            type: "POST", 
            data: {action:"view"},
            success:function(response){
                $("#afficherMembres").html(response);
                $('table').DataTable( {
                    language: {
                        processing:     "Traitement en cours...",
                        search:         "Rechercher&nbsp;:",
                        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
                        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                        infoPostFix:    "",
                        loadingRecords: "Chargement en cours...",
                        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                        emptyTable:     "Aucune donnée disponible dans le tableau",
                        paginate: {
                            first:      "Premier",
                            previous:   "Pr&eacute;c&eacute;dent",
                            next:       "Suivant",
                            last:       "Dernier"
                        },
                        aria: {
                            sortAscending:  ": activer pour trier la colonne par ordre croissant",
                            sortDescending: ": activer pour trier la colonne par ordre décroissant"
                        }
                    },
                    order: [0, 'desc']
                } );
            }
        });
    }
    // ajout
    $("#ajoutM").click(function(e){
        if($("#form-infos")[0].checkValidity()){
            e.preventDefault();
            $.ajax({
                url: "action.php",
                type: "POST", 
                data: $("#form-infos").serialize()+"&action=insert",
                success:function(response){
                    Swal.fire({
                        title: 'Membre ajouté avec succès. Illico presto!',
                        type: 'success'
                    })
                    $("#ajoutMembre").modal('hide');
                    $("#form-infos")[0].reset();
                    showAllMembres();
                }
            })
        };
    });

    // modif
    $("body").on("click", ".editBtn", function(e){
        e.preventDefault();
        edit_id = $(this).attr('id');
        $.ajax({
            url: "action.php",
            type: "POST",
            data:{edit_id:edit_id},
            success:function(response){
                data = JSON.parse(response);
                $("#id").val(data.id);
                $("#nom").val(data.nom);
                $("#prenom").val(data.prenom);
                $("#email").val(data.email);
                $("#telephone").val(data.telephone);
            }
        });
    });


    // modif ajax
    $("#update").click(function(e){
        if($("#modif-form-infos")[0].checkValidity()){
            e.preventDefault();
            $.ajax({
                url: "action.php",
                type: "POST", 
                data: $("#modif-form-infos").serialize()+"&action=update",
                success:function(response){
                    Swal.fire({
                        title: 'Informations modifiées avec succès. Illico presto!',
                        type: 'success'
                    })
                    $("#editModal").modal('hide');
                    $("#modif-form-infos")[0].reset();
                    showAllMembres();
                }
            })
        };
    });

    // supp
    $("body").on("click", ".delBtn", function(e){
        e.preventDefault();
        let tr = $(this).closest('tr');
        del_id = $(this).attr('id');
        Swal.fire({
            title: 'Êtes-vous sûre de vouloir supprimer ce membre de votre base de données?',
            text: "Vous ne pourrez pas revenir en arrière!",
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: "Annuler",     
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer le membre!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data:{del_id:del_id},
                    success:function(response){
                        tr.css('background-color', '#ff6666');
                        Swal.fire(
                            'Supprimé',
                            'Membre supprimé avec succès. Illico Presto',
                            'success'
                        )
                        showAllMembres();
                    }
                });
            }
        });


    });


    // afficher details membre
    $("body").on("click", ".infoBtn", function(e){
        e.preventDefault();
        info_id = $(this).attr('id');
        $.ajax({
            url: "action.php",
            type: "POST",
            data:{info_id:info_id},
            success:function(response){
                console.log(response);
                data = JSON.parse(response);
                Swal.fire({
                    title:'<strong>Informations membre n°'+data.id+'</strong>',
                    type: 'info',
                    html: '<b>Nom :</b> '+data.nom+'<br><b>Prénom :</b> '+data.prenom+'<br><b>Adresse email :</b> '+data.email+'<br><b>Téléphone :</b> '+data.telephone,
                    confirmButtonText: 'Fermer'
                });
            }
        });

    });



});


