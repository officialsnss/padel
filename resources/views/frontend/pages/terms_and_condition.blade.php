@extends('frontend.layouts.app')

@section('content')
    <div class="mid-area-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @foreach ($tncs as $tnc)
                        <h1 class="text-center mb-4">
                            @if (App::getLocale() == 'ar')
                                {{ $tnc->title_arabic }}
                            @else
                                {{ $tnc->title }}
                            @endif
                        </h1>
                        @if (App::getLocale() == 'ar')
                            {!! $tnc->content_arabic !!}
                        @else
                            {!! $tnc->content !!}
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
