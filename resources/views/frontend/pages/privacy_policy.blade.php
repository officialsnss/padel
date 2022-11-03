@extends('frontend.layouts.app')

@section('content')
    <div class="mid-area-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @foreach ($pps as $pp)
                        <h1 class="text-center mb-4">
                            @if (App::getLocale() == 'ar')
                                {{ $pp->title_arabic }}
                            @else
                                {{ $pp->title }}
                            @endif
                        </h1>
                        @if (App::getLocale() == 'ar')
                            {!! $pp->content_arabic !!}
                        @else
                            {!! $pp->content !!}
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
