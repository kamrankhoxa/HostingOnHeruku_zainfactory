@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Supplier List') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <table id="suppliers-list" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            
                            <tr>
                                <th>Name</th>
                                <th>Phone No</th>
                                <th>Address</th>
                                <th>Address1</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Options</th>
                            </tr>
                           
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $item)
                             <tr>
                                <td><?php echo $item['name']; ?></td>
                                <td><?php echo $item['phno']; ?></td>
                                <td><?php echo $item['address']; ?></td>
                                <td><?php echo $item['address1']; ?></td>
                                <td><?php echo $item['state']; ?></td>
                                <td><?php echo $item['city']; ?></td>
                                <td><?php echo $item['created_at']->format('d-M-Y'); ?></td>
                                <td><?php echo $item['updated_at']->format('d-M-Y'); ?></td>
                                <td><a href="{{route('suppliers-e',$item['id'])}}">X</a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Phone No</th>
                                <th>Address</th>
                                <th>Address1</th>
                                <th>State</th>
                                <th>City</th>
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
