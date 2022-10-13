<footer>
    <div class="padding-left-right">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @php

                        $copyrights = \App\Models\Setting::where('type', '2')->get();

                    @endphp
                    @foreach ($copyrights as $copyright)
                        @if ($copyright->value != '')
                            <p class="copyright">{{ $copyright->value }}</p>
                        @endif
                    @endforeach

                    @php

                        $extra_texts = \App\Models\Setting::where('type', '3')->get();

                    @endphp
                    @foreach ($extra_texts as $extra_text)
                        @if ($extra_text->value != '')
                            <p class="designed"><a href="https://designmasterevents.com" target="_blank">{{ $extra_text->value }}</a></p>
                        @endif
                    @endforeach
                    {{-- <p class="copyright">Copyright 2022-2023 - Tbaree. All Rights Reserved</p> --}}
                    {{-- <p class="designed">Managed by: <a href="https://designmasterevents.com" target="_blank">Design Master Events</a></p> --}}
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="selectedLang" value="{{App::getLocale()}}">

</footer>


