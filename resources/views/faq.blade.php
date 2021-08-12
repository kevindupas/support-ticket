@extends('layouts.auth')
@section('page-title')
    {{ __('FAQ') }}
@endsection
@section('action-button')
    <div class="text-right my-5">
        <a href="{{route('home')}}" class="btn-submit">{{ __('Create Ticket') }}</a>
    </div>
@endsection
@section('content')

    <div class="col-lg-12 col-md-12">
        <div class="card bg-secondary border-0 mb-0 mt-6">
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                    <h2 class="mb-3 text-18">{{ __('FAQ') }}</h2>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if($faqs->count())
                            <div id="faq-accordion" class="accordion accordion-spaced">
                                @foreach($faqs as $index => $faq)
                                    <div class="card">
                                        <div class="card-header py-4" id="heading-{{ $index }}" data-toggle="collapse" role="button" data-target="#collapse-{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse-{{ $index }}">
                                            <h6 class="mb-0">{{ $faq->title }}</h6>
                                        </div>
                                        <div id="collapse-{{ $index }}" class="collapse @if($index == 0) show @endif" aria-labelledby="heading-{{ $index }}" data-parent="#faq-accordion">
                                            <div class="card-body">
                                                <p class="mb-0">{!! $faq->description !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title mb-0 text-center">{{ __('No Faqs found.') }}</h6>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
