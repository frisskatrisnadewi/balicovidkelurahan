<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title>Peta Sebaran Covid-19</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
          <!-- REQUIRED SCRIPTS -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    

    <!-- Leaflet (JS/CSS) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://pendataan.baliprov.go.id/assets/frontend/map/MarkerCluster.css" />
    <link rel="stylesheet" href="https://pendataan.baliprov.go.id/assets/frontend/map/MarkerCluster.Default.css" />

    <!-- Leaflet-KMZ -->
    <script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>




 <style>
    html,
    body,
    #map {
        height: 400px;
        width: 100%;
        padding: 0;
        margin: 0;
    }
</style>



</head>
<body >

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg">
      <a class="navbar-brand " href="#"> 
    BALI COVID-19</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item ">
            <a class="nav-link" href="/data">Data Sebaran </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/peta">Peta Sebaran <span class="sr-only">(current)</span></a>
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
        @yield('peta')
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



<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html> 