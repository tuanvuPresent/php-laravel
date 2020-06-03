<html>
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>

<!-- Item Listing -->
<div>
    <div style="width: 50%; margin: auto">
        @if (Session::has('success'))
            <div class="alert alert-success fade-message">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

        <button type="button" class="btn btn-primary" data-toggle="modal"
                data-target="#create">
            Create
        </button>

        <table class="table table-bordered " style="margin-top: 20px">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($books as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>

                    <td>
                        <div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit"
                                    data-id="{{$item->id}}" data-name="{{$item->name}}">
                                Edit
                            </button>

                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete"
                                    data-id="{{$item->id}}" data-name="{{$item->name}}">
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create -->
<div class="modal" id="create">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Create Book</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" action="{{route('books.store')}}">
                    {{csrf_field()}}
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" placeholder="name">
                        @error('name')
                        <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" onclick="save()">Save</button>
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Book</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" action="{{route('books.update',$item->id)}}">
                    {{csrf_field()}}
                    @method('PATCH')

                    <input type="text" id="id" name="id" value="" class="form-control" readonly>

                    <div class="md-form">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control">
                        @error('name')
                        <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Delete Book</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" action="{{ route('books.destroy',$item->id)}}">
                    {{csrf_field()}}
                    @method('DELETE')
                    <input type="hidden" name="id" id="id" value="">
                    <h5>Are you sure you want to delete <span id="name"></span> ?</h5>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Delete</button>

                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
<script>
    $('#delete').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const name = button.data('name');
        const id = button.data('id');
        const modal = $(this);
        $('.modal-body #name').text(name);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
    })

    $('#edit').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const id = button.data('id');
        const name = button.data('name');
        const modal = $(this);
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
    })

    $(function () {
        setTimeout(function () {
            $('.fade-message').slideUp();
        }, 1000);
    });

    function save() {
        console.log('this')
    }
</script>
</html>
