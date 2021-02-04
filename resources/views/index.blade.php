@extends('layouts.app')

@section('content')


<style>

.masthead {
  background-image: linear-gradient(90deg, rgba(220,178, 78, 0.1) 0px, rgba(220,178, 78, 0.1) 100%), url("/img/beer1.jpg");
}

.bg-transparency {
  background: linear-gradient(90deg, rgba(255, 255, 255, 0.6) 0px, rgba(255,255,255, 0.6) 100%);
}

#segnala {
  background: linear-gradient(90deg, rgba(255, 255, 255, 0.1) 0px, rgba(255,255,255, 0.1) 100%);
}

#segnala .container {
  color: black;
}

</style>

  <!-- Header -->
  <header class="masthead d-flex">
    <div class="container-fluid text-center my-auto bg-transparency pt-3">
      <h1 class="mb-1">Segnala la tua birreria preferita!</h1>
      <h3 class="mb-5">
        <em>Sicuramente il gestore ti offrirà una birra!</em>
      </h3>

      <form action="{{ route('search') }}" method="GET" class="mb-5">
        <input type="text" name="q" style="width: 500px;" placeholder="search">
        <button type="submit" class="btn btn-danger">Ricerca</button>
      </form>
      
      <a class="btn btn-primary btn-xl js-scroll-trigger mb-4" href="#about">Find Out More</a>
    </div>
    <div class="overlay"></div>
  </header>

  <!-- About -->
  <section class="content-section bg-light" id="about">
    <div class="container text-center">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <h2>Grazie al nostro progetto potrai trovare la tua birra preferita in ogni città!</h2>
          <p class="lead mb-5">il nostro sistema di classificazione birre e ricerca ti stupirà. Vai all'elenco delle
            <a href="{{ route('breweries') }}">Birrerie</a>!</p>
          <a class="btn btn-dark btn-xl js-scroll-trigger" href="#segnala">Segnala la tua birreria preferita</a>
        </div>
      </div>
    </div>
  </section>
    
  <!-- Services -->
  <section class="content-section bg-primary text-white text-center" id="services">
    <div class="container">
      <div class="content-section-heading">
        <h3 class="text-secondary mb-0">Services</h3>
        <h2 class="mb-5">What We Offer</h2>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
          <span class="service-icon rounded-circle mx-auto mb-3">
            <i class="icon-screen-smartphone"></i>
          </span>
          <h4>
            <strong>Responsive</strong>
          </h4>
          <p class="text-faded mb-0">Looks great on any screen size!</p>
        </div>
        <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
          <span class="service-icon rounded-circle mx-auto mb-3">
            <i class="icon-pencil"></i>
          </span>
          <h4>
            <strong>Redesigned</strong>
          </h4>
          <p class="text-faded mb-0">Freshly redesigned for Bootstrap 4.</p>
        </div>
        <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
          <span class="service-icon rounded-circle mx-auto mb-3">
            <i class="icon-like"></i>
          </span>
          <h4>
            <strong>Favorited</strong>
          </h4>
          <p class="text-faded mb-0">Millions of users
            <i class="fas fa-heart"></i>
            Start Bootstrap!</p>
        </div>
        <div class="col-lg-3 col-md-6">
          <span class="service-icon rounded-circle mx-auto mb-3">
            <i class="icon-mustache"></i>
          </span>
          <h4>
            <strong>Question</strong>
          </h4>
          <p class="text-faded mb-0">I mustache you a question...</p>
        </div>
      </div>
    </div>
  </section>


  <section class="content-section bg-primary text-white text-center" id="segnala">
      
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </div>
                  @endif
      
        <div class="container">
            <form action="{{route('breweries.notify')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-2">
                    <div class="col">
                        <strong>Nome:</strong><br>
                        <input type="text" name="name" class="form-control" placeholder="Nome">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <strong>Descrizione:</strong><br>
                        <textarea name="description" class="form-control" id="" cols="30" rows="3"></textarea>
                    </div>
                </div>
                    <div class="col">
                        <strong>Immagine pub:</strong><br>
                        <input type="file" name="img">
                    </div>
                <div class="row mb-2">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-xl">Invia</button>
                    </div>
                </div>
            </form>
        </div>
    
    </section>


@endsection