@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>x</span>
            </button>
            <p>{{ $message }}</p>
        </div>
    </div>

@endif
