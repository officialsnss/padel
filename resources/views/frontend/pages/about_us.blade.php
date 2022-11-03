@extends('frontend.layouts.app')

@section('content')
    <div class="mid-area-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @foreach ($abs as $ab)
                        <h1 class="text-center mb-4">
                            @if (App::getLocale() == 'ar')
                                {{ $ab->title_arabic }}
                            @else
                                {{ $ab->title }}
                            @endif
                        </h1>
                        @if (App::getLocale() == 'ar')
                            {!! $ab->content_arabic !!}
                        @else
                            {!! $ab->content !!}
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
