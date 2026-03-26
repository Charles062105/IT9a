<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <style>
        body { font-family: Arial; max-width: 500px; margin: 50px auto; }
        label { display: block; margin: 10px 0 5px; font-weight: bold; }
        input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #007bff; color: white; padding: 12px 30px; border: none; border-radius: 4px; cursor: pointer; }
        .error { color: red; }
        .back { background: #6c757d; margin-left: 10px; }
    </style>
</head>
<body>
    <h1>Edit Product</h1>

    @if($errors->any())
        <div style="color:red; background:#f8d7da; padding:15px; border-radius:4px; margin-bottom:20px;">
            <ul style="margin:0; padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label>Product Name:</label>
        <input type="text" name="productname" value="{{ old('productname', $product->productname) }}" required>
        
        <label>Price ($):</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required>
        
        <label>Quantity:</label>
        <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
        
        <br><br>
        <button type="submit">🔄 Update Product</button>
        <a href="{{ route('products.index') }}" class="back">🔙 Back</a>
    </form>
</body>
</html>