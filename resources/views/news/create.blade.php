@extends('default')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add News</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <form method="post" action="{{ route('news.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" name="title" required/>
                    </div>

                    <div class="form-group">
                        <label for="body">Body:</label>
                        <input type="text" class="form-control" name="body" required/>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags:</label>
                        <select multiple name="tags[]" class="form-group">
                        @foreach($tags as $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" name="data" required/>
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" name="image" class="form-group"/>
                    </div>
                    <button type="submit" class="btn btn-primary-outline">Add News</button>
                </form>
                    <form method="post" id="tags" action="{{ route('news.tags') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group"><br>
                            <label for="new_tag">New Tag:</label>
                            <input type="text" class="form-control" name="new_tags" required/>
                        </div>
                        <button form="tags" type="submit" class="btn btn-primary-outline">Add New Tag</button>
                    </form>
            </div>
        </div>
    </div>
@endsection
