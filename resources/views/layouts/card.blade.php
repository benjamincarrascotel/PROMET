{{-- @section('content') --}}
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@yield('card_title')</h3>
            </div>
            <div class="card-body">
                @yield('card_content')
            </div>
        </div>
    </div>
</div>
{{-- @endsection('content') --}}
