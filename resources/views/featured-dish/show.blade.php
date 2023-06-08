@extends('layouts.app')

@section('template_title')
    {{ $featuredDish->name ?? "{{ __('Show') Featured Dish" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Featured Dish</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('featured-dishes.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Featured Id:</strong>
                            {{ $featuredDish->featured_id }}
                        </div>
                        <div class="form-group">
                            <strong>Dish Id:</strong>
                            {{ $featuredDish->dish_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
