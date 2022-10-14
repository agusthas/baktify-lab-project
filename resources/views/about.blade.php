@extends('layouts.app')

@section('content')
    <div>
        <div class="container mb-4">
            <section>
                <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                    <div class="col-10 col-sm-8 col-lg-6">
                        <img src="/img/about-image.jpg" class="d-block mx-lg-auto img-fluid rounded-2"
                             alt="Bootstrap Themes"
                             width="700" height="500" loading="lazy">
                    </div>
                    <div class="col-lg-6">
                        <h1 class="display-5 fw-bold lh-1 mb-3">About us</h1>
                        <p class="lead text-muted">{{ $company_bs }}</p>
                        <p>-- {{ $company_ceo }}</p>
                    </div>
                </div>
            </section>
        </div>
        <div class="bg-light">
            <div class="container py-4">
                <section>
                    <h2 class="mb-2 lh-1 mt-4">Get in touch</h2>
                    <div class="row">
                        @foreach($inquirers as $inquirer)
                            <div class="col-sm-6 col-lg-3">
                                <img src="" alt="">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="{{ $inquirer['image'] }}" alt="avatar"
                                             class="img-thumbnail rounded-circle mb-3"
                                             width="80">
                                        <h5 class="card-title">{{ $inquirer['name'] }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $inquirer['email'] }}</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $inquirer['phone'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section>
                    <h2 class="mb-2 lh-1 mt-4">Our locations</h2>
                    <div class="row">
                        @foreach($locations as $location)
                            <div class="col-sm-6">
                                <img src="" alt="">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $location['city'] }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $location['address'] }}</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $location['postal_code'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
@endsection
