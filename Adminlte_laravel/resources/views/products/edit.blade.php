<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Edit Product Form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-2">
    <div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2>Edit Product</h2>
</div>
<div class="pull-right">
<a class="btn btn-primary" href="{{ url('products') }}" enctype="multipart/form-data"> Back</a>
</div>
</div>
</div>
@if(session('status'))
<div class="alert alert-success mb-1 mt-1">
{{ session('status') }}
</div>
@endif
    
    {!!Form::model($product,array('method'=>'post','url'=>['products/update',$product->id],'class'=>'form','files' => 'true','enctype'=>'multipart/form-data'))!!}
    @csrf 
        <div class="form-group">
            {!!Form::label('Name')!!}
            {!!Form::text('name',null,array('required','class'=>'form-control'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('Price')!!}
            {!!Form::text('price',null,array('required','class'=>'form-control'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('SKU')!!}
            {!!Form::text('sku',null,array('required','class'=>'form-control'))!!}
        </div>
        <div class="form-group">
            {!!Form::label('Image')!!}
            {!!Form::file('image')!!}
           
            <img src="/images/{{ $product->image }}" width="150px">
             
        </div>
        <div class="form-group">
            {!!Form::label('Detail')!!}
            {!! Form::textarea('detail', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Category</label>
                <select  id="category" name="categorys[]" class="form-control" multiple="" >
                    <option value="">Select category</option>
                    <!-- @php
                    $product_cat = $product->categories->pluck('id')->toArray(); 
                    @phpend -->
                    @foreach($category as $key => $value)
                        <option value="{{$value->id }}" {{ in_array($value->id,$product_cat) ? 'selected' : '' }}>{{ $value->name }}</option>
                    @endforeach
                </select>               
            </div>
        <div class="form-group">
            {!!Form::submit('Update product',array('class'=>'btn btn-primary'))!!}
        </div>
    {!!Form::close()!!}
</div>
</body>
</html>