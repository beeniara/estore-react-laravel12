@if($product->status === false)
    <button class="btn btn-secondary" disabled>Out of Stock</button>
@else
    <form action="{{ route('cart.add', $product) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Add to Cart</button>
    </form>
@endif 