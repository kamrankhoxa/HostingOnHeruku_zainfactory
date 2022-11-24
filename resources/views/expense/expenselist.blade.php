@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Expenses List') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <table id="suppliers-list" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            
                            <tr>
                                <th>Title</th>
                                <th>Description No</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Submit</th>
                                <th>Supplier</th>
                                <th>User</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Options</th>
                            </tr>
                           
                        </thead>
                        <tbody>
                            @foreach ($expense as $item)
                             <tr>
                                <td><?php echo $item['title']; ?></td>
                                <td><?php echo $item['description']; ?></td>
                                <td><?php echo $item['quantity']; ?></td>
                                <td><?php echo $item['amount']; ?></td>
                                <td><?php echo $item['submit']; ?></td>
                                @php $supplier = \App\Models\Suppliers::where(['id' => $item['supplier_id']])->first() @endphp
                                <td><a href="{{route('suppliers-e',$item['supplier_id'])}}">{{$supplier->name}}</a></td>
                                @php $value = \App\Models\User::where(['id' => $item['user_id']])->first() @endphp
                                <td>{{$value->name}}</td>
                                <td><?php echo $item['created_at']->format('d-M-Y'); ?></td>
                                <td><?php echo $item['updated_at']->format('d-M-Y'); ?></td>
                                <td><a href="{{route('expense-e',$item['id'])}}">X</a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Description No</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Submit</th>
                                <th>Supplier</th>
                                <th>User</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Options</th>
                            </tr>
                        </tfoot>
                    </table>
                    <script>
                $(document).ready(function() {
                    $('#suppliers-list').DataTable( {
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'pdfHtml5',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5 ]
                                }
                            },
                            'colvis'
                        ],
                        responsive: true,
                        //select: true,
                    } );
                } );
                    </script>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
