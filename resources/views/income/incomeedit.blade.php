@extends('layouts.app')

@section('content') 
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Income') }}</div>
            <div class="card-body">
    <form action="{{ route('income-u') }}" method="POST">
        @csrf
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="title">Title</label>
        <input type="hidden" class="form-control" name='id' value="{{$income->id}}" required>
        <input type="text" class="form-control" name='title' placeholder="Product Name" value="{{$income->title}}" required>
      </div>
      <div class="form-group col-md-6">
        <label for="title">Description</label>
        <input type="text" class="form-control" name='description' placeholder="Product Description" value="{{$income->description}}" required>
      </div>
      <div class="form-group col-md-6">
        <label for="title">Quantity</label>
        <input type="number" class="form-control" name='quantity' value="{{$income->quantity}}" required>
      </div>
      <div class="form-group col-md-6">
        <label for="title">Amount</label>
        <input type="number" class="form-control" name='amount' value="{{$income->amount}}" required>
      </div>
      <div class="form-group col-md-6">
        <label for="title">Submit</label>
        <input type="number" class="form-control" name='submit' value="{{$income->submit}}" required>
      </div>
        <div class="form-group col-md-4">
          <label for="buyers_id">Buyers</label>
          <select  name= 'buyers_id' class="form-control" required>
          @foreach($buyers as $item)
          <option value="{{$item->id}}" @if($item->id == $income->buyers_id) {{"selected"}} @endif>{{$item->name}}</option>
          @endforeach
          </select>
        </div>
        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <button type="submit" name="update_income" class="btn btn-primary mt-2">Update</button>

        
                      </form>
                      <form action="{{ route('income-d') }}" method="POST" onsubmit="return confirm('Do you really want to delete?');" >
                        @csrf
                        <input type="hidden" class="form-control" name='id' value="{{$income->id}}" required>
                        <button type="submit" name="delete_income" class="btn btn-primary mt-2">Delete</button>
                      </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
