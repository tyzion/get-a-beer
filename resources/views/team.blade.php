@extends('layouts.app')

@section('content')


<style>

.masthead {
  background-image: linear-gradient(90deg, rgba(220,178, 78, 0.1) 0px, rgba(220,178, 78, 0.1) 100%), url("/img/team.jpg");
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
        <em>A Free Bootstrap Theme by Start Bootstrap</em>
        
            <h1>Team</h1>
            <a href="{{route('index')}}">Back</a>
      </h3>
      <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a>
    </div>
    <div class="overlay"></div>
  </header>

  <!-- About -->
  <section class="content-section bg-light" id="about">
    <div class="container text-center">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <h2>Here's our fantastic team!</h2>

          <div class="container">
            <div class="row">
                @foreach($members as $member)
                    <div class="col-lg-3">
                        <strong>{{ $member['name'] }}</strong>
                        <img src=" {{ $member['img'] }} " alt="{{ $member['name'] }}" class="img-fluid">
                        <i>{{ $member['role'] }}</i>
                    </div class="col-lg-4">
                @endforeach
            </div>
          </div>
          <p class="lead mb-5">Each one of us is a passionate beer trinker!</p>
          <a class="btn btn-dark btn-xl js-scroll-trigger" href="{{route('index')}}">What We Offer</a>
        </div>
      </div>
    </div>
  </section>

 


@endsection
