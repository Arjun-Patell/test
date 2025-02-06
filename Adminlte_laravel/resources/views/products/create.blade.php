<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Create Product</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-2">
    <div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
</div>
<h1>Create a New  Product</h1>
<ul>
<div class="pull-right">
<a class="btn btn-primary" href="{{ url('products') }}" enctype="multipart/form-data"> Back</a>
</div>
</div>
</div>
@section('content')

@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
{!!Form::open(array('route'=>'pro_store','class'=>'form','files' => 'true','enctype'=>'multipart/form-data'))!!}
    <div class="form-group">
        {!!Form::label('Product Name')!!}
        {!!Form::text('name',null,array('required','class'=>'form-control','placeholder'=>'enter name'))!!}
    </div>
    <div class="form-group">
        {!!Form::label('Product Price')!!}
        {!!Form::number('price',null,array('required','class'=>'form-control','placeholder'=>'enter price'))!!}
    </div>
    <div class="form-group">
            {!!Form::label('SKU')!!}
            {!!Form::text('sku',null,array('required','class'=>'form-control','placeholder'=>'enter sku'))!!}
    </div>
    <div class="form-group">
        {!!Form::label('Image')!!}
        {!!Form::file('image',null,array('required','class'=>'form-control'))!!}
        </div>  
        <div class="form-group">
        {!!Form::label('Detail')!!}
            {!! Form::textarea('detail', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Category</label>
                <select  id="category" name="categorys[]" class="form-control" multiple="" >
                    <option value="">Select category</option>
                    @if($category ->count() > 0)
                        @foreach ($category as $data)
                            <option value="{{$data->id}}">
                                {{$data->name}}
                            </option>
                        @endforeach
                        @else
                        No Record Found
                            @endif   
                </select>
            </div>
        <div class="form-group">
            {!!Form::submit('Create List',array('class'=>'btn btn-primary'))!!}
        </div>
{!!Form::close()!!}
</div>
</body>
</html>