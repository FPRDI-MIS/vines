@extends('layouts.app')

@section('content')
    @include('inc.messages')
    <div class='container'>
    <table>
        <hr>
        <tr><h5>Scientific Name:</h5> <h2><i>{{ $vine->sci_name }}</i></h2>
        <h5>Common Name:</h5> <h2>{{ $vine->com_name }}</h2>
        <h5>Local name:</h5> <h2>{{ $vine->loc_name }}</h2>
        <h5>Family:</h5> <h2>{{ $vine->family }}</h2>
        <h5>Genus:</h5> <h2>{{ $vine->genus }}</h2>
        <h5>Species:</h5> <h2>{{ $vine->species }}</h2>
        <h5>Author's Name:</h5> <h2>{{ $vine->auth_name }}</h2></tr>
        
    </table>
        <br><br>
        <hr>
        <h4>Description</h4>
        <p>{!! $vine->description !!}</p>
        <hr>
        <h4>Comments</h4>
        <p>{{ $vine->comments }}</p>
        <form action="{{ route('vines-destroy', $vine->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" name="button" class="btn btn-danger float-right">DELETE</button>
        </form>
        <a href="{{ route('vines-edit', $vine->id) }}" class="btn btn-success">Edit</a>
        <a href="{{ route('vines-index', $vine->id) }}" class="btn btn-secondary">Back</a>
        <hr>
        <img src="/storage/vines/{{ $vine->sci_name }}/{{ $vine->photo }}" alt="{{ $vine->photo }}" width="700px" height="700px">
        <hr>

        @if (count ($vine->pictures) > 0)
            @foreach ($vine->pictures as $picture)
            <img src="/storage/pictures/{{ $picture->vine_id}}/{{ $picture->image }}" alt="{{ $picture->image }}" width="700px" height="700px">
            @endforeach

        @else
            <h3>No other photos. Click button to upload additional photos</h3>
        @endif

        <hr>
        <a href="{{ route('pictures-create', $vine->id) }}" class="btn btn-primary">Add more photos</a>
        
    </div>

@endsection