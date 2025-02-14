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
        <h3 class="text-white text-center">Simple laravel 11 CRUD</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-dark">Cancel</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card my-4 border-0 shadow-lg">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Edit Product</h3>
                    </div>
                    <form action="{{ route('products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label h5">Name: </label>
                                <input value="{{ old('name', $product->name) }}" type="text" name="name"
                                    placeholder="Product Name"
                                    class="@error('name') is-invalid @enderror form-control form-control-lg">
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="sku" class="form-label h5">SKU: </label>
                                <input value="{{ old('sku', $product->sku) }}" type="text" name="sku"
                                    placeholder="Product Sku"
                                    class="@error('sku') is-invalid @enderror form-control form-control-lg">
                                @error('sku')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label h5">Price: </label>
                                <input value="{{ old('price', $product->price) }}" type="number" name="price"
                                    placeholder="Product Price"
                                    class="@error('price') is-invalid @enderror form-control form-control-lg">
                                @error('price')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label h5">Description: </label>
                                <textarea value="{{ old('description', $product->description) }}" placeholder="Enter Product Description"
                                    name="description" class="form-control" cols="10" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label h5">Image: </label>
                                <input type="file" placeholder="Enter Product Description" name="image"
                                    class="form-control" cols="10" rows="5" />
                                @if ($product->image != '')
                                    <img class="w-50 my-3" src="{{ asset('uploads/products/' . $product->image) }}"
                                        alt="">
                                @endif
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg">Update</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
