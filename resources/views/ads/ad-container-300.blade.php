<div class="container d-flex justify-content-center align-items-center my-3">
    @php
        $adSizes = [
            ['width' => 300, 'height' => 250],
            ['width' => 300, 'height' => 600],
            ['width' => 336, 'height' => 280],
            ['width' => 160, 'height' => 600],
            ['width' => 240, 'height' => 400],
            ['width' => 250, 'height' => 250]
        ];
        $selectedAd = $adSizes[array_rand($adSizes)];
    @endphp

    <div class="border border-secondary p-2 bg-light text-center"
         style="width: {{ $selectedAd['width'] }}px; height: {{ $selectedAd['height'] }}px; display: flex; align-items: center; justify-content: center;">
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
