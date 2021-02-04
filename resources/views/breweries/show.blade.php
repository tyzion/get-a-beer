@extends('layouts.app')

@section('content')


<style>

.masthead {
  background-image: linear-gradient(90deg, rgba(220,178, 78, 0.1) 0px, rgba(220,178, 78, 0.1) 100%), url("{{ Storage::url( $brewery->img ) }}");
}

.bg-transparency {
  background: linear-gradient(90deg, rgba(255, 255, 255, 0.6) 0px, rgba(255,255,255, 0.6) 100%);
}

</style>


  <!-- Header -->
  <header class="masthead d-flex">
    <div class="container text-center my-auto bg-transparency">
      <h1 class="mb-1">{{ $brewery->name }}</h1>
      <h3 class="mb-5">
        <em>{{ $brewery->description }}</em>
        
            <a href="{{route('breweries')}}">Back</a>
      </h3>
      <h4>Le nostre birre disponibili!</h4>
        @foreach($brewery->beers as $beer)
            <strong>
                {{$beer->name}} <br>
            </strong>
        @endforeach
      <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a>
    </div>
    <div class="overlay"></div>
  </header>

    @auth
        @if(Auth::user()->isAdmin)

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif

<div class="container">
    <h2>Modifica Birreria</h2>
    <form action="{{route('breweries.update', ['id' => $brewery->id])}}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row mb-2">
            <div class="col">
                <strong>Nome:</strong><br>
                <input type="text" value="{{ old('name', $brewery->name ) }}" name="name" class="form-control" placeholder="Nome">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <strong>Descrizione:</strong><br>
                <textarea name="description" class="form-control" id="" cols="30" rows="2">{{ old('description', $brewery->description ) }}</textarea>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <label for="lat">Latitude</label>
                <input type="text" id="lat" name="lat" class="form-control" value="{{ old('lat', $brewery->lat ) }}">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <label for="lon">Longitude</label>
                <input type="text" id="lon" name="lon" class="form-control" value="{{ old('lon', $brewery->lon ) }}">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <strong>Immagine pub:</strong><br>
                <input type="file" name="img">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <button type="submit" class="btn btn-primary btn-xl">Salva</button>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-sm-12">
            <form action="{{route('breweries.delete', ['id' => $brewery->id] )}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Elimina</button>
            </form>
        </div>
    </div>
</div>


    <div class="container">
        <h2>Associa Birre</h2>

        <div class="col-sm-4">
            <form action="{{ route('breweries.beers.sync', ['id' => $brewery->id ]) }}" method="post">
                @csrf

                <ul id="beers">
                    @foreach($brewery->beers as $beer)
                        <li>
                            {{ $beer->id }} - {{ $beer->name }}
                            <input type="hidden" name="beer_ids[]" value="{{ $beer->id }}">
                            <button type="button" class="btn btn-danger btn-xs remove_beer">Disassocia</button>
                        </li>
                    @endforeach
                </ul>

                <button class="btn btn-success btn-xl" type="submit">Associa</button>
            </form>
        </div>

        <div class="col-sm-8">
            RICERCA&nbsp;&nbsp;<input type="text" id="beersearch">
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Produttore</th>
                        <th scope="col">Stile</th>
                        <th scope="col">Grado Alcolico</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
            @foreach( $beers as $beer)
                <tbody>
                    <tr class="beer_row" index="{{ strtolower($beer->name) }}_{{ strtolower($beer->brewer) }} " style="display: none">
                        <th scope="row">{{ $beer->id }}</th>
                        <td>{{ $beer->name }}</td>
                        <td>{{ $beer->brewer }}</td>
                        <td>{{ $beer->style }}</td>
                        <td>{{ $beer->alcohol }}</td>
                        <td><button class="btn btn-success add_beer btn-sm" beer-id="{{ $beer->id }}" beer-name="{{ $beer->name }}">Aggiungi</button></td>
                    </tr>
                </tbody>
            @endforeach
            </table>
        </div>
    </div>

        @endif

        <div class="container">
            <h2>Commenta la birreria</h2>
            <form action="{{ route('breweries.comments.add', ['id' => $brewery->id]) }}" method='POST'>
                @csrf
                <div class="form-group row">
                    <label for="comment" class="col-sm-2 col-form-label">Commento</label>
                    <div class="col-sm-10">
                        <textarea name="comment" id="" cols="30" rows="2" class="form-control"> {{ old('comment') }}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button class="btn btn-primary btn-xl" type="submit">Invia Commento</button>
                    </div>
                </div>
            </form>
        </div>

    @endauth

    <section class="content-section" id="comments">
        <div class="container">
            <div class="content-section-heading text-center">
                <h3 class="text-secondary mb-0">Commenti</h3>
                <h2 class="mb-5">Scopri cosa pensano i nostri utenti della birreria <strong> {{ $brewery->name }}</strong></h2>
            </div>
            <div class="row no-gutters">
                @foreach( $brewery->comments as $comment)
                <div class="col-lg-6">
                    <div class="p-3 mb-2 bg-primary text-white">
                        <span class="caption">
                            <span class="caption-content">
                                <h2>{{ $comment->user->name }}</h2>
                                <p class="mb-0">{{ $comment->comment }}</p>
                            </span>
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

 
  <!-- Map -->
  <section id="contact" class="map">
      
    <div id="brewery-map" class="img-fluid w-100" style="height: 500px;"
    lat = "{{ $brewery->lat }}"
    lon = "{{ $brewery->lon }}"
    name = "{{ $brewery->name }}"
    description = "{{ $brewery->description }}"
    >
    </div>
  </section>

  
  @endsection


  @push('scripts')

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5EZjG7bdVkAABUov-iWHMA7OvUeud3H4"></script>

    <script>

        $(function(){

            $("#beersearch").on('keyup', function(){
                let value = $(this).val();

                if(value.length <= 3){
                $(".beer_row").hide();
                    return;
                }

                value = value.toLowerCase();

                $(".beer_row").hide();

                $('[index*="' + value + '"]').show();
            });

            function attachRemoveBeer(){
                $(".remove_beer").on('click', function(){
                    $(this).parent().remove();
                });
            }


            $(".add_beer").on('click', function(){
                let beer_id = $(this).attr('beer-id');
                let beer_name = $(this).attr('beer-name');

                let beers = $("#beers");

                let html =`
                <li>
                ${beer_id} - ${beer_name} 
                <input type="hidden" name="beer_ids[]" value="${beer_id}">
                <button class="btn btn-danger btn-xs remove_beer" type="button">Disassocia</button>
                </li>
                `;

                beers.append(html);

                attachRemoveBeer();
            });

            attachRemoveBeer();
        
    });





        $(function(){
            let brewery_map = $("#brewery-map");

            if (! brewery_map) {
                return;
            }

            let lat = brewery_map.attr('lat');
            let lon = brewery_map.attr('lon');

            if (! lon || ! lat ){
                return;
            }

            let position = new google.maps.LatLng(lat, lon);

            let map = new google.maps.Map(
                document.getElementById('brewery-map'),
                {center: position, zoom:18}
            );

            let marker = new google.maps.Marker({
                position: position,
                icon: '/img/beer_here.png',
                map: map,
            });

            let name = brewery_map.attr('name');
            let description = brewery_map.attr('description');
            let infowindow = new google.maps.InfoWindow({
                content: '<strong>' + name + '</strong><br><i>' + description + '</i>'
            });

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
            
        });
    </script>

    @endpush
