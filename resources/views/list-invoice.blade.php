@extends('layouts.app')

@section('title', 'Invoices')

@section('sidebar')
    @parent
    <h2>Invoices</h2>
@endsection

@section('content')
    <button onclick="window.location='{{ route('invoice.create') }}'">Create</button>

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
                            <button onclick="window.location='{{ route('invoice.show', $d) }}'">Show</button>
                            <button onclick="window.location='{{ route('invoice.edit', $d) }}'">Edit</button>
                            <form action="{{ route('invoice.destroy', $d) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete the invoice {{$d->Name}}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
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
        <table id="data-table-2">
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
        <table id="documentListTable">
            <thead>
            </thead>

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
            ordering: true
        }); 


        

        // Initialize DataTable with AJAX
        $('#data-table-2').DataTable({
            processing: true,
            // serverSide: true,
            ordering: true,
            searching: true,
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
                            <button onclick="window.location='${row.show_url}'">Show</button>
                            <button onclick="window.location='${row.edit_url}'">Edit</button>
                            <form action="${row.delete_url}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete the invoice ${row.Name}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        `;
                    }
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
                     data: "Name"
                 },
                //  {
                //      data: "created_at",
                //      render: function(data, type, row) {
                //          var day = moment(data);

                //          if(!day.isValid())
                //              return "";

                //          return day.format("{{ isset($settings->DatetimeFormat) ? $settings->DatetimeFormat : "DD.MM.Y H:mm:ss" }}");
                //      }
                //  },
                //  {
                //      render: function(data, type, row) {
                //          return '<button class="btn btn-secondary downloadDocument" data-id="'+row.id+'" title="Downloaden"><i class="fas fa-file-download"></i></button>';
                //      },
                //      class: "dt-center"
                //  },
                //  {
                //      render: function(data, type, row) {
                //          return '<button class="btn btn-secondary deleteDocument" type="button" data-id="'+row.id+'" title="Löschen"><i class="fas fa-minus"></i></button>';
                //      },
                //      class: "dt-center"
                //  }
             ],
            //  columnDefs: [
            //      {
            //          "targets": [2,3],
            //          "orderable": false
            //      },
            //                  {
            //                      "targets": [9],
            //                      "createdCell": function (td, cellData, rowData, row, col)
            //                      {
            //                          if (rowData.USER_FREIGABE1 !== null)
            //                          {
            //                              if(String(rowData.STATUS_FREIGABE1).toUpperCase().trim() == 'N')
            //                                  $(td).css('background-color', 'LightCoral');
            //                              else if(String(rowData.STATUS_FREIGABE1).toUpperCase().trim() == 'F')
            //                                  $(td).css('background-color', 'LightGreen');
            //                              else
            //                                  $(td).css('background-color', 'Cornsilk ');
            //                          }
            //                      }
            //                  },

            //  ],
             order: [[0, 'asc']],
             autoWidth: false,
        });
    });
</script>
@endsection


