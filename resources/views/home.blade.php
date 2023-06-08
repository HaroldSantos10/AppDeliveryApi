@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
 
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data"  class="form-container">
                @csrf
                <h5 class="text-center">Create Category</h5>

                <label for="name">Name</label> 
                <input type="text" name="name" id="name" />
                @error('name')
                    <div class= "error-message">{{ $message }} </div>
                @enderror
                
                <label for="image">Image</label> 
                <input type="file" accept="image/*" name="image" id="image" />
                @error('image')
                <div class= "error-message">{{ $message }} </div>
                @enderror
                
                <div class="mb-3">
                    <br>
                    <button class="btn btn-secondary text-center" type="submit">Create</button>
                </div>
            </form>
        </div>

    </div>


</div>

@endsection
    <style>
    
    .form-container {
        max-width: 400px; 
        margin: 0 auto; 
        padding: 20px; 
        border: 1px solid #ddd; 
        border-radius: 5px; 
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        background-color: #fff; 
    }
    

    .form-container h2 {
        font-size: 24px; 
        margin-bottom: 20px; 
        text-align: center; 
    }
    

    .form-container label, 
    .form-container input[type="text"], 
    .form-container input[type="password"] {
        display: block; 
        width: 100%; 
        margin-bottom: 10px; 
    }
    

    </style>