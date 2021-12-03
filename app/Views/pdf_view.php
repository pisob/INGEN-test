<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Liste des étudiants</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5"  > 
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
                <?php foreach ($datas as $key => $val) {?>
                    <tr >
                        <th scope="row"><?php echo $val['etudiant_id']; ?></th>
                        <td><?php echo $val['etudiant_gender']; ?></td>
                        <td><?php echo $val['etudiant_nameFirst']; ?></td>
                        <td><?php echo $val['etudiant_nameLast']; ?></td>
                        <td><?php echo $val['etudiant_email']; ?></td>
                        <td><?php echo $val['etudiant_phone']; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
    </div>
</body>

</html>