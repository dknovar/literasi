@extends('layout.app')

@section('title','Daftar Kelas')


@section('content')  

@if (!empty(session('sukses')))
  <div class="alert-sukses"></div>
@endif
@if (!empty(session('error')))
  <div class="alert-gagal"></div>
@endif
        <!-- Main content -->
        <section class="content">
    
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                  <button type="button" class="btn btn-md btn-sm btn-info">
                      Jumlah Data <span class="badge badge-light">{{$kelas->count()}}</span>
                    </button>
              </div>
              <div class="btn-group mr-2" role="group" aria-label="First group">
                  <button type="button" class="btn btn-md btn-sm btn-primary" id="tambah-data">
                      <i class="fa fa-home mr-2"></i>
                      Tambah Kelas
                    </button>
              </div>
              </h3>
    
              {{-- <div class="card-tools">
               <input type="text" class="form-control" placeholder="Search">
              </div> --}}
            </div>
            <div class="card-body">
              <table id="tabelKLS" class="table table-sm table-bordered table-hover table-responsive">
                <thead class="text-center">
                  <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col" class="text-center">Nama Kelas</th>
                    
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody id="data-kelas">
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($kelas as $item)
                    @php
                        $i++;
                    @endphp
                    <tr id="kelas_id_{{$item->id}}">
                        <td class="text-center" width="6%">{{$i}}</td>
                        <td class="text-center">{{$item->kelas}}</td>
                        
                        <td class="text-center" width="1%">
                              
                          <div class="btn-group mr-2" role="group" aria-label="First group">
                              <button class="btn btn-danger btn-sm delete-data" id="delete-data" data-id="{{$item->id}}"><i class="fa fa-trash"></i></button>
                              <button class="btn btn-primary btn-sm edit-data" id="edit-data" data-id="{{$item->id}}"><i class="fa fa-pen"></i></button>
                          </div>
                      
                        </td>
                      </tr>
                    @endforeach
                                      
                </tbody>
              </table>
            
          </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                  {{$kelas->links()}}
                </div>
            </div>
            </div>
            <!-- /.card-footer-->
          </div>
          <!-- /.card -->
    
        </section>

<!-- Modal -->
<div class="modal fade" id="modalaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formkelas" name="formkelas">
              <input type="hidden" name="id_kelas" id="id_kelas">
              <div class="row">
                  <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" class="form-control" id="kelas" name="kelas" required placeholder="Masukkan Nama Kelas">
                        <div class="input-group-append">    
                          <span class="input-group-text"><i class="fa fa-users"></i></span>
                        </div>
                  </div>
                  
              </div>
              
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary tombolClose">Close</button>
          <button type="sumbit" class="btn btn-primary" id="action-button"></button>
        </div>
        </form>
      </div>
    </div>
  </div>

<script>
    $(function () {
      $("#tabelKLS").DataTable({
        "order": [[0, 'asc']],
        "columnDefs": [{
        "targets": 2,
        "orderable": false,
        "searching": false,
        }],
      });
    });
</script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $(".tombolClose").click(function(event){
          // alert("weee");
          $('#formkelas').trigger("reset");
          // $("#name").val("");
          // $("#nis").val("");
          // $("#kelas").val("");
          $('#modalaction').modal('hide');
          })

        $("#tambah-data").click(function(){
            $("#modalaction").modal("show");
            $(".modal-title").text("Tambah Data");
            $("#action-button").text("Tambah Data");
        });

        $(".edit-data").click(function(){
            var kelas_id=$(this).data('id');
            $.get('kelas/'+kelas_id+'/edit',function(data){
            $("#modalaction").modal("show");
            $(".modal-title").text("Edit Kelas");
            $("#action-button").text("Simpan Perubahan");
            $("#id_kelas").val(data.id);
            $("#kelas").val(data.kelas);

            });
        })

        $(".delete-data").click(function(){
            var id_kelas=$(this).data('id');

            swal.fire({
              title: 'Anda Yakin?',
              text: "Anda akan kehilangan data tersebut!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!',
              cancelButtonText: 'No, cancel!',
              reverseButtons: true
            }).then((result) => {
              if (result.value) {
                $.ajax({
              type: "DELETE",
              url: "kelas/"+id_kelas,
              success: function (data) {
                console.log(data);
                  $("#kelas_id_" + id_kelas).remove();
                  toastr.success("Data Kelas Berhasil dihapus")
                  setTimeout(function() {
                    // Do something after 3 seconds
                    // This can be direct code, or call to some other function
                    location.reload();
                    }, 3000);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
              });

                swal.fire(
                  'Sukses!',
                  'Hapus Data Berhasil Dilakukan !',
                  'success'
                )
              } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
              ) {
                swal.fire(
                  'Gagal',
                  'Permintaan Hapus Dibatalkan ',
                  'error'
                )
              }
            })  


            
        });
    });



if ($("#formkelas").length > 0) {
      $("#formkelas").validate({
 
     submitHandler: function(form) {

      var actionType = $('#action-button').val();
      $('#action-button').html('Sending..');

      // data=$('#formkelas').serialize();
      // alert(data);
      $.ajax({
          data: $('#formkelas').serialize(),
          url: "{{ route('kelas.store') }}",
          type: "POST",
          dataType: 'json',
          
          success: function (data) {
            console.log(data);
            toastr.success("Data Kelas Berhasil disimpan")
            // toastr.success("Berhasil");
            // var siswa='<tr id="siswa_id_'+data.id+'"><th scope="row">'+ data.id +'</th><td>'+ data.name +'</td><td>'+ data.id_kelas +'</td><td>'+ data.nis +'</td>';
            //  siswa+='<td class="text-center" width="1%"><div class="btn-group mr-2" role="group" aria-label="First group"><button class="btn btn-danger btn-sm" id="delete-data" data-id="'+ data.id +'"><i class="fa fa-trash"></i></button><button class="btn btn-primary btn-sm" id="edit-data" data-id="'+ data.id +'"><i class="fa fa-pen"></i></button></div></td></tr>';
               
              
            //   if (actionType == "tambah-data") {
            //       $('#siswa_id').prepend(post);
            //   } else {
            //       $("#siswa_id_" + data.id).replaceWith(post);
            //   }
 
              $('#formkelas').trigger("reset");
              $('#modalaction').modal('hide');
              $("#action-button").text("Tambah Data");
              setTimeout(function() {
                    // Do something after 3 seconds
                    // This can be direct code, or call to some other function
                    location.reload();
                    }, 3000);
          },
          error: function (data) {
              console.log('Error:', data);
              toastr.error("Ada Kesalahan Teknis, Coba Lagi!")
              $('#btn-save').html('Save Changes');
          }
      });
    }
  })
}
</script>
@endsection
    