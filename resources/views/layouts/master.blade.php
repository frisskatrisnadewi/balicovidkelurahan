<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

	<script type="text/javascript">

       

	function hitung()
      {
        var sembuh = (document.getElementById('sembuh').value == '' ? 0:document.getElementById('sembuh').value);
        var rawat = (document.getElementById('rawat').value == '' ? 0:document.getElementById('rawat').value);
        var meninggal = (document.getElementById('meninggal').value == '' ? 0:document.getElementById('meninggal').value);

        var result = (parseInt(sembuh)) + (parseInt(rawat)) + (parseInt(meninggal));
        if (!isNaN(result)) {
           document.getElementById('positif').value = result;
        }
      }


      </script>


</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand " href="#"> 
    BALI COVID-19</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="/data">Data Sebaran <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/peta">Peta Sebaran</a>
          </li>
          
        </ul>
      </div>
    </nav>


<div class="content" style="margin-top: 0px;">
    <div class="card shadow-lg justify-content-md-center" style="margin-left: 15px;margin-right: 15px;">
      <div class="container-fluid ">
        @yield('search')
      </div>
    </div>
      <br>
    <div class="card shadow-lg justify-content-md-center" style="margin-left: 15px;margin-right: 15px;">
      <div class="container-fluid ">
        @yield('content')
      </div>
    </div>
    <br>
    <div class="card shadow-lg justify-content-md-center" style="margin-left: 15px;margin-right: 15px;">
      <div class="container-fluid ">
        @yield('footer')
      </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html> 