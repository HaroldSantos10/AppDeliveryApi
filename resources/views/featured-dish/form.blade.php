<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('featured_id') }}
            {{ Form::text('featured_id', $featuredDish->featured_id, ['class' => 'form-control' . ($errors->has('featured_id') ? ' is-invalid' : ''), 'placeholder' => 'Featured Id']) }}
            {!! $errors->first('featured_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('dish_id') }}
            {{ Form::text('dish_id', $featuredDish->dish_id, ['class' => 'form-control' . ($errors->has('dish_id') ? ' is-invalid' : ''), 'placeholder' => 'Dish Id']) }}
            {!! $errors->first('dish_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>