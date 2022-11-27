@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Expense') }}</div>
            <div class="card-body">
    <form action="{{ route('expense-c') }}" method="POST">
        @csrf
    <div class="form-row">
      
      <div class="form-group col-md-4">
        <label for="supplier_id">Supplier</label>
        <select  name= 'supplier_id' class="form-control" required>
        <option value="" disabled selected>Select The Supplier</option>
        @foreach($suppliers as $item)
        <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
        </select>
      </div> 

      <div class="form-group col-md-6">
        <label for="Date">Date</label>
        <input type="date" class="form-control" name='date' required>
      </div>

      <div class="form-group col-md-6">
        <label for="title">Title</label>
        <input type="text" class="form-control" name='title' placeholder="Product Name" required>
      </div>
      <div class="form-group col-md-6">
        <label for="title">Description</label>
        <input type="text" class="form-control" name='description' placeholder="Product Description" required>
      </div>
      <div class="form-group col-md-6">
        <label for="title">Quantity</label>
        <input type="number" class="form-control" name='quantity' value="0" required>
      </div>
      <div class="form-group col-md-6">
        <label for="title">Amount</label>
        <input type="number" class="form-control" name='amount' value="0" required>
      </div>
      <div class="form-group col-md-6">
        <label for="title">Submit</label>
        <input type="number" class="form-control" name='submit' value="0" required>
      </div>
        
        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
        <button type="submit" name="add_expense" class="btn btn-primary mt-2">Add to List</button>
    </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
