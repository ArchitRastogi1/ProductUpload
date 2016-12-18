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
        {% for img in row.images %}
        
            <img src="http://localhost:8888/public/gets/getImage?image_id={{img}}&size=256" />
        {% endfor %}
        </td>
        <td>
        {% for img in row.images %} 
            <img src="http://localhost:8888/public/gets/getImage?image_id={{img}}&size=512" />
        {% endfor %}
        </td>
    </tr>
    {% endfor %}
</table>