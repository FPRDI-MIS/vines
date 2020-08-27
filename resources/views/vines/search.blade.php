@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Search Results</h2>
</div>

<div class="container">


@if(count($vine) != 0 )

    <table class='table'>
        <table class="table table-striped">
            <tr><h4>Scientific Name</h4></tr>
        @foreach($vine as $vines)
            <tr>
            <td><img src="/storage/vines/{{ $vines->sci_name }}/{{ $vines->photo }}" width="70px" height="70px">&nbsp;&nbsp;
                 <a h3 style="font-size:200%" href="{{ route('vines-show', $vines->id) }}"> {{ $vines->sci_name }}</a>
            </tr>
        @endforeach
        {{ $vine->links( )}}
    </table>
@else
    <p><h3>No results found. Please try a different instance!</h3></p>
@endif

</div>

@endsection