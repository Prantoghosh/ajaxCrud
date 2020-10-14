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
    <tbody id="employeeTableBody">
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
                <a href="" class="btn btn-primary btn-sm">View</a>
                <a href="" class="btn btn-info btn-sm">Edit</a>
                <a href="" class="btn btn-danger btn-sm">Delete</a>

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

<script>
$(document).ready(function () {
    $('#employeeTable').DataTable({
        "order": [[ 0, "desc" ]]
    });
    
});

</script>