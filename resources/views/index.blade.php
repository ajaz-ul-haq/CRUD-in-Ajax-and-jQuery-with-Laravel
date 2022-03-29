<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body style="padding-top: 40px">

{{-- Add Student Modal--}}
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Student Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="errors" role="alert">

                </div>
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input name="name" id="name" type="text" class="name form-control"/>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input name="email" id="email" type="text" class="email form-control"/>
                </div>
                <div class="form-group mb-3">
                    <label for="phone">Phone</label>
                    <input name="phone" id="phone" type="text" class="phone form-control"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add-student">Proceed</button>
            </div>
        </div>
    </div>
</div>
{{-- end of Add Student Modal--}}

{{-- Delete Student Modal--}}
<div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="student_id" id="student_id" name="student_id"/>
                <em>This item will be <b>Deleted</b> permanently.</em>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger delete-student">I Understand</button>
            </div>
        </div>
    </div>
</div>
{{-- end of Delete Student Modal--}}


{{-- Edit Student Modal--}}
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="errors" role="alert">
                </div>
                <div class="form-group mb-3">

                    <input type="hidden" name="edit_id" class="edit_id" value=""/>
                    <label for="edit_name">Name</label>
                    <input name="edit_name" id="edit_name" type="text" class="edit_name form-control"/>
                </div>
                <div class="form-group mb-3">
                    <label for="edit_email">Email</label>
                    <input name="edit_email" id="edit_email" type="text" class="edit_email form-control"/>
                </div>
                <div class="form-group mb-3">
                    <label for="edit_phone">Phone</label>
                    <input name="edit_phone" id="edit_phone" type="text" class="edit_phone form-control"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary edit-student">Save Changes</button>
            </div>
        </div>
    </div>
</div>
{{-- end of Edit Student Modal--}}



<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="success"></div>
            <div class="card">
                <div class="card-header">
                    <h4>Students List
                        <a href="" class="btn btn-primary btn-sm  float-end" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add New</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                           <tr>
                               <th>ID</th>
                               <th>Name</th>
                               <th>Email</th>
                               <th>Phone</th>
                               <th>Registered On</th>
                               <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script><title>ajax App</title>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>

    $(document).ready(function (){

        // show all Students

        getStudents();
        function getStudents(){
            $('tbody').html('');

            $.ajax({
                url: "/get-students",
                method:'get',
                dataType: 'JSON',
                success: function(response) {
                    $.each(response.studs, function(key,item){
                        $('tbody').append(
                            '<tr>\
                             <td>'+item.id+'</td>\
                             <td>'+item.name+'</td>\
                             <td>'+item.email+'</td>\
                             <td>'+item.phone+'</td>\
                             <td>'+item.created_at+'</td>\
                             <td><button class="btn btn-edit btn-sm btn-primary" id="'+item.id+'">Edit</button>\
                                 <button class="btn del-btn btn-sm btn-danger"   id="'+item.id+'">Delete</button</td>\
                             </tr>');
                    });
                }
            });
        }


    // Add Students and show all Students

        $(document).on('click','.add-student',function(){

            let data = {
                'name': $(".name").val(),
                'email': $("input[name=email]").val(),
                'phone': $("#phone").val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/add-student",
                method:'POST',
                data: data,
                dataType: 'JSON',
                success: function(response) {
                    if(response.status == 400){
                        $('.errors').addClass('alert alert-danger');
                        $('.errors').append('Form Validation failed<br>');
                    }
                    else{

                        $(".name").val('');
                        $("input[name=email]").val('');
                        $("#phone").val('');
                        $('.errors').html('');
                        $('.errors').removeClass('alert alert-danger');


                        $('.success').addClass('alert alert-success');
                        $('.success').append('User Added Successfully!!');
                        $('#addStudentModal').modal('hide');
                        getStudents();


                        $( ".success" ).delay(2000).fadeOut();
                    }
                }
            });
        });

// Show Edit Student Modal

        $(document).on('click','.btn-edit',function(){
            let student_id = this.id;

            $('#editStudentModal').modal('show');

            $.ajax({
                url: "/edit-student/" + student_id,
                method: 'get',
                dataType: 'JSON',
                success: function (response) {
                    $('.edit_id').val(response.student['id']);
                    $('.edit_name').val(response.student['name']);
                    $('.edit_email').val(response.student['email']);
                    $('.edit_phone').val(response.student['phone']);
                }
            });
        });

// Edit Student in database and show all students

        $(document).on('click','.edit-student',function() {
            let data = {
                'edit_id': $('.edit_id').val(),
                'edit_name': $('.edit_name').val(),
                'edit_email': $('.edit_email').val(),
                'edit_phone': $('.edit_phone').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/edit-student",
                method: 'POST',
                data: data,
                dataType: 'JSON',
                success: function (response) {
                    if (response.status == 400) {
                        $('.errors').addClass('alert alert-danger');
                        $('.errors').append('Form Validation failed<br>');
                        $('.errors').delay(2000).fadeOut();
                    } else {
                        $('.success').addClass('alert alert-success');
                        $('.success').append('User Added Successfully!!');
                        $('#editStudentModal').modal('hide');
                        getStudents();
                        $(".success").delay(2000).fadeOut();
                    }
                }
            });
        });


        // open delete student modal

        $(document).on('click','.del-btn', function() {

            let student_id = this.id;
            $('#deleteStudentModal').modal('show');
            $('.student_id').val(student_id);
        });

        // delete student from Database

        $(document).on('click','.delete-student', function(){
            let student_id = $('.student_id').val();
            $.ajax({
                url: "/delete-student/"+student_id,
                method:'get',
                success: function(response) {
                    if(response.status == 1583){
                        $('.success').addClass('alert alert-success');
                        $('.success').append('User Deleted Successfully!!');
                        $('#deleteStudentModal').modal('hide');
                        getStudents();
                        $( ".success" ).delay(3000).fadeOut();
                    }
                    else{
                        $('.errors').addClass('alert alert-danger');
                        $('.errors').append('Failed To Delete User<br>');
                    }
                }
            });
        });
    });

</script>
</body>
</html>
