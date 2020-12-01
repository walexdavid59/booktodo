@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="..\create" title="Create a project"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    {{-- @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif --}}

    <table class="table table-bordered table-responsive-lg" id='userTable'>
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Author</th>
            <th>Descriotion</th>
            <th>Edit</th>
        </tr>
        @foreach ($books as $book)
        <tr>
            <tr>
                    <td>{{$book->id+=1}}</td>
                    <td>{{$book->title}}</td>
                    <td>{{$book->author}}</td>
                    <td>{{$book->description}}</td>
                    <td>cvcvc</td>
        </tr>
         @endforeach
        <tbody>
              </tbody>
      
    </table>

@endsection

<script src="http://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
</script>
 <script type='text/javascript'>
     $(document).ready(function(){


     function fetchRecords(id){
       $.ajax({
         url: 'api/books/'+id,
         type: 'post',
         dataType: 'json',
         success: function(response){
alert(response);
           var len = 0;
           $('#userTable tbody').empty(); // Empty <tbody>
           if(response['data'] != null){
              len = response['data'].length;
           }

           if(len > 0){
              for(var i=0; i<len; i++){
                 var id = response['data'][i].id;
                 var title = response['data'][i].title;
                 var author = response['data'][i].author;
                 var description = response['data'][i].description;

                 var tr_str = "<tr>" +
                   "<td align='center'>" + (i+1) + "</td>" +
                   "<td align='center'>" + title + "</td>" +
                   "<td align='center'>" + author + "</td>" +
                   "<td align='center'>" + description + "</td>" +
                 "</tr>";

                 $("#userTable tbody").append(tr_str);
              }
           }else{
              var tr_str = "<tr>" +
                  "<td align='center' colspan='4'>No record found.</td>" +
              "</tr>";

              $("#userTable tbody").append(tr_str);
           }

         }
       });
     }
     </script>