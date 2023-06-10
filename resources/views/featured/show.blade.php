@extends('layouts.app')

@section('template_title')
    {{ $featured->name ?? "{{ __('Show') Featured" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Featured</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('featureds.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $featured->title }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $featured->description }}
                        </div>
                        <div class="form-group">
                            <strong>Restaurant:</strong>
                            {{ $featured->restaurant->name}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
