@extends('default')
@section('content')
    <div>
        <a style="margin: 19px;" href="{{ route('news.create')}}" class="btn btn-primary">Add News</a>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">News</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Title</td>
                    <td>Body</td>
                    <td>Image</td>
                    <td>Data</td>
                    <td>Tags</td>
                </tr>
                </thead>
                <tbody>
                @foreach($news as $value)
                    <tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->title}}</td>
                        <td>{{$value->body}}</td>
                        <td><img src="{{ URL::to('/') }}/images/{{ $value->image }}" class="img-thumbnail" width="75" /></td>
                        <td>{{$value->data}}</td>
                        <td>@foreach($value->tags as $pop)
                                {{$pop->name}}
                                @endforeach
                        </td>
                        <td>
                            <a href="{{ route('news.edit',$value->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('news.destroy', $value->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
                <div class="col-sm-12">

                    @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                </div>
            </div>
    @endsection
