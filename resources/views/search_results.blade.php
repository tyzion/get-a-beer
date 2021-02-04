@extends('layouts.app')

@section('content')



  <!-- Portfolio -->
  <section class="content-section" id="portfolio">
    <div class="container">
      <div class="content-section-heading text-center">
        <h3 class="text-secondary mb-0">Portfolio</h3>
        <h2 class="mb-5">Risultati ricerca per: {{ $q }}</h2>
      </div>

      <div class="row no-gutters">
        @foreach($breweries as $brewery)
        <div class="col-lg-6">
          <a class="portfolio-item" href="{{ route( 'breweries.show', ['id' => $brewery->id]) }}">
            <div class="caption">
              <div class="caption-content">
                <div class="h2">{{ $brewery->name }}</div>
                <p class="mb-0">{{ $brewery->description }}</p>
                <p>
                  @foreach($brewery->beers as $beer)
                      <i>
                          {{$beer->name}} <br>
                      </i>
                  @endforeach
                </p>
                
                <p>
                Commenti: {{ $brewery->comments->count() }}
                </p>

              </div>
            </div>
            <img class="img-fluid" src="{{Storage::url( $brewery->img) }}" alt="{{ $brewery->name }}">
          </a>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Map -->
  <section id="contact" class="map">
      
      <div id="all-breweries-map" class="img-fluid w-100" style="height: 500px;"
      breweries = "{{ $breweries }}"
      >
      </div>
    </section>
  
@endsection


@push('scripts')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5EZjG7bdVkAABUov-iWHMA7OvUeud3H4"></script>

<script>

  $(function(){

  let brewery_map = $("#all-breweries-map");

  if( ! brewery_map){
    return;
  }

  //Json.parse -> array di oggetti!!!
  let breweries = JSON.parse(brewery_map.attr('breweries'));

  if(! breweries && breweries.length <= 0){
    return;
  }

  function hasLatLon(brewery){
    return brewery.lat && brewery.lat != 0 && brewery.lon && brewery.lon != 0;
  }

  breweries = breweries.filter(hasLatLon);

  var bounds = new google.maps.LatLngBounds();
  breweries.forEach(brewery => {
    let position = new google.maps.LatLng(brewery.lat, brewery.lon);
    bounds.extend(position);
  });

  let center_position = bounds.getCenter();

  let map = new google.maps.Map(
    document.getElementById('all-breweries-map'),
    {center: center_position, zoom: 17}
  );

  breweries.forEach(brewery => {
    let position = new google.maps.LatLng(brewery.lat, brewery.lon);

    let marker = new google.maps.Marker({
      position: position,
      icon: '/img/beer_here.png',
      map: map,
    });

    let infowindow = new google.maps.InfoWindow({
        content: '<strong>' + brewery.name + '</strong><br><i>' + brewery.description + '</i>'
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });
    
  });  
  
});
  

</script>
@endpush