<html>
    <head>
        <title>Job position: </title>

        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
  
          <link rel="stylesheet" href="css/bootstrap.min.css">

    
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><!--Library for 'X' in Job Aplications Table -->
  <link rel="stylesheet" href="PositionStyle.css">

    </head>
    <body>
        <?php 
    class NewPosition{
        public $type;
        public $cntAplication;
    }
    
    $position1 = new NewPosition();
    $position1->type = 'Hacker';

    $position2 = new NewPosition();
    $position2->type = 'Baker';

    $position3 = new NewPosition();
    $position3->type = 'Shmatka';


    $arrpositions = array($position1, $position2, $position3);
   


if(isset($_POST["btnPos"])){
    $position = $_POST['inpPos'];
    $newPosition = new NewPosition();
    $newPosition->$type = $position;

    array_push($arrpositions, $newPosition);

    $db = mysqli_connect('localhost', 'root', '', 'job_offers_db');
                

}

?>

<nav class="navbar navbarColor" style="padding:0px">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" style="color:white; margin-left:30px;">JobPositionsProject</a>
    </div>
    <ul class="nav navbar-nav" style="flex-direction: row;">
      <li class="active"><a href="/" class="backgroundWhite">Home</a></li>
      <li><a href="/B_Login.php" class="backgroundWhite">Page 1</a></li>
      <li><a href="/Login.php" class="backgroundWhite">Page 2</a></li>
    </ul>
  </div>
</nav>



<!----------------------------------------Add ---------------------------------->

<button type="button" class="btn purpleBtn" data-toggle="modal" data-target="#myModal2" style="margin-left: 320px">Add position</button>
    <hr></hr>
<!-- Modal -->
<div id="myModal2" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>


        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="input-group input-group-sm">
  <!--<div class="input-group-prepend">  -->
  <div class="form-group">
    <h6>Create position</h6>
    <input type="text" name="inpPos" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="getPos">
  </div>
 </div>
      </div>
      <div class="modal-footer">
        <button type="button"  name="btnPos" data-dismiss="modal" id="updateButton"class="btn btn-default purpleBtn">Save</button>
        <button type="button" class="btn btn-default purpleBtn" data-dismiss="modal">Close</button>
    </div>
      </div>
    </div>

  </div>
</div>

  <!--Table head-->
  
 <!-- <div class="table-responsive  " id="myTable"> -->
  <table class="table" id="MyTable">
<table class="table" style="width: 600px;">
<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Position</th>
      <th class="text-center" scope="col" >Action</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ($arrpositions as $pos) : ?>
    <tr>
      <th scope="row">1</th>
      <td><?php echo $pos->type ?></td>
      <td style="padding-left: 100px;"><button type="button" id="MyBtn2"  class="btn  purpleBtn" data-toggle="modal" data-target="#myModal">Edit position</button>
      <button type="button" id="deleteBtn" class="btn purpleBtn" data-toggle="modal" data-target="#modalAplication">Job Aplications</button>
       <button type="button" id="deleteBtn" class="btn purpleBtn" data-toggle="modal" data-target="#modalConfirmDelete">Delete row</button>
   </td>
    </tr>
</tbody>
<?php endforeach ?>
</table>
<!-------------------------------------------------------- Edit  ----------------------------------------------------------------------->


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>


        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="input-group input-group-sm">
 
  <div class="form-group">
    <h6>Input job position</h6>
    <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
  </div>
   
 </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default purpleBtn" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default purpleBtn" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>

  </div>
</div>

<!-----------------------------Modal: modalConfirmDelete----------------------------------------------------------------------->
<div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        
      </div>

      <!--Body-->
      <div class="modal-body">
        <p class="heading">Are you sure?</p>
      </div>

      <!--Footer-type="button"-btn-outline-danger///btn-danger waves-effect purpleBtn  data-dismiss="modal -->
      <div class="modal-footer flex-center">
        <a href="" class="btn purpleBtn" style="text-align:center;">Yes</a>
        <a  href=""class="btn purpleBtn" style="text-align:center;">No</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>


<!--------------------------------------- Modal: Job Aplications ------------------------------------------------------------->

<!-- Modal: modalCart -->
<div class="modal fade" id="modalAplication" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Job Aplications</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">

        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>First name</th>
              <th>Last name</th>
              <th>E-mail</th>
              <th>CV<th>
              <th>Remove</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Ivan</td>
              <td>Ivanov</td>
              <td>ivan@abv.bg</td>
              <td>CV<td>
              <td><a><i class="fa fa-remove" Style="color:red"></i></a></td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Gorgi</td>
              <td>Geotgiev</td>
              <td>georgiev@gmail.com</td>
              <td>CV<td>
              <td><a><i class="fa fa-remove"Style="color:red"></i></a></td>
            </tr>
            

    
          </tbody>
        </table>

      </div>
      <!--Footer-->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary purpleBtn" data-dismiss="modal">Close</button>
        <button class="btn btn-primary purpleBtn">Checkout</button>
      </div>
    </div>
  </div>
</div>
  </tbody>

    
      </table>
</table>
<script>

</script>

    </body>
</html>