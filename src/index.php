<html>
  <head>
    <title>Search Page</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="SearchCSS.css">
    <script type="text/javascript" src="assets/js/SearchScript.js"></script>
  </head>
  <body>
    <?php
      include "header.php";
    ?>
    <section>
      <nav>
          <div class="input-group">
            <select class="custom-select" id="SelectCityOrMunicipality" aria-label="CustomSearch">
              <option disabled selected value="">Please choose city ot municipality</option>
              <?php
                include "BusinessLogic/JobPositions.php";
                $jobPositions = new BusinessLogic\JobPositions();
                $cities = $jobPositions->getAllCities();

                foreach($cities as $city) {
                  if ($city->isMainCity) {
                    echo('<option value="' . $city->id . '">' . $city->cityName . '</option>' . '<br>');
                  }
                }

                echo('<optgroup label="_________">');
                foreach($cities as $city) {
                  if (!$city->isMainCity) {
                    echo('<option value="' . $city->id . '">' . $city->cityName . '</option>' . '<br>');
                  }
                }
                echo('</optgroup>');
              ?>
            </select>
            <div class="input-group-append">
              <button onclick="pressSearch()" class="btn btn-outline-secondary" type="button">Search</  button>
            </div>
          </div>
      </nav>
      <article>

        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <img src="assets/images/workTime.png" class="img-fluid">
            </div>
            <div class="col-md-6">
              <p class="text-center">On every job you do, you've got to raise your game. My <br>   ambition is to just get better and better every job you do — <br> you should never stop   trying to get better. You have to teach <br> yourself new things — I don't think you   necessarily learn <br> them from other people because you have your own style of <br>   doing things, but hopefully you get better.</p>
              <p class="text-center font-italic">Ray Winstone</p>
            </div>
          </div>
        </div>

      </article>
    </section>
    <?php
      include "footer.php";
    ?>
  </body>
</html>