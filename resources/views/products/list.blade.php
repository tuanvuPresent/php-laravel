<html>

<style>
    td, th {
        border: 1px solid #827d7d;
    }
</style>

<div class="box box-primary">
    <a href=" {{ route('test.create') }}">
        <button type="button" class="btn btn-info"><i class="fa fa-plus"></i> Thêm Sản Phẩm</button>
    </a>
    <div class="box-body">
        <table class="custom-table">
            <thead>
            <th colspan="8">Thông Tin Sản Phẩm</th>
            </th>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>price</th>
                <th>quantity</th>
                <th>image</th>
                <th>type product</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->image}}</td>
                    <td>{{$item->type_products->name}}</td>
                    <td>
                        <a href=" {{ route('test.edit',  $item->id) }}">
                            <button type="button">Edit</button>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('test.destroy', $item->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

</html>
