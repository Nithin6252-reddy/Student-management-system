<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>Add new Course</h1>
  <div class="float-right mr-5" >
      <a href="" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Course</a>
  </div>
</div>
  
<div class="container-fluid">

   <div class="row">
   @include('sidebar')

       <div class="col-10">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <td>id</td>
                        <td>Course_Name</td>
                        <td>Teacher_Name</td>
                        <td>Batch_Time</td>
                        <td>Teaching_Day</td>
                        <td>Edit</td>
                        <td>Delete</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $c)
                    <tr>
                        <td>{{$c->id}}</td>
                        <td>{{$c->Course_Name}}</td>
                        <td>{{$c->Teacher_Name}}</td>
                        <td>{{$c->Batch_Time}}</td>
                        <td>{{$c->Teaching_Day}}</td>
                        <td><a href="javascript:void(0)" class="btn btn-warning showEditModal">Edit</a></td>
        
                        <td>
                        <form action="course/{{$c->id}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
  
</div>




<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" >Add Course</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="course" method="POST" id="form">
            @csrf
            <div class="form-group">
                <label for="">Course_Name</label>
                <input type="text" name="Course_Name" id="Course_Name" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Teacher_Name</label>
                <input type="text" name="Teacher_Name" id="Teacher_Name" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Batch_Time</label>
                <input type="text" name="Batch_Time" id="Batch_Time" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Teaching_Day</label>
                <input type="text" name="Teaching_Day" id="Teaching_Day" class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" id="submit" class="form-control btn btn-success" value="Add Course">
            </div>
        </form>
      </div>

    </div>
  </div>
</div>


<script>

    $(document).ready( function() {
        $('#myTable').DataTable();
    } );


    $('.showEditModal').click(function(e){
        Teaching_Day = e.target.parentElement.previousElementSibling.innerText;
        Batch_Time = e.target.parentElement.previousElementSibling.previousElementSibling.innerText;        
        Teacher_Name = e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.innerText;       
        Course_Name = e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText;     
        id = e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText;   
        
        $('#Course_Name').val(Course_Name);
        $('#Batch_Time').val(Batch_Time);
        $('#Teaching_Day').val(Teaching_Day);
        $('#Teacher_Name').val(Teacher_Name);
        $('#submit').val("Edit Course");
        $('.modal-title').text("Edit Course");
        $('form').attr('action', 'course/'+id);
        $('form').append('<input type="hidden" name="_method" value="PUT">')

        



        $('#myModal').modal('show');
    })
</script>
</body>
</html>
