@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Featured Dish
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Featured Dish</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('featured-dishes.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('featured-dish.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
