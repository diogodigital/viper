<div class="header-box">
    <div class="header-title">
        <i class="{{ $icon }}" style="font-size: 23px;margin-right: 10px;color: #65cb24;"></i>
        <h4>{{ $title }}</h4>
    </div>
    <div>
        <a href="{{ $link }}">@if(isset($labelLink)) {{ $labelLink }} @else Ver todos @endif <i class="fa-regular fa-chevron-right"  style="font-size: 18px;margin-left: 10px;color: #65cb24;"></i></a>
    </div>
</div>
