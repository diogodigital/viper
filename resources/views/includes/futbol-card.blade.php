<div class="futbol">
    <div class="fulbol-card">
        <a href="{{ url($url) }}">
            <div class="futbol-img overlay">
                <img src="{{ asset('storage/'.$cover) }}" alt="">
            </div>
            <div class="futbol-content ">
                <div class="box-1">
                    <div class="box-title">
                        {{ $title }}
                    </div>
                    <div class="box-action">
                        {{ $category }}
                    </div>
                </div>
                <div class="box-2">
                    <div class="futbol-result">
                        <div class="futbol-result-left">
                            {{ $result_team_a ?? '0' }}
                        </div>
                        <div class="futbol-result-right">
                            {{ $result_team_b ?? 0 }}
                        </div>
                    </div>
                </div>
                <div class="box-3">
                    <a href="{{ url($url) }}" class="futbol-team-flag">
                        <div class="futbol-team-flag-left">
                            <div class="futbol-team-flag-left-box-1">
                                <div style="width: 32px;height: 32px;">
                                    <img src="{{ $logo_team_a }}" alt="" height="32" width="32">
                                </div>
                            </div>
                            <div class="bt3733">{{ $title_team_a }}</div>
                        </div>
                        <div class="futbol-team-flag-right">
                            <div class="futbol-team-flag-left-box-2">
                                <div style="width: 32px;height: 32px;">
                                    <img src="{{ $logo_team_b }}" alt="" height="32" width="32">
                                </div>
                            </div>
                            <div class="bt3733">{{ $title_team_b }}</div>
                        </div>
                    </a>
                </div>
                <div class="box-4">
                    <div class="" style="position: relative; margin-top: 8px;">
                        <div class="bt3759">
                            <a href="{{ url($url) }}" class="btn-bet @if($istoday) is-today @endif">
                                @if($istoday)
                                    Hoje
                                @else
                                    {!! $date !!}
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
