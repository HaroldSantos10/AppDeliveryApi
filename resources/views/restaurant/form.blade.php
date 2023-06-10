<div class="box box-info padding-1">
    <div class="box-body">
        {{ Form::open(['route' => 'restaurants.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-container']) }}
        <h5 class="text-center">{{$nombreVista}}</h5>

        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $restaurant->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group"> 
            {{ Form::label('image') }}
            {{ Form::file('image', ['class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : ''),'accept'=>'image/*', 'placeholder' => 'Image']) }}
            {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}        
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $restaurant->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('lng') }}
            {{ Form::text('lng', $restaurant->lng, ['class' => 'form-control' . ($errors->has('lng') ? ' is-invalid' : ''), 'placeholder' => 'Lng', 'pattern' => '^[-]?(([0-9]|[1-8][0-9])(\.[0-9]{1,15})?|90(\.0{1,15})?)$']) }}
            {!! $errors->first('lng', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('lat') }}
            {{ Form::text('lat', $restaurant->lat, ['class' => 'form-control' . ($errors->has('lat') ? ' is-invalid' : ''), 'placeholder' => 'Lat', 'pattern' => '^[-]?(([0-9]|[1-8][0-9])(\.[0-9]{1,15})?|90(\.0{1,15})?)$']) }}
            {!! $errors->first('lat', '<div class="invalid-feedback">:message</div>') !!}
        </div>        
        <div class="form-group">
            {{ Form::label('address') }}
            {{ Form::text('address', $restaurant->address, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''), 'placeholder' => 'Address']) }}
            {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('stars') }}
            {{ Form::number('stars', $restaurant->stars, ['class' => 'form-control' . ($errors->has('stars') ? ' is-invalid' : ''), 'placeholder' => 'Stars']) }}
            {!! $errors->first('stars', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('reviews') }}
            {{ Form::text('reviews', $restaurant->reviews, ['class' => 'form-control' . ($errors->has('reviews') ? ' is-invalid' : ''), 'placeholder' => 'Reviews']) }}
            {!! $errors->first('reviews', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('category') }}
           
            {{ Form::select('category_id', ['' => 'Selecciona una categoría'] + $categories->pluck('name', 'id')->toArray(), $restaurant->category_id, ['class' => 'form-select' . ($errors->has('category_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('category_id', '<div class="invalid-feedback">:message</div>') !!}
    
        </div>

    </div>

    <br>

    <div class="box-footer mt20">
        
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>


{{--, 'accept'=>'image/*'--}}