<!DOCTYPE html>
<html lang="fr" ng-app="appEtud">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link data-require="bootstrap-css@3.1.1" data-semver="3.1.1" rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
    <script src="https://rawgit.com/michaelbromley/angularUtils-pagination/master/dirPagination.js"></script>
    <style type="text/css">
          .my-controller {
            border: 1px solid #fcc;
            padding: 5px;
            margin: 3px;
          }
          .my-controller small {
            color: #c99;
          }
          .other-controller {
            border: 1px solid #ccf;
            padding: 5px;
            margin: 3px;
          }
          .other-controller small {
            color: #99c;
          }
          .third-controller {
            border: 1px solid #cfc;
            padding: 5px;
            margin: 3px;
          }
          .third-controller small {
            color: #9c9;
          }
          .bt {
            padding-bottom:100px;
            padding-top: 1%;
          }
          .bt2 {
            margin-left: 19%;
            }
            .titre {
            padding-bottom:30px;
            padding-top: 30px;
            text-align:center;
          }
</style>

</head>
<body ng-controller="etucontroller" >
<div class="container bt" >
          <h1 class='titre'> Tableau d’étudiants </h1>
        
           <div class="row">
            
                <div class="col-xs-4">
                    <label for="search">Rechercher :</label>
                    <input ng-model="q" id="search" class="form-control" placeholder="Tapez votre text">
                </div>
                <div class="col-xs-4">
                    <label for="search">Nombre par page :</label>
                    <input type="number" min="1" max="100" class="form-control" ng-model="pageSize">
                </div>
                <div class="col-xs-4">
                    <div class="d-flex flex-row-reverse bd-highlight">
                    <a id="hideshow" href="<?php echo base_url('etudiants/etudiantPdf') ?>" class="btn btn-primary">Exporter en PDF</a>
                    </div>
                </div>
          </div>
        
          <div class="row">
            <table class="table table-striped table-hover mt-4">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sex</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <tr dir-paginate="d in mdatas | filter:q | itemsPerPage: pageSize" current-page="currentPage">
                        <th scope="row">{{ d.etudiant_id }}</th>
                        <td>{{d.etudiant_gender }}</td>
                        <td>{{d.etudiant_nameFirst }}</td>
                        <td>{{d.etudiant_nameLast }}</td>
                        <td>{{d.etudiant_email }}</td>
                        <td>{{d.etudiant_phone }}</td>
                    </tr>
                    
                </tbody>
            </table>
           </div> 
           
            <div ng-controller="PagerController" class="other-controller">
                <div class="text-center">
                    <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)"></dir-pagination-controls>
                </div>
            </div>
          
         <div class="row align-items-end">
            <div class="col-2">
            <a class="btn btn-primary" href="#" id='getetudiants' role="button">Peuplement du BD</a>
            
            </div>
            <div class="col-4 bt2" id="sh">
            <input id="pdfile" type="file" name="pdfile" />
            </div>
            <div class="col-2" id="sh1">
                <input id="mailid" type="text" name="mailid" class="form-control" placeholder="Email adresse..."/>
                
            </div>
            <div class="col" id="sh2">
                <button id="sendmail" class="btn btn-primary">Envoyer mail</button>
            </div>
        </div>
 </div>
    
 
     
    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
     $('#hideshow, #sh, #sh1, #sh2').hide();
     $('#sendmail').on('click', function() {
            var adressMail = $('#mailid').val();
            var fileData = $('#pdfile').prop('files')[0]; 
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  
            var rightfile = true;
            var go = true;
            
            if(fileData){
                 ext = fileData.name.split('.').pop();
            }else{ 
                alert('Sélectionner votre ficher en PDF ..');
                 rightfile = false;
            }
            if(!adressMail) {
                 alert('Votre adresse email ?'); go = false;
            }else{
                if(!regex.test(adressMail)) {alert('Votre adresse email est incorrect'); go = false;}
            }
            if(fileData && ext != 'pdf') { alert('Seulement ficher en PDF ..'); rightfile = false;}
            if(go && rightfile) {  
                var formData = new FormData();                  
                formData.append('file', fileData);
                formData.append('adressMail', adressMail);
                                        
                $.ajax({
                    url: '<?php echo site_url();?>/etudiants/sendEmail',  
                    dataType: 'text',  
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,                         
                    type: 'post',
                    success: function(response){
                        alert('Votre Email a été bien envoyé.');
                        location.reload(true);
                      
                    }
                });
           }
        });
    });
	 $("#getetudiants").click(function(){
       $.ajax({
          url: 'https://randomuser.me/api/?results=30&nat=fr&inc=gender,name,email,phone',
          dataType: 'json',
          success: function(data) {
                  location.reload(true);
                  $.ajax({
                      type: "POST",
                      dataType: 'json',
                      url: '<?php echo site_url();?>/etudiants/add',
                      data: data,
                      success: function(reponse) {               
                      },            
                  });
          
          },
	    });
    });
    
	
</script>
<script >
	var app = angular.module('appEtud', ['angularUtils.directives.dirPagination']); 
	    app.controller('etucontroller', function ($scope, $http){
      $scope.currentPage = 1;
      $scope.pageSize = 15;
      $scope.pageChangeHandler = function(num) {};
      $http.get('<?php echo site_url();?>/etudiants/loadatas')
        .then(function (reponse){
            
          if(reponse.data  != 'rien' ){
            $('#hideshow, #sh, #sh1, #sh2').show();
          }else{
              
            $('#hideshow, #sh, #sh1, #sh2').hide();
            
          }
          $scope.mdatas = reponse.data;
        
        });
    
    });

    function PagerController($scope) {
        $scope.pageChangeHandler = function(num) {
            console.log('going to page ' + num);
        };
    }
    app.controller('PagerController', PagerController);
</script>
</html>