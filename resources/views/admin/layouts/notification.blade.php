@if (count($errors)>0)
    <ul class="alert alert-danger mt-3">
        @foreach($errors->all() as $error)
            <li class="ml-3">{{ $error}}</li>
        @endforeach
    </ul>
@endif