<div class="container d-flex justify-content-center align-items-center my-3">
    @php

        $desktopAdSizes = [
            ['width' => 970, 'height' => 250],
            ['width' => 970, 'height' => 90],
            ['width' => 728, 'height' => 90]
        ];

        $mobileAdSizes = [
            ['width' => 300, 'height' => 250],
            ['width' => 320, 'height' => 100],
            ['width' => 336, 'height' => 280]
        ];


        $isMobile = request()->header('User-Agent') && preg_match('/Mobile|Android|iPhone/i', request()->header('User-Agent'));


        $selectedAd = $isMobile ? $mobileAdSizes[array_rand($mobileAdSizes)] : $desktopAdSizes[array_rand($desktopAdSizes)];
    @endphp

    <div class="ad-container border border-secondary p-2 bg-light text-center"
         style="max-width: 100%; width: {{ $selectedAd['width'] }}px; height: {{ $selectedAd['height'] }}px; display: flex; align-items: center; justify-content: center;">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <ins class="adsbygoogle"
             style="display:inline-block; width:{{ $selectedAd['width'] }}px; height:{{ $selectedAd['height'] }}px;"
             data-ad-client="{{ env('GOOGLE_AD_CLIENT') }}"
             data-ad-slot="{{ env('GOOGLE_AD_SLOT') }}">
        </ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
</div>
