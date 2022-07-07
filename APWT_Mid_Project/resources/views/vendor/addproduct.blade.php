@extends('layouts.main')
@section('title')
    Add Product
@endsection
@section('content')
    <h1 align="center">Add Product</h1>

    <center>
    <h1>{{Session::get('msg')}}</h1>
        <fieldset>
            <form action="" method="POST" enctype="multipart/form-data">
                <table border="2" style="width: 100%;">
                {{@csrf_field()}}
                    <tr>
                        <th><label for="name">Product Name:</label></th>
                        <td><input type="text" id='name' name="name" placeholder="Write Product Name" value="{{old('name')}}"></td>
                        <td>@error('name'){{$message}}@enderror</td>
                    </tr>
                    <tr>
                        <th><label for="category">Product Category:</label></th>
                        <td><input type="text" id='category' name="category" placeholder="Write Product Category" value="{{old('category')}}"></td>
                        <td>@error('category'){{$message}}@enderror</td>
                    </tr>
                    <tr>
                        <th><label for="thumbnail">Product Thumbnail:</label></th>
                        <td><input type="file" name="p_thumbnail"></td>
                        <td>
                            @error('p_thumbnail'){{$message}}@enderror
                        </td>
                    </tr>
                    <tr>
                        <th><label for="gallery">Product Gallery:</label></th>
                        <td><input type="file" id='gallery' name="gallery" placeholder="Write Product Gallery" value="{{old('gallery')}}"></td>
                        <td>@error('gallery'){{$message}}@enderror</td>
                    </tr>
                    <tr>
                        <th><label for="price">Product Price:</label></th>
                        <td><input type="number" id='price' name="price" placeholder="Write Product Price" value="{{old('price')}}"></td>
                        <td>@error('price'){{$message}}@enderror</td>
                    </tr> 
                    <tr>
                        <th><label for="stock">Product Stock:</label></th>
                        <td><input type="number" id='stock' name="stock" placeholder="Write Product Stock" value="{{old('stock')}}"></td>
                        <td>@error('stock'){{$message}}@enderror</td>
                    </tr>  
                    <tr>
                        <th><label for="color">Product Color:</label></th>
                        <td><input type="text" id='color' name="color" placeholder="Write Product Color" value="{{old('color')}}"></td>
                        <td>@error('color'){{$message}}@enderror</td>
                    </tr>  
                    <tr>
                        <th><label for="size">Product Size:</label></th>
                        <td><input type="number" id='size' name="size" placeholder="Write Product Size" value="{{old('size')}}"></td>
                        <td>@error('size'){{$message}}@enderror</td>
                    </tr>   
                    <tr>
                        <th><label for="description">Product Description:</label></th>
                        <td><input type="textarea" id='description' name="description" placeholder="Write Product Description" value="{{old('description')}}"></td>
                        <td>@error('description'){{$message}}@enderror</td>
                    </tr>
                    <tr>
                        <th colspan="3"><input type="submit"value="Add"></tH>
                    </tr>               
                </table>
            </form>  
        </fieldset>
    </center>
@endsection