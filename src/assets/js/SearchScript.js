function pressSearch() {
  var value = document.getElementById("SelectCityOrMunicipality").value;
  if (value == '') {
    return;
  }
    window.location.replace('result.php?ID='+value, '_blank');
  }