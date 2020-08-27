@extends('layouts.app')

@section('content')
    @include('inc.messages')
    <div class='container'>
        <h1 class="AlbumTilte"><strong>FPRDI Vines</h1>
        <p class="lead text-muted">Vines system description</p>
    </div>

    @if (count ($vine) > 0)
        <div class='container'>
            <div class="row row-cols-1 row-cols-md-4" >
                    @foreach ($vine as $vines)
                        <div class="col-md-4" style="27rem">
                            <div class="card mb-4 box-shadow h-50 w-100">
                                <img src="/storage/vines/{{ $vines->sci_name }}/{{ $vines->photo }}" alt="{{ $vines->photo }}" height="200px" >
                                <div class="card-body">
                                    <p class="card-text"><i>{{ $vines->sci_name }}</i></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <medium class="text-muted">{{ $vines->loc_name }}</medium>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('vines-show', $vines->id) }}" class="btn btn-sm btn-outline-success">View</a>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
    @else
        <div class='container'>
            <h3>No entries yet.</h3>
        </div>      
    @endif

@endsection