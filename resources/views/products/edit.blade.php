<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<div>
    <form method="POST" action="{{route('test.update',['test' => $products->id])}}">
        {{csrf_field()}}
        {{ method_field('PATCH') }}
        <div>
            <input type="text" name="name" placeholder="name" value="{{$products->name}}">
            @error('name')
            <p class="alert alert-danger">{{$message}}</p>
            @enderror
        </div>

        <div>
            <input type="text" name="price" placeholder="price" value="{{$products->price}}">
            @error('price')
            <p class="alert alert-danger">{{$message}}</p>
            @enderror
        </div>

        <div>
            <input type="text" name="quantity" placeholder="quantity" value="{{$products->quantity}}">
            @error('quantity')
            <p class="alert alert-danger">{{$message}}</p>
            @enderror
        </div>

        <div>
            <input type="text" name="image" placeholder="image" value="{{$products->image}}">
            @error('image')
            <p class="alert alert-danger">{{$message}}</p>
            @enderror
        </div>

        <div>
            <input type="text" name="type_products" placeholder="type_products"
                   value="{{$products->type_products->name}}">
            @error('type_products')
            <p class="alert alert-danger">{{$message}}</p>
            @enderror
        </div>

        <button class="btn btn-primary">Save</button>
    </form>
</div>
</html>
