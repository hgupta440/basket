<!DOCTYPE html>
<html>
<head>
    <title>Basket</title>
</head>
<body>
    <h1>Acme Widget Basket</h1>
    <form method="POST" action="/basket/total">
        @csrf
        <label>Select products:</label><br/>
        <select name="products">
            @foreach($products as $key => $product)
                <option data-name="{{ $product['name'] }}" data-price="{{ $product['price']}}" value="{{ $key }}">
                    {{ $product['name'] }} ${{ $product['price'] }}
                </option>
            @endforeach
            
        </select><br/><br/>

        <button type="button" id="add-product">Add Product</button>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody id="product-list">
                @foreach($selected as $product)
                    <tr>
                        <td>{{ $products[$product]['name'] }}<input type="hidden" name="selectedProduct[]" value="{{ $product }}"/></td>
                        <td>${{ number_format($products[$product]['price'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        

        <button type="submit">Calculate Total</button>
    </form>

    @isset($cost)
        <h3>Subtotal: ${{ number_format($cost['subtotal'], 2) }}</h3>
        <h3>Delivery: ${{ number_format($cost['delivery'], 2) }}</h3>
        <h2>Total: ${{ number_format($cost['subtotal'] + $cost['delivery'], 2) }}</h2>
    @endisset

    <script>
        document.getElementById('add-product').addEventListener('click', function() {
            const productSelect = document.querySelector('select[name="products"]');
            const selectedProduct = productSelect.options[productSelect.selectedIndex].getAttribute('data-name');
            const selectedPrice = productSelect.options[productSelect.selectedIndex].getAttribute('data-price');
            const selectedValue = productSelect.options[productSelect.selectedIndex].value;

            const newRow = document.createElement('tr');
            newRow.innerHTML = '<td>'+selectedProduct+'<input type="hidden" name="selectedProduct[]" value="'+selectedValue+'"/></td><td>$'+selectedPrice+'</td>';
            document.getElementById('product-list').appendChild(newRow);
        });
    </script>
</body>
</html>
