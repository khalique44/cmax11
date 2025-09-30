{{-- Language Section --}}
<div class="index-lang">
    <div class="dropdown" style="float: right; margin-top: 22px;">
        <button class="dropdown-toggle" type="button" data-toggle="dropdown">
            @if(Config::get('app.locale') == 'en')
                <img src="{{ url('public/assets/images/flags/en.png') }}">
            @elseif(Config::get('app.locale') == 'jp')
                <img src="{{ url('public/assets/images/flags/jp.png') }}">
            @elseif(Config::get('app.locale') == 'kr')
                <img src="{{ url('public/assets/images/flags/kr.jpg') }}">
            @else
                <img src="{{ url('public/assets/images/flags/ar.png') }}">
            @endif
            <span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li><a class="lang" href="{{ url('language/en') }}" id="en">English<img src="{{ url('public/assets/images/flags/en.png') }}"></a></li>
            <li><a class="lang" href="{{ url('language/jp') }}" id="jp">Japanese<img src="{{ url('public/assets/images/flags/jp.png') }}"></a></li>
            <li><a class="lang" href="{{ url('language/kr') }}" id="kr">Korean <img src="{{ url('public/assets/images/flags/kr.jpg') }}"></a></li>
            <li><a class="lang" href="{{ url('language/ar') }}" id="ar">Arabic <img src="{{ url('public/assets/images/flags/ar.png') }}"></a></li>
        </ul>
    </div>
</div>
{{-- End Language Section --}}

