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

           <h1>Grazie per averci contattati</h1>
        </div>
        <div class="overlay"></div>
    </header>

  <!-- About -->
  <section class="content-section bg-light" id="about">
    <div class="container text-center">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <h2>Stylish Portfolio is the perfect theme for your next project!</h2>
          <p class="lead mb-5">This theme features a flexible, UX friendly sidebar menu and stock photos from our friends at
            <a href="{{route('index')}}">Unsplash</a>!</p>
          <a class="btn btn-dark btn-xl js-scroll-trigger" href="{{route('index')}}">What We Offer</a>
        </div>
      </div>
    </div>
  </section>

 


@endsection
