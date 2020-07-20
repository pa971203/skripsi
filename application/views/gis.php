<section class="page-section">
<div class="container">
  <div class="my-3 p-3 bg-white rounded shadow-sm">
             <div class="row mt 50">
                <div class="col-md-12">
                   <h2><?= $title ?></h2> 
                   <div id="map" style=" height: 500px;"></div>             
                    </div>
                </div>
                 <!-- /. ROW  -->
              <hr/>
<div id='map'></div>

<script type="text/javascript" src="<?= base_url() ?>assets/js/kuansing.js"></script>

<script type="text/javascript">

  var map = L.map('map').setView([-0.482808, 101.512052], 10);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);


  // control that shows state info on hover
  var info = L.control();

  info.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info');
    this.update();
    return this._div;
  };

  info.update = function (p) {
    this._div.innerHTML = '<h5>PETA SEBARAN COVID-19</h5>' +  '<h5>KABUPATEN KUANTAN SINGINGI</h5>' +(p ?
    '<b>' + p.name + '</b><br />'  + '<b> ODP : '+ p.density+ '</b><br />'+ '</b>PDP<br />'  + '<b> Positif : '+ p.density+ '</b><br />'
     : 'Sebaran Semua Kasus per Kecamatan');
  };

  info.addTo(map);


  // get color depending on population density value
  function getColor(d) {
    return d > 1000 ? '#800026' :
        d > 500  ? '#BD0026' :
        d > 200  ? '#E31A1C' :
        d > 100  ? '#FC4E2A' :
        d > 50   ? '#FD8D3C' :
        d > 20   ? '#FEB24C' :
        d > 10   ? '#FED976' :
              '#FFEDA0';
  }

  function style(feature) {
    return {
      weight: 2,
      opacity: 1,
      color: 'white',
      dashArray: '3',
      fillOpacity: 0.7,
      fillColor: getColor(feature.properties.density)
    };
  }

  function highlightFeature(e) {
    var layer = e.target;

    layer.setStyle({
      weight: 5,
      color: '#666',
      dashArray: '',
      fillOpacity: 0.7
    });

    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
      layer.bringToFront();
    }

    info.update(layer.feature.properties);
  }

  var geojson;

  function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
  }

  function zoomToFeature(e) {
    map.fitBounds(e.target.getBounds());
  }

  function onEachFeature(feature, layer) {
    layer.on({
      mouseover: highlightFeature,
      mouseout: resetHighlight,
      click: zoomToFeature
    });
  }

  geojson = L.geoJson(statesData, {
    style: style,
    onEachFeature: onEachFeature
  }).addTo(map);

  map.attributionControl.addAttribution('Population data &copy; <a href="http://census.gov/">US Census Bureau</a>');


  var legend = L.control({position: 'bottomright'});

  legend.onAdd = function (map) {

    var div = L.DomUtil.create('div', 'info legend'),
      grades = [0, 10, 20, 50, 100, 200, 500, 1000],
      labels = [],
      from, to;

    for (var i = 0; i < grades.length; i++) {
      from = grades[i];
      to = grades[i + 1];

      labels.push(
        '<i style="background:' + getColor(from + 1) + '"></i> ' +
        from + (to ? '&ndash;' + to : '+'));
    }

    div.innerHTML = labels.join('<br>');
    return div;
  };

  legend.addTo(map);


</script>
    </div>
    </section>
    
         