<div class="box box-info padding-1">
    <div class="box-body">
        {{ Form::open(['route' => 'dishes.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-container']) }}
        <h5 class="text-center">{{$nombreVista}}</h5>

        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $dish->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $dish->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('price') }}
            {{ Form::input('number', 'price', $dish->price, ['class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''), 'placeholder' => 'Price', 'step' => 'any']) }}
            {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
        </div>        
        <div class="form-group"> 
            {{ Form::label('image') }}
            {{ Form::file('image', ['class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : ''),'accept'=>'image/*', 'placeholder' => 'Image']) }}
            {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('restaurant') }}
           
            {{ Form::select('restaurant_id', ['' => 'Selecciona un restaurante'] + $restaurants->pluck('name', 'id')->toArray(), $dish->restaurant_id, ['class' => 'form-select' . ($errors->has('restaurant_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('restaurant_id', '<div class="invalid-feedback">:message</div>') !!}
    
        </div>

    </div>
    <br>
    
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>