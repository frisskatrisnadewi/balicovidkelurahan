@extends('layouts.masterpeta')
	
@section('search')
		
		<div class="row mt-4">
			<div class="col-sm-6">
				<div >
          
					<div class="card-body">
           
						<div class="col">
              <blockquote class="blockquote text-center">
                <h3><strong>PENYEBARAN DATA COVID-19 PROVINSI BALI</strong></h3>
                <footer >
                  <div class=" row justify-content-center">
                   <img src="kalender.png" class="rounded float-left" style="width:10%">
                  
                  </div>
                  <h5 class="justify-content-center">{{$tanggalSekarang}}</h5> 
                  
                </footer>
              </blockquote>
					
                
                
                 <div class="row">
                  
                </div>
                
					   	</div>

					</div>
				</div>
			
		</div>
<!-- <div class="col-sm-6 " style="margin-bottom: 15px">
        <div class="card shadow-sm">
          <div class="card-title d-flex justify-content-center ">
            <strong>Keterangan Warna</strong>
          </div>
          <hr>
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                Titik Tertinggi
                  <input type="color" value="#611E15" class="form-control" id="colorStart">
              </div>
              <div class="col-6">
                 Titik Terendak
                   <input type="color" value="#EDF377" class="form-control" id="colorEnd">
              </div>
              </div>
             

          </div>
        </div>
      
    </div> -->
               
   </div> 
 </div>
		
	
@endsection

@section('peta')

<div class="row mt-4 ">
	<div class="col-sm-8 mt-4">
		<div class="card shadow-sm">
			<div class="card-header bg-warning text-white">
				<div class="row">
					<div class="col-6">
						<h5>Peta Sebaran Data {{$tanggalSekarang}}</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div id="map">

        </div>

			</div>

		</div>
	</div>

	<div class="col-sm-4 mt-4">
		<div class="row row-cols-1 row-cols-md-2">
		  <div class="col mb-4  ">
		    <div class="card border-primary shadow-sm "style="max-width: 18rem;">
		    <div class="card-header d-flex justify-content-center "><h5>Positif</h5></div>
		      <div class="card-body bg-primary">
		        <h6 class="card-title text-white d-flex justify-content-center">Total Kasus</h6>
		        <p class="card-text text-white d-flex justify-content-center ">{{$positif[0]->positif}}</p>
		      </div>
		    </div>
		  </div>

		  <div class="col mb-4 ">
		    <div class="card border-danger shadow-sm"style="max-width: 18rem;">
		    <div class="card-header d-flex justify-content-center "><h5>Meninggal</h5></div>
		      <div class="card-body bg-danger">
		        <h6 class="card-title text-white d-flex justify-content-center">Total Kasus</h6>
		        <p class="card-text text-white d-flex justify-content-center">{{$meninggal[0]->meninggal}}</p>
		      </div>
		    </div>
		  </div>

		 <div class="col mb-4 ">
		    <div class="card border-warning shadow-sm"style="max-width: 18rem;">
		    <div class="card-header d-flex justify-content-center "><h5>Dirawat</h5></div>
		      <div class="card-body bg-warning">
		        <h6 class="card-title text-white d-flex justify-content-center">Total Kasus</h6>
		        <p class="card-text text-white d-flex justify-content-center ">{{$rawat[0]->rawat}}</p>
		      </div>
		    </div>
		  </div>

		  <div class="col mb-4 ">
		    <div class="card border-success shadow-sm"style="max-width: 18rem;">
		    <div class="card-header d-flex justify-content-center"><h5>Sembuh</h5></div>
		      <div class="card-body bg-success">
		        <h6 class="card-title text-white d-flex justify-content-center">Total Kasus</h6>
		        <p class="card-text text-white d-flex justify-content-center">{{$sembuh[0]->sembuh}}</p>
		      </div>
		    </div>
		  </div>
    </div>
</div>
</div>
<br>

<script src="https://pendataan.baliprov.go.id/assets/frontend/map/leaflet.markercluster-src.js"></script>

