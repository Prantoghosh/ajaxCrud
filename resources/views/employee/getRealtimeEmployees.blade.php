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

<script>
$(document).ready(function () {
    $('#employeeTable').DataTable({
        "order": [[ 0, "desc" ]]
    });
    
});

</script>
