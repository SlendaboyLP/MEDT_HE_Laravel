@extends('layouts.app')

@section('title', 'Invoices')

@section('sidebar')
    @parent
    <h2>Invoices</h2>
@endsection

@section('content')
    <button class="btn btn-secondary" onclick="window.location='{{ route('invoice.create') }}'">Create</button>

    <div id="tables-container-1">
        <h3>Table 1</h3>
        <table id="table_data" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td>{{$d->id}}</td>
                        <td>{{$d->Name}}</td>
                        <td>
                            <button class="btn btn-secondary" onclick="window.location='{{ route('invoice.show', $d) }}'">Show</button>
                            <button class="btn btn-secondary" onclick="window.location='{{ route('invoice.edit', $d) }}'">Edit</button>
                            <form action="{{ route('invoice.destroy', $d) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete the invoice {{$d->Name}}?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-secondary" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
            
    </div>

    <br>
    <hr>
    <br>
   
    <div id="tables-container-2">
        <h3>Table 2</h3>
        <table id="data-table-2" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>


            <tbody>

            </tbody>
        </table>
    </div>

    <br>
    <hr>
    <br>    

    <div id="tables-container-3">
        <h3>Table 3</h3>
        <table id="documentListTable" class="display">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Clearing Date</th>
                    <th>User Clearing</th>
                    <th>Download</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tfoot>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Created At</th>

        </tr>
    </tfoot>

            <tbody>
            </tbody>
        </table>
    </div>




@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        console.log('Document ready');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        
        $('#table_data').DataTable({
            processing: true,
            searching: true,
            ordering: true,
            pageLength:5,
            language: {
                processing: '<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>', // Custom loading spinner
                loadingRecords: "Loading data, please wait..." // Loading message
            },
            
        }); 


        

        // Initialize DataTable with AJAX
        $('#data-table-2').DataTable({
            processing: true,
            // serverSide: true,
            ordering: true,
            searching: true,
            language: {
                processing: '<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div></div>', // Custom loading spinner
                loadingRecords: "Loading data, please wait..." // Loading message
            },
            pageLength: 5,
            ajax: {
                url: "{{ route('invoice.data') }}",
                type: 'POST',
                error: function(xhr, error, code) {
                    console.error('AJAX Error:', xhr.responseText);
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'Name', name: 'Name' },
                { 
                    data: null,
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-secondary" onclick="window.location='${row.show_url}'">Show</button>
                            <button class="btn btn-secondary onclick="window.location='${row.edit_url}'">Edit</button>
                            <form action="${row.delete_url}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete the invoice ${row.Name}?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-secondary" type="submit">Delete</button>
                            </form>
                        `;
                    },

                        
                }
            ]
        });


        // 3. gleich wie 2. als serverside processing

        documentListTable = $("#documentListTable").DataTable({
            ajax: {
                "url": "{{ route('invoice.data') }}",
                "type": "POST"
            },
            columns: [
                {
                    data: "id"
                },
                {
                    data: "Name"
                },
                {
                    data: "created_at",
                    render: function(data, type, row) {
                        if (type === 'display' && data) {
                            const date = new Date(data);
                            if (isNaN(date)) return data;
                            return date.toLocaleDateString('de-DE'); // Format as dd.mm.yyyy
                        }
                        return data;
                    }
                },
                {
                    data: "ClearingDate",
                    render: function(data, type, row) {
                        if (type === 'display' && data) {
                            const date = new Date(data);
                            if (isNaN(date)) return data;
                            return date.toLocaleDateString('de-DE'); // Format as dd.mm.yyyy
                        }
                        return data;
                    }
                },
                {
                    data: "UserClearing",
                    createdCell: function(td, cellData, rowData, row, col) {
                        if (!cellData || cellData.trim() === "") {
                            $(td).css("background-color", "red"); // Set background to red if empty
                        } else {
                            $(td).css("background-color", "green"); // Set background to green if not empty
                        }
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `    
                            <button class="btn btn-secondary downloadDocument" data-id="${row.id}" title="Download">
                                <i class="fas fa-file-download"></i> Download
                            </button>
                        `;
                    },
                    class: "dt-center"
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-secondary deleteDocument" type="button" data-id="${row.id}" title="Delete">
                                <i class="fas fa-minus"></i> Delete
                            </button>
                        `;
                    },
                    class: "dt-center"
                }
            ],
            pageLength: 5,
            order: [[0, 'asc']],
            autoWidth: false,
            processing: true,
            language: {
                processing: '<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>',
                loadingRecords: "Loading data, please wait..."
            },
            initComplete: function() {
                // Add a search input for each column
                this.api().columns().every(function() {
                    var column = this;
                    var input = $('<input type="text" placeholder="Search ' + $(column.header()).text() + '" />')
                        .appendTo($(column.footer()).empty())
                        .on('keyup change clear', function() {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });
                });
            }
        });
    });
</script>
@endsection


