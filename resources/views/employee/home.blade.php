<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">


    <link rel="stylesheet" href="{{asset('css/datatables.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    

</head>
<body id="response">
    <div class="header mt-3" style="height:11vh;">
        <h2 style="text-align: center;">Employee List</h2>
    </div>
    <div class="emp ">

        <div class="container border border-dark" style="padding: 50px;">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" style="background-color: lightslategray" data-toggle="modal" data-target="#exampleModal">
                       Add New Employee
                    </button>
  
            <hr>

            <div id="showTableData">

           

            <table id="employeeTable" class="display " style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name<i class="fa fa-sort" aria-hidden="true"></i></th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Image</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)

                    <tr>
                        <td>{{$employee->id}}</td>
                        <td>{{$employee->name}}</td>
                        <td>{{$employee->email}}</td>
                        <td>{{$employee->phone}}</td>
                        
                        <td>
                                        
                            <img src="{{ asset('/storage/'.$employee->image) }}"
                            alt="Profile Pic" class=" w-30" height="30" >
                       </td>

                        <td>
                        <a href="{{ url('view/employee/data') }}" data-id="{{ $employee->id }}"
                            class="btn btn-primary btn-sm viewBtn">View</a>
                        <a href="{{ url('edit/employee/data') }}" data-id="{{ $employee->id }}"
                            class="btn btn-info btn-sm editBtn">Edit</a>
                        <a href="{{ url('delete/employee/data') }}"
                            data-id="{{ $employee->id }}" class="btn btn-danger btn-sm deleteBtn">Delete</a>

                        </td>
                    </tr>
                    
                        
                    @endforeach

                  
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Name<i class="fa fa-sort" aria-hidden="true"></i></th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </tfoot>

            </table>

        </div>

            <div class="load"
                style=" position: fixed;top: 50%;left: 50%;transform: translate(-50%, -50%);transform:
                -webkit-translate(-50%, -50%);transform: -moz-translate(-50%, -50%);transform: -ms-translate(-50%,
                -50%); display:none; z-index:9999;">
                <img src="{{ asset('images/load.gif') }}" class="img-fluid loadImg" alt="loader">
            </div>

        </div>


    <div id="getAllData" data-url="{{url('get/employees')}}" ></div>      


  <!-- Add Employee Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
        <form action="{{route('addEmployee')}}" method="POST" id="addEmployee">
            @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name"  placeholder="Enter name">
                </div>
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" id="email" name="email"  placeholder="Enter email">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" class="form-control" id="phone" name="phone"  placeholder="Enter phone no.">
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image"  placeholder="image">
                </div>



                <div class="bottom text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
        </div>

      </div>
    </div>
  </div>
    <!--Add Employee Modal Ends -->

    <!--View Modal Starts -->
    <div class="modal fade" id="viewEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="viewEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title employeeDetailsHeader" id="viewEmployeeModalLabel"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="profileInfo ml-3">
                    <div class="">
                        <img class="eImage rounded-circle" height="75" width="80" src="" alt="Profile pic">
                    </div>
                    <div class="eName"></div>
                    <div class="eEmail"></div>
                    <div class="ePhone"></div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
    
          </div>
        </div>
      </div>

        <!--View Modal Ends -->

    </div>


    <script src="{{asset('js/jQuery.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js.map')}}"></script>
    
    <script src="{{asset('js/datatables.min.js')}}"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous"></script>

    <script>
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    </script>

    <script src="{{asset('js/script.js')}}"></script>
    
</body>
</html>