<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4" style="margin-top: 100px;">
                <h2 class="text-center">User Details</h2>
                <table class="table" id="user_details" style="display: none;">
                  <tbody>
                    <tr>
                      <th scope="row">Name</th>
                      <td id="userName">Mark</td>
                    </tr>
                    <tr>
                      <th scope="row">Email</th>
                      <td id="userEmail">Jacob</td>
                    </tr>
                  </tbody>
                </table>
            </div>
            <div class="col-md-8">
                <h1 class="text-center">Users List</h1>
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="100px">Action</th>
                        </tr>
                    </tfoot>
                </table>  
            </div>
        </div>
    </div>
</body>
   
<script type="text/javascript">
    $(function () {
        var table = $('.data-table').DataTable({
            "dom": '<"top"fl>rt<"bottom"<i>p><"clear">',
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "users",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });

    $( ".data-table" ).on( "click", ".view", function() {
      let id = $( this ).attr("id");
      $.ajax({
        type: "GET",
        url: 'users/' + id ,
        success: function(response) {
            var r = JSON.parse(response);
            if(r.status == 200) {
                $("#userName").text(r.data.name);
                $("#userEmail").text(r.data.email);
                $("#user_details").show();
            } else {
                alert("Something went wrong!");
            }
        }
      })
    });
</script>
</html>