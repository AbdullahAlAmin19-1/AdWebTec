@extends('layouts.main')
@section('title')
    Edit Product
@endsection
@section('content')
    <h1 align="center">Edit Product</h1>

    <center>
    <h1>{{Session::get('msg')}}</h1>
        <fieldset>
            <form action="" method="POST">
                <table border="2" style="width: 100%;">
                {{@csrf_field()}}
                    <tr>
                        <th><label for="v_id">Vendor Id:</label></th>
                        <td><input type="number" id='v_id' name="v_id" placeholder="Write Vendor Id" value="{{$p->v_id}}"></td>
                        <td>@error('name'){{$message}}@enderror</td>
                    </tr>
                    <tr>
                        <th><label for="name">Product Name:</label></th>
                        <td><input type="text" id='name' name="name" placeholder="Write Product Name" value="{{$p->p_name}}"></td>
                        <td>@error('name'){{$message}}@enderror</td>
                    </tr>
                    <tr>
                        <th><label for="id">Product Id:</label></th>
                        <td><input type="number" id='id' name="id" placeholder="Write Product id" value="{{$p->p_id}}"></td>
                        <td>@error('name'){{$message}}@enderror</td>
                    </tr>
                    <tr>
                        <th><label for="category">Product Category:</label></th>
                        <td><input type="text" id='category' name="category" placeholder="Write Product Category" value="{{$p->p_category}}"></td>
                        <td>@error('category'){{$message}}@enderror</td>
                    </tr>
                    <tr>
                        <th><label for="thumbnail">Product Thumbnail:</label></th>
                        <td><input type="text" id='thumbnail' name="thumbnail" placeholder="Write Product Thumbnail" value="{{$p->p_thumbnail}}"></td>
                        <td>@error('thumbnail'){{$message}}@enderror</td>
                    </tr>
                    <tr>
                        <th><label for="gallery">Product Gallery:</label></th>
                        <td><input type="file" id='gallery' name="gallery" placeholder="Write Product Gallery" value="{{$p->p_gallery}}"></td>
                        <td>@error('gallery'){{$message}}@enderror</td>
                    </tr>
                    <tr>
                        <th><label for="price">Product Price:</label></th>
                        <td><input type="number" id='price' name="price" placeholder="Write Product Price" value="{{$p->p_price}}"></td>
                        <td>@error('price'){{$message}}@enderror</td>
                    </tr> 
                    <tr>
                        <th><label for="stock">Product Stock:</label></th>
                        <td><input type="number" id='stock' name="stock" placeholder="Write Product Stock" value="{{$p->p_stock}}"></td>
                        <td>@error('stock'){{$message}}@enderror</td>
                    </tr>  
                    <tr>
                        <th><label for="color">Product Color:</label></th>
                        <td><input type="text" id='color' name="color" placeholder="Write Product Color" value="{{$p->p_color}}"></td>
                        <td>@error('color'){{$message}}@enderror</td>
                    </tr>  
                    <tr>
                        <th><label for="size">Product Size:</label></th>
                        <td><input type="number" id='size' name="size" placeholder="Write Product Size" value="{{$p->p_size}}"></td>
                        <td>@error('size'){{$message}}@enderror</td>
                    </tr>   
                    <tr>
                        <th><label for="description">Product Description:</label></th>
                        <td><input type="textarea" id='description' name="description" placeholder="Write Product Description" value="{{$p->p_description}}"></td>
                        <td>@error('description'){{$message}}@enderror</td>
                    </tr>
                    <tr>
                        <th colspan="3"><input type="submit"value="Update"></tH>
                    </tr>               
                </table>
            </form>  
        </fieldset>
    </center>
@endsection