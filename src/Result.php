<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$db = "JobCareers";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "call JobCareers.getActivePosByCity(" . $_GET['ID'] . ")";
$result = $conn->query($sql);

$resultFromSearch = '';

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      $resultFromSearch .= 
        '<tr>
          <td>' . $row["idPositions"] . '</td>
          <td>' . $row["positionName"]. '</td>
          <td>' . $row["description"]. '</td>
          <td>' . $row["createdOn"]. '</td>
          <td> TEST </td>
        </tr>';
  }
}

$conn->close();

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.js">

    <link type="text/css" rel="stylesheet" href="ResultCSS.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.css"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<title>Result page</title>

</head>
<body>

<header>
  <p></p>
</header>

<div class="container mb-3 mt-3">
      <table class="table table-striped table-bordered resultTable">
        <thead>
          <tr>
            <th class="th-sm"> №
            </th>
            <th class="th-sm">Job Name
            </th>
            <th class="th-sm">Job Description
            </th>
            <th class="th-sm js-publishing-date">Publishing Date
            </th>
            <th class="th-sm">Posted by
            </th>
          </tr>
        </thead>
        <tbody>

         ' . $resultFromSearch . '
           
        </tbody>
        <tfoot>
          <tr>
            <th>№
            </th>
            <th>Job Name
            </th>
            <th>Job Description
            </th>
            <th>Publishing Date
            </th>
            <th>Posteb by
            </th>
          </tr>
        </tfoot>
      </table>
</div>

<footer>
  <p></p>
</footer>

<script>
$(\'.resultTable\').DataTable({
  ordering: false
});

var table = $(\'.resultTable\').DataTable();

$(\'.resultTable thead th\').each( function () {
  var title = $(this).text();

  if ($(this).is(\'.js-publishing-date\')) {
    $(this).html( \'<input type="date" placeholder="\' + title + \'" />\' );

    return;
  }

  $(this).html( \'<input type="text" placeholder="Search \' + title + \'" />\' );
});

table.columns().every( function () {
  var that = this;
  $(\'input\', this.header() ).on( \'keyup change\', function () {
    if (that.search() !== this.value) {
        that.search( this.value).draw();
    }
  });
});

$(document).ready(function() {
    var table = $(\'.resultTable\').DataTable();
     
    $(\'.resultTable tbody\').on(\'dblclick\', \'tr\', function () {
        var data = table.row( this ).data();
        alert( \'You clicked on \'+data[0]+\'s row\' );
    });
});

</script>

</body>
</html>';