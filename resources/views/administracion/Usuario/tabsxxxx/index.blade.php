<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if(isset($todoxxxx["conperfi"]))
            @include($todoxxxx["rutacarp"].'tabsxxxx.conperfil')
            @else
            @include($todoxxxx["rutacarp"].'tabsxxxx.sinperfil')
            @endif
        </div>
    </div>
</section>

@endsection
