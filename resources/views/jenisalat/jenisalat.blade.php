@extends('layouts.template')
@section('content')
<section class="content">
  {{-- <div >
    {{Breadcrumbs::render('jenisalat')}}
  </div> --}}
    <div class="card">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
           <h3 class="card-title"><b><br>Daftar Jenis Alat</b></h3>
          </div>
          <div class="card-body">
            <div class="row d-flex justify-between" style="width: 100%; justify-content: space-between; align-items: center; margin: 0">
              <a href="{{url('jenisalat/create')}}" class="btn -btn sm btn-success my-2">Tambah Data</a>
            </div>
            <table class="table table-bordered table-striped " id="data_jenisalat">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Jenis Alat</th>
                  <th>Setting</th>
                  {{-- <th>Harga</th> --}}
                  <th>Aksi</th>
                </tr>
              </thead>
            </table>
          </div>
      </div>
    </div>
</section>
@endsection
@section('mainjs')
<script>
    $(document).on('click', '.btn-delete', function () {
                let id = $(this).data('id');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Setelah dihapus, Anda tidak dapat memulihkan Data ini lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',

        }).then((result) => {
          if(result.isConfirmed){
            var form = $('<form>').attr({
                            action: "{{url('jenisalat')}}/" + id,
                            method: 'POST',
                            class: 'delete-form'
                        }).append('@csrf', '@method("DELETE")');
                        form.appendTo('body').submit();
          }

        })

    });
    $(document).ready(function (){
      var data = $('#data_jenisalat').DataTable();
      data.destroy();
        var data = $('#data_jenisalat').DataTable({
            processing:true,
            serverside:true,
            ajax:{
                'url': '{{  url('jenisalat/data') }}',
                'dataType': 'json',
                'type': 'POST',
            },
            columns:[
                {data:'id',searchable:false,sortable:false},
                {data:'namajenis',name:'namajenis',searchable:true,sortable:true},
                {data:'setting',name:'setting',searchable:true,sortable:true},
                //  {data: 'foto',name: 'foto',sortable: false,searchable: false,render: function(data, type, row, meta) {return "<img src=\"{{ asset('storage') }}/" + data +
                //      "\" height=\"auto\" width=\"100px\" alt=\"foto jenisalat\">";
                //    }
                //   },
                // {data:'harga',name:'harga',searchable:true,sortable:true},
                {data:'id',name:'id',searchable:false,sortable:false,
                render: function(data, type, row, meta){
                  return '<a href="{{url('jenisalat')}}/' + data + '/edit" class="btn btn-warning btn-sm mr-1"><i class="fa fa-edit"></i> </a>' +
                                '<button class="btn btn-danger btn-sm btn-delete" data-id="' + data + '"><i class="fa fa-trash"></i> </button>';
                    }
                }
            ]
        });
    });

</script>

@endsection
