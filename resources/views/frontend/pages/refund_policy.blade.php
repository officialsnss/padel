@extends('frontend.layouts.app')

@section('content')
    <div class="mid-area-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @foreach ($rps as $rp)
                        <h1 class="text-center mb-4">
                            @if (App::getLocale() == 'ar')
                                {{ $rp->title_arabic }}
                            @else
                                {{ $rp->title }}
                            @endif
                        </h1>
                        @if (App::getLocale() == 'ar')
                            {!! $rp->content_arabic !!}
                        @else
                            {!! $rp->content !!}
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