<script>
  $(document).ready(function () {
    var dataMap=null;
    var dataPos=null;

    var tanggal = $('#tanggalSearch').val();
    console.log(tanggal);
    $.ajax({
      async:false,
      url:'/getData',
      type:'get',
      dataType:'json',
      data:{date: tanggal},
      success: function(response){
        dataMap = response;
      }
    });
    console.log(dataMap);   
   

    var map = L.map('map').setView([-8.655924, 115.216934], 13);
            L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                        maxZoom: 20,
                        subdomains:['mt0','mt1','mt2','mt3']
                    }).addTo(map);
    setMapColor();
    // define variables
    var lastLayer;
    var defStyle = {opacity:'1',color:'#000000',fillOpacity:'0',fillColor:'#CCCCCC'};
    var selStyle = {color:'#0000FF',opacity:'1',fillColor:'#00FF00',fillOpacity:'1'};
    
    function setMapColor(){
      var markerIcon = L.icon({
        iconUrl: '/marker.png',
        iconSize: [40, 40],
      });


    // Instantiate KMZ parser (async)
          var kmzParser = new L.KMZParser({
          onKMZLoaded: function (layer, name) {
          control.addOverlay(layer, name);
          var markers = L.markerClusterGroup();
          var layers = layer.getLayers()[0].getLayers();

          console.log(layers[0]);
            // fetching sub layer
          layers.forEach(function(layer, index){
          
          var kab  = layer.feature.properties.NAME_2;
          kab = kab.toUpperCase();
          var prov = layer.feature.properties.NAME_1;
          var kec =  layer.feature.properties.NAME_3;
          var kel = layer.feature.properties.NAME_4;
          var kasus;

          var STYLE = {opacity:'1',color:'#000',fillOpacity:'1'};
          var matcha = {opacity:'1',color:'#000',fillOpacity:'1', fillColor:'#46db55'};
          var darkmatcha = {opacity:'1',color:'#000',fillOpacity:'1', fillColor:'#04420a'};
          var yolkegg = {opacity:'1',color:'#000',fillOpacity:'1', fillColor:'#f0f00c'};
          var youngblood = {opacity:'1',color:'#000',fillOpacity:'1', fillColor:'#fa5555'};
          var blood = {opacity:'1',color:'#000',fillOpacity:'1', fillColor:'#630303'};
          
          if(!Array.isArray(dataMap) || !dataMap.length == 0){
                    var searchResult = dataMap.filter(function(it){
                      return it.kecamatan.replace(/\s/g,'').toLowerCase() === kec.replace(/\s/g,'').toLowerCase() &&
                              it.kelurahan.replace(/\s/g,'').toLowerCase() === kel.replace(/\s/g,'').toLowerCase();
          });
          //
          if(!Array.isArray(searchResult) || !searchResult.length ==0){
            // set sub layer default style positif covid

             var daerah = searchResult[0];
            if(daerah.positif == 0 ){
              layer.setStyle(matcha);  
            }else if(daerah.rawat == 0 && daerah.positif>0 && daerah.sembuh >= 0 && daerah.meninggal >=0){
              layer.setStyle(darkmatcha);
            }else if(daerah.ppln ==1 && daerah.rawat == 1 && daerah.positif == 1 && daerah.tl==0 || daerah.ppdn ==1 && daerah.rawat == 1 && daerah.positif == 1 && daerah.tl==0){
              layer.setStyle(yolkegg);
            }else if((daerah.ppln >1 && daerah.rawat <= daerah.ppln && daerah.sembuh <= daerah.ppln && daerah.tl == 0) || (daerah.ppdn >1 && daerah.rawat <= daerah.ppdn && daerah.sembuh <= daerah.ppdn && daerah.tl == 0)  ){
              layer.setStyle(youngblood);
            }else{
              layer.setStyle(blood);
            }


                      
            // peparing data format
            var data = '<table width="300">';
                data +='  <tr>';
                data +='    <th colspan="2">'+kab+'</th>';
                data +='  </tr>';

               
              
             
              data +='  <tr>';
              data +='    <td>Kecamatan</td>';
              data +='    <td>: '+kec+'</td>';
              data +='  </tr>';  

              data +='  <tr>';
              data +='    <td>Kelurahan</td>';
              data +='    <td>: '+kel+'</td>';
              data +='  </tr>';             

              
              data +='  <tr>';
              data +='    <td>Positif</td>';
              data +='    <td>: '+daerah.positif+'</td>';
              data +='  </tr>';            
              
               data +='  <tr>';
              data +='    <td>Level</td>';
              data +='    <td>: '+daerah.level+'</td>';
              data +='  </tr>';  
              
            data +='</table>';
    

          }else{
            var data = "Tidak ada Data pada tanggal tersebut"
            layer.setStyle(defStyle);
          }
        }
          layer.bindPopup(data);
        });
        map.addLayer(markers);
        layer.addTo(map);
        }
    });
  
    // Add remote KMZ files as layers (NB if they are 3rd-party servers, they MUST have CORS enabled)
    kmzParser.load('bali-kelurahan.kmz');
    // kmzParser.load('https://raruto.github.io/leaflet-kmz/examples/globe.kmz');

    var control = L.control.layers(null, null, {
        collapsed: false
    }).addTo(map);
    $('.leaflet-control-layers').hide();
    }
  });
