@extends('layouts.app')

@section('content') 
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Expense') }}</div>
            <div class="card-body">
    <form action="{{ route('expense-u') }}" method="POST">
        @csrf
    <div class="form-row">

      <div class="form-group col-md-4">
        <label for="supplier_id">Supplier</label>
        <select  name= 'supplier_id' class="form-control" required>
        @foreach($suppliers as $item)
        <option value="{{$item->id}}" @if($item->id == $expense->supplier_id) {{"selected"}} @endif>{{$item->name}}</option>
        @endforeach
        </select>
      </div>

      <div class="form-group col-md-6">
        <label for="Date">Date</label>
        <input type="date" class="form-control" name='date' value="{{$expense->created_at->format('Y-m-d')}}" required>
      </div>

      <div class="form-group col-md-6">
        <label for="title">Title</label>
        <input type="hidden" class="form-control" name='id' value="{{$expense->id}}" required>
        <input type="text" class="form-control" name='title' placeholder="Product Name" value="{{$expense->title}}" required>
      </div>
      <div class="form-group col-md-6">
        <label for="title">Description</label>
        <input type="text" class="form-control" name='description' placeholder="Product Description" value="{{$expense->description}}" required>
      </div>
      <div class="form-group col-md-6">
        <label for="title">Quantity</label>
        <input type="number" class="form-control" name='quantity' value="{{$expense->quantity}}" required>
      </div>
      <div class="form-group col-md-6">
        <label for="title">Amount</label>
        <input type="number" class="form-control" name='amount' value="{{$expense->amount}}" required>
      </div>
      <div class="form-group col-md-6">
        <label for="title">Submit</label>
        <input type="number" class="form-control" name='submit' value="{{$expense->submit}}" required>
      </div>
        
        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <button type="submit" name="update_expense" class="btn btn-primary mt-2">Update</button>

        
                      </form>
                      <form action="{{ route('expense-d') }}" method="POST" onsubmit="return confirm('Do you really want to delete?');" >
                        @csrf
                        <input type="hidden" class="form-control" name='id' value="{{$expense->id}}" required>
                        <button type="submit" name="delete_expense" class="btn btn-primary mt-2">Delete</button>
                      </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
