<div class="box box-info padding-1">
    {{ Form::open(['route' => 'categories.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-container']) }}
    <h5 class="text-center">{{$nombreVista}}</h5>

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', $category->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    
    <div class="form-group">
        {{ Form::label('image', 'Image') }}
        <br>
        {{ Form::file('image', ['class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : ''),'accept'=>'image/*', 'placeholder' => 'Image']) }}
        {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="mb-3">
        <br>
        <button class="btn btn-secondary text-center" type="submit">Create</button>
    </div>
{{ Form::close() }}
</div>