<!-- Success/ Errors -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <h5>Success!</h5>
        <ul>{{ session('success') }}</ul>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-warning alert-dismissible">
        <h5>Error!</h5>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- Success/ Errors End -->
