@extends('layouts.app')

@section('content')


<style>

.masthead {
  background-image: linear-gradient(90deg, rgba(220,178, 78, 0.1) 0px, rgba(220,178, 78, 0.1) 100%), url("/img/about.jpg");
}

.bg-transparency {
  background: linear-gradient(90deg, rgba(255, 255, 255, 0.6) 0px, rgba(255,255,255, 0.6) 100%);
}

</style>


  <!-- Header -->
    <header class="masthead d-flex">
        <div class="container text-center my-auto bg-transparency">
            <h1 class="mb-1">Stylish Portfolio</h1>
            <h3 class="mb-5">
                <em>Ecco chi siamo e cosa facciamo</em>
                
                    <a href="{{route('index')}}">Back</a>
            </h3>

            <form action="{{route('contacts.submit')}}" method="post">
                @csrf
                <div class="row mb-2">
                    <div class="col">
                        <input type="text" value="{{ old('name') }}" name="name" class="form-control" placeholder="Nome">
                    </div>
                    <div class="col">
                        <input type="text" name="surname" class="form-control" placeholder="Cognome">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <input type="email" name="email" class="form-control" placeholder="email@email.com">
                    </div>
                    <div class="col">
                        <input type="phone" name="phone" class="form-control" placeholder="email@email.com">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <strong>Messaggio:</strong><br>
                        <textarea name="message" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <button type="submit" class="btn btn-primary btn-xl">Invia</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="overlay"></div>
    </header>

  <!-- About -->
  <section class="content-section bg-light" id="about">
    <div class="container text-center">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <h2>Stylish Portfolio is the perfect theme for your next project!</h2>
          <p class="lead mb-5">This theme features a flexible, UX friendly sidebar menu and stock photos from our friends at!</p>
          <a class="btn btn-dark btn-xl js-scroll-trigger" href="{{route('index')}}">What We Offer</a>
        </div>
      </div>
    </div>
  </section>

 


@endsection
