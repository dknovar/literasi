@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code')

<h1>
    Oops!</h1>
<h2>
    404 Not Found</h2>
<div class="error-details">
    Sorry, an error has occured, Requested page not found!
</div>
<div class="error-actions">
    <a href="/login" class="btn btn-primary"><span class="fa fa-home"></span>
        Take Me Home </a>
</div>


@endsection
