<div class="footer-wrap">
    <div class="container">
        <div class="row justify-content-between">
            @php
                $copyrights = \App\Models\Setting::where('type', '2')->get();
            @endphp
            @foreach ($copyrights as $copyright)
                @if ($copyright->value != '')
                    <div class="col-auto">{{ $copyright->value }}</div>
                @endif
            @endforeach

            <div class="col-auto term-policy"><a href="/pages/terms-and-condition">Terms & Condition</a> <a href="/pages/refund-policy">Refund Policy</a> <a href="/pages/privacy-policy">Privacy Policy</a></div>
            @php
                $extra_texts = \App\Models\Setting::where('type', '3')->get();
            @endphp
            @foreach ($extra_texts as $extra_text)
                @if ($extra_text->value != '')
                <div class="col-auto"><a href="https://www.design-master.com/" target="_blank">{{ $extra_text->value }}</a></div>
                @endif
            @endforeach
        </div>
    </div>
</div>
<input type="hidden" id="selectedLang" value="{{App::getLocale()}}">
