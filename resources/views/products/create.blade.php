<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
{{--@if ($errors->any())--}}
{{--    <div class="alert">--}}
{{--        @foreach ($errors->all() as $error)--}}
{{--            <li>{{ $error }}</li>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--@endif--}}

<div>
    <form method="POST" action="{{route('test.store')}}">
        {{csrf_field()}}
        <div>
            <input type="text" name="name" placeholder="name">
            @error('name')
            <p class="alert alert-danger">{{$message}}</p>
            @enderror
        </div>

        <div>
            <input type="text" name="price" placeholder="price">
            @error('price')
            <p class="alert alert-danger">{{$message}}</p>
            @enderror
        </div>

        <div>
            <input type="text" name="quantity" placeholder="quantity">
            @error('quantity')
            <p class="alert alert-danger">{{$message}}</p>
            @enderror
        </div>

        <div>
            <input type="text" name="image" placeholder="image">
            @error('image')
            <p class="alert alert-danger">{{$message}}</p>
            @enderror
        </div>

        <div>
            <input type="text" name="type_products" placeholder="type_products">
            @error('type_products')
            <p class="alert alert-danger">{{$message}}</p>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Create</button>
    </form>
</div>
</html>
