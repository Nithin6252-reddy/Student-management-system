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
  <h1>Add new Student</h1>
  <div class="float-right mr-5" >
      <a href="" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Student</a>
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
                        <td>Name</td>
                        <td>Image</td>
                        <td>Phone</td>
                        <td>Course_Name</td>
                        <td>Batch_Time</td>
                        <td>Teaching _Day</td>

                        <td>Edit</td>
                        <td>Delete</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $c)
                    <tr>
                        <td>{{$c->id}}</td>
                        <td>{{$c->name}}</td>
                        
                        <td><img src="{{asset('uploaded_img')}}/{{{$c->img}}}" alt="" height='150' width='150'></td>
                        <td>{{$c->phone}}</td>
                        <td>{{$c->myCourse[0]->Course_Name}}</td>
                        <td>{{$c->myCourse[0]->Batch_Time}}</td>
                        <td>{{$c->myCourse[0]->Teaching_Day}}</td>
                        <td><a href="javascript:void(0)" data-id="{{$c->course_id}}" class="btn btn-warning showEditModal">Edit</a></td>
        
                        <td>
                        <form action="student/{{$c->id}}" method="POST">
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
        <h4 class="modal-title" >Add Student</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="student" method="POST" id="form" enctype='multipart/form-data'>
            @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="">Image</label>
                <input type="file" name="img" id="img" class="form-control">
            </div>

            <div class="form-group">
                <label for="">course_id</label>
                <!-- <input type="text" name="course_id" id="course_id" class="form-control"> -->
                <select name="course_id" id="course_id" class="form-control">
                <option  selected disabled></option>
                    @foreach($course as $cse)
                     <option value="{{$cse->id}}">{{$cse->Course_Name}}</option>


                    @endforeach
                    <option value=""></option>
                </select>
            </div>
            

            <div class="form-group">
                <input type="submit" id="submit" class="form-control btn btn-success" value="Add Student">
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
        course_id = e.target.parentElement.previousElementSibling.innerText;        
        phone = e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText;       
        name = e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText;     
        id = e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText;
        course_id = e.target.getAttribute('data-id');
        console.log(id);   
        
        // console.log(course_id + phone + name + id);

        $('#course_id').val(course_id);
        $('#phone').val(phone);
        $('#name').val(name);
        $('#submit').val("Edit Student");
        $('.modal-title').text("Edit Student");
        $('form').attr('action', 'student/'+id);
        $('form').append('<input type="hidden" name="_method" value="PUT">')

        



        $('#myModal').modal('show');
    })
</script>
</body>
</html>
