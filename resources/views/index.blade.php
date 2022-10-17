@extends('layouts.app')

@push('styles')
    <style>
        .featurette-divider {
            margin: 5rem 0;
        }

        .featurette-heading {
            font-weight: 300;
            line-height: 1;
            /* rtl:remove */
            letter-spacing: -.05rem;
        }

        @media (min-width: 40em) {
            .featurette-heading {
                font-size: 50px;
            }
        }

        @media (min-width: 62em) {
            .featurette-heading {
                margin-top: 7rem;
            }
        }
    </style>
@endpush

@section('content')
    {{-- Hero --}}
    <div class="pt-5 text-center">
        <h1 class="display-4 fw-bold">Level up your music connection</h1>
        <div class="container px-5">
            <img src="/img/level-up-music.jpg" class="img-thumbnail border rounded-3 shadow-sm mb-4 mt-2"
                 alt="Example image"
                 width="800" height="600" loading="lazy">
        </div>
        <div class="col-lg-5 mx-auto">
            <div class="fs-4 lh-1 fw-bold">One-stop store for all of your musical enthusiasm needs</div>
            <div class="text-muted">We provide wide variety of music genre and album</div>
        </div>
    </div>
    {{-- Featurette --}}
    <div class="container mt-5">
        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">100% Secure</h2>
                <p class="lead text-muted">We are proud to offer fast and professional delivery services with all major
                    payment methods available through our online shop. Additionally, if you require some flexibility
                    regarding payment, we provide finance options, so you can pay in instalments.</p>
            </div>
            <div class="col-md-5">
                <img src="/img/secure-illustration.svg" class="img-fluid mx-auto" alt=".." width="500"
                     height="500">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading">Bulk Ordering Makes it Possible</h2>
                <p class="lead text-muted">Through the large purchasing volumes, DV and Music Store are able to source
                    containers directly from manufactures worldwide allowing us to offer a large range of products at
                    sensationally low prices.</p>
            </div>
            <div class="col-md-5 order-md-1">
                <img src="/img/order-illustration.svg" class="img-fluid mx-auto" alt=".." width="500"
                     height="500">
            </div>
        </div>
    </div>
@endsection
