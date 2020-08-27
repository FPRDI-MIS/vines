@extends('layouts.app')


@section('content')
    <div class="container">
        <h2>Add more photos for {{$vine->sci_name}}</h2>
        @include('inc.messages')
        <form method="post" action="{{ route('pictures-store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="vine_id" value="{{ $vineId }}">

                <!-- Form for uploading primary photo -->   
                 <div class="form-group">
                    <label for="picture">Upload image</label>
                    <input type="file" class="form-control" name="picture" id="picture">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                
        </form>
    </div>
@endsection