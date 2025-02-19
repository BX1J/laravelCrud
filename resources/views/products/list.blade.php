<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Simple laravel 11 crud app</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.create') }}" class="btn btn-dark">Create</a>
            </div>
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.deleteAll') }}" class="mt-2 btn btn-dark">Delete All Products</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">

            @if (Session::has('success'))
                <div class="col-md-10 mt-4">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif


            <div class="col-md-10">
                <div class="card my-4 border-0 shadow-lg">
                    <div class="card-header bg-dark">
                        <h3 class="text-white text-center">All Products</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Create At</th>
                                <th>Action</th>
                            </tr>
                            @if ($products->isNotEmpty())
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            @if ($product->image != '')
                                                <img width="50"
                                                    src="{{ asset('uploads/products/' . $product->image) }}"
                                                    alt="">
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>RS. {{ $product->price }}</td>
                                        <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                                        <td>
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="btn btn-dark">Edit</a>
                                            <a href="#" onclick="deleteProduct({{ $product->id }})"
                                                class="btn btn-danger">Delete</a>
                                            <form method="POST" id="delete-product-form-{{ $product->id }}"
                                                action="{{ route('products.destroy', $product->id) }}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
<script>
    function deleteProduct(id) {
        if (confirm("Delete the Product?")) {
            document.getElementById("delete-product-form-" + id).submit();
        }
    }
</script>

</html>
