@extends('layouts.app')

@section('template_title')
    {{ $restaurant->name ?? "{{ __('Show') Restaurant" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Restaurant</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('restaurants.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $restaurant->name }}
                        </div>
                        <div class="form-group">
                            <strong>Image:</strong>
                            {{ $restaurant->image }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $restaurant->description }}
                        </div>
                        <div class="form-group">
                            <strong>Lng:</strong>
                            {{ $restaurant->lng }}
                        </div>
                        <div class="form-group">
                            <strong>Lat:</strong>
                            {{ $restaurant->lat }}
                        </div>
                        <div class="form-group">
                            <strong>Address:</strong>
                            {{ $restaurant->address }}
                        </div>
                        <div class="form-group">
                            <strong>Stars:</strong>
                            {{ $restaurant->stars }}
                        </div>
                        <div class="form-group">
                            <strong>Reviews:</strong>
                            {{ $restaurant->reviews }}
                        </div>
                        <div class="form-group">
                            <strong>Category Id:</strong>
                            {{ $restaurant->category_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