</script>


@endsection

@section('content')
<br>
 
<div class="col">
		
			<div class="card-header bg-info">
				<div class="row">
					<div class="col-6">
						<h5 class="text-white">Tabel Sebaran Data {{$tanggalSekarang}}</h5>
					</div>
				</div>
			</div>
			
				
				<table class="table table-hover table-dark table-responsive-md " >		
<!--  tambahan-->
					<tr class="bg-dark">
            <th rowspan="2">No</th>
            <th rowspan="2">Kabupaten</th>
            <th rowspan="2">Kecamatan</th>
            <th rowspan="2">Kelurahan</th>
            <th rowspan="2">Level</th>
            <th colspan="5">Penyebaran</th>
            <th colspan="5">Kondisi</th>
						
					</tr>

          <tr class="bg-dark">
            <th>PP-LN</th>
            <th>PP-DN</th>
            <th>TL</th>
            <th>Lainnya</th>
            <th>Total</th>
            <th>Perawatan</th>
            <th>Sembuh Covid</th>
            <th>Meninggal</th>
            <th>Total</th>
          </tr>
					
					<?php 
						if(count($data)>0){
							$s	=	'';
							foreach($data as $val){
								$s++;
					?>
					<tr>
						<td class="bg-secondary text-light" ><?php echo $s ?? '';?></td>
            <td class="bg-secondary text-light">{{$val->nama_kab}}</td>
						<td class="bg-secondary text-light">{{$val->kecamatan}}</td>
            <td class="bg-secondary text-light">{{$val->kelurahan}}</td>
            <td class="bg-secondary text-light">{{$val->level}}</td>
            <td class="bg-secondary text-light">{{$val->ppln}}</td>
            <td class="bg-secondary text-light">{{$val->ppdn}}</td>
            <td class="bg-secondary text-light">{{$val->tl}}</td>
            <td class="bg-secondary text-light">{{$val->lainnya}}</td>
            <td class="bg-secondary text-light">{{$val->positif}}</td>
						<td class="bg-secondary text-light">{{$val->rawat}}</td>
						<td class="bg-secondary text-light">{{$val->sembuh}}</td>
            <td class="bg-secondary text-light">{{$val->meninggal}}</td>
						<td class="bg-secondary text-light">{{$val->positif}}</td>
			
					</tr>
					<?php 
							}
						}else{
					?>
						<tr><td colspan="6" align="center">No Record(s) Found!</td></tr>
					<?php } ?>					
				
				</table>
        {{ $data->links() }}
      </div>
			</div>
      <br>
		



@endsection

@section('footer')

<blockquote class="blockquote text-center">
  <p class="mb-0">Friska Trisnadewi</p>
  <footer class="blockquote-footer">1705551078 </footer>
</blockquote>



@endsection
