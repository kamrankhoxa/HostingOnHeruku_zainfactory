@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Buyers') }}</div>
            <div class="card-body">
    <form action="{{ route('buyers-u') }}" method="POST">
        @csrf
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="name">Shop Name</label>
        <input type="text" class="form-control" id="name" name='shop_name' placeholder="Shop Name" value="{{$buyers->shop_name}}" required>
      </div>
        <div class="form-group col-md-6">
          <label for="name">Name</label>
          <input type="hidden" class="form-control" name='id' value="{{$buyers->id}}" required>
          <input type="text" class="form-control" id="name" name='name' placeholder="Name" value="{{$buyers->name}}" required>
        </div>
        <div class="form-group col-md-6">
          <label for="Phno">Phno</label>
          <input type="tel" class="form-control" name='phno' id="phno" placeholder="033466*****" value="{{$buyers->phno}}" required>
        </div>
      </div>
      <div class="form-group col-md-6">
        <label for="inputAddress">Address</label>
        <input type="text" class="form-control" name='address' id="inputAddress" placeholder="1234 Main St" value="{{$buyers->address}}" required>
      </div>
      <div class="form-group col-md-6">
        <label for="inputAddress2">Address 2</label>
        <input type="text" class="form-control" name='address1' id="inputAddress2" placeholder="Apartment, studio, or floor" value="{{$buyers->address1}}" required>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputCity">City</label>
          <input type="text" class="form-control" name='city' id="inputAddress2" placeholder="Apartment, studio, or floor" value="{{$buyers->city}}" required>
        </div>
        <div class="form-group col-md-4">
          <label for="inputState">State</label>
          <input type="text" class="form-control" name='state' id="inputAddress2" placeholder="Apartment, studio, or floor" value="{{$buyers->state}}" required>
        </div>
        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

        <button type="submit" name="update_buyers" class="btn btn-primary mt-2">Update</button>

        
    </form>
    <form action="{{ route('buyers-d') }}" method="POST" onsubmit="return confirm('Do you really want to delete?');" >
      @csrf
      <input type="hidden" class="form-control" name='id' value="{{$buyers->id}}" required>
      <button type="submit" name="delete_buyers" class="btn btn-primary mt-2">Delete</button>
    </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
