@extends('admin_pages')


@section('content')

 <div class="panel-heading">
<h3>
Produkty
</h3>
 </div>
 <span>
 Produktów: {{ $qty }}
 </span>
 <div class="panel-body">
<table class="table table-striped">
<thead>
<th>
SKU
</th>  
<th>
Obrazek
</th>
<th>
Nazwa produktu
</th>
<th>
Stan
</th>
<th>
Cena
</th>
 </tr>
</thead>
<tbody>
@foreach($products as $product)
<tr>
<td>{{ $product->sku_produktu }}</td>
<td><img src="{{ $product->obrazek_produktu }}" alt="miniatura" width="120" class="thumbnail"/></td>

<td>{{ $product->nazwa_produktu }}</td>
<td>{{$product->ilosc_produktu}}</td>
<td>{{ number_format($product->cena_produktu,2) }}</td>

</tr>

@endforeach

</tbody>
</table>
{{ $products->links() }}
</div>

@endsection