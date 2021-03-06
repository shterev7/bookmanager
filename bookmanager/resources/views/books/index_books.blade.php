@extends('welcome')
@section('content')

    <div class="container">

        <form method="GET" action="{{url('/books/search')}}">
            <div class="form-group row">
                <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg"></label>
                <div class="col-sm-10">
                <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" name="q" placeholder="Search books" />
                    <br>
                <input type="submit" class="btn btn-primary" value="Search" />
                </div>
            </div>
        </form>
        <br>

        <form method="post" action="{{url('books')}}">
            <div class="form-group row">
                {{csrf_field()}}
                <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-lg" id="lgFormGroupInput" placeholder="title" name="title">
                </div>
            </div>
            <div class="form-group row">
                {{csrf_field()}}
                <label for="lgFormGroupInput" class="col-sm-2 col-form-label col-form-label-lg">Author</label>
                <div class="col-sm-10">
                    <select id="author" name="author_id">
                        <option value="Z">Select an author</option>
                        @foreach ($authors as $author)
                        <option value="{{$author->id}}">{{$author->firstname}} {{$author->lastname}}</option>
                        @endforeach
                    </select>
                    <input type="submit" class="btn btn-primary" value="Create" />
                </div>
            </div>

        </form>
    </div>
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
            </tr>
            </thead>
            <tbody>
           @foreach($result as $book)
                <tr>
                    <td>{{$book->id}}</td>
                    <td>{{$book->title}}</td>
                    <td>{{$book->author->firstname}} {{$book->author->lastname}}</td>
                    <td><a href="{{action('BooksController@edit', $book->id)}}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form action="{{action('BooksController@destroy', $book->id)}}" method="post">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                    <td><a href="{{action('ReviewsController@store', $book->id)}}" class="btn btn-primary">Review</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
 @endsection