@extends('default')
@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Update News</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
            @endif
            <form method="post" action="{{ route('news.update', $news->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group">

                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" value={{ $news->title }} />
                </div>

                <div class="form-group">
                    <label for="body">Body:</label>
                    <input type="text" class="form-control" name="body" value={{ $news->body }} />
                </div>

                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" name="image" class="form-group"/>
                    <img src="{{ URL::to('/') }}/images/{{ $news->image }}" class="img-thumbnail" width="100" />
                    <input type="hidden" name="hidden_image" value="{{ $news->image }}" />
                </div>
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" class="form-control" name="data" value={{ $news->data }} />
                </div>
                <div class="form-group">
                    <label for="Tags">Tags:</label>
                        <input type="text" class="form-control" value="@foreach($news->tags as $pop) {{$pop->name}} @endforeach" name="tags">
                </div>
                <div class="form-group">
                    <label for="select_tags">Select Tags:</label>
                    <select multiple class="form-control" name="tags[]">
                       @foreach($tags as $value) <option value="{{$value->id}}">{{$value->name}}</option>
                           @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a style="margin: 19px;" href="{{ route('news.tagsDel', $news->id) }}" class="btn btn-primary">Delete Tags</a>
            </form>
        </div>
    </div>
@endsection
