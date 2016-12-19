<table>
    <tr>
        <th>Product Id</th>
        <th>Product Name</th>
        <th>Product Price</th>
        <th>Product Image(256)</th>
        <th>Product Image(512)</th>
    </tr>
    {% for row in allProductData %}
    <tr>
        <td>{{row.productId}}</td>
        <td>{{row.productName}}</td>
        <td>{{row.productPrice}}</td>
        <td>
        {% for img in row.image256 %}
            <img src="{{img}}" />
        {% endfor %}
        </td>
        <td>
        {% for img in row.image512 %} 
            <img src="{{img}}" />
        {% endfor %}
        </td>
    </tr>
    {% endfor %}
</table>