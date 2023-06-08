@extends('layouts.app')

@section('template_title')
    Featured Dish
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Featured Dish') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('featured-dishes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Featured Id</th>
										<th>Dish Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($featuredDishes as $featuredDish)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $featuredDish->featured_id }}</td>
											<td>{{ $featuredDish->dish_id }}</td>

                                            <td>
                                                <form action="{{ route('featured-dishes.destroy',$featuredDish->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('featured-dishes.show',$featuredDish->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('featured-dishes.edit',$featuredDish->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $featuredDishes->links() !!}
            </div>
        </div>
    </div>
@endsection
