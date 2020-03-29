@extends('layout.app')

@section('title','Daftar Guru')


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
                      Jumlah Data <span class="badge badge-light">{{$guru->count()}}</span>
                    </button>
              </div>
              <div class="btn-group mr-2" role="group" aria-label="First group">
                  <button type="button" class="btn btn-md btn-sm btn-primary" id="tambah-data">
                      <i class="fa fa-user mr-2"></i>
                      Tambah Guru
                    </button>
              </div>
              </h3>
    
              {{-- <div class="card-tools">
               <input type="text" class="form-control" placeholder="Search">
              </div> --}}
            </div>
            <div class="card-body">
              <table id="tableGuru" class="table table-sm table-bordered table-hover table-responsive">
                <thead class="text-center">
                  <tr>
                    <th scope="col"  class="text-center">No</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Nama</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody id="data-siswa">
                  @php
                      $i = 0;
                  @endphp
                  @foreach ($guru as $item)
                  @php
                      $i++;
                  @endphp
                    <tr id="guru_id_{{$item->id}}">
                      <td class="text-center" width="6%">{{$i}}</td>
                      <td>{{$item->nip}}</td>
                      <td>{{$item->name}}</td>
                      <td class="text-center" width="1%">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button class="btn btn-primary btn-md btn-sm edit-data" id="edit-data" data-id="{{$item->id}}" title="Edit Guru"><i class="fa fa-pen"></i></button>
                            <button class="btn btn-info btn-md btn-sm edit-password" id="edit-password" data-id="{{$item->id_users}}" title="Ganti Password"><i class="fa fa-lock"></i></button>
                            <button class="btn btn-danger btn-md btn-sm delete-data" id="delete-data" data-id="{{$item->id}}" title="Hapus Guru"><i class="fa fa-trash"></i></button>
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
                  {{-- {{$guru->links()}} --}}
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
        <form id="formguru" name="formguru">
            <input type="hidden" name="id_guru" id="id_guru">
            <input type="hidden" name="id_users" id="id_users">
            <div class="row">

              <div class="col-md-12">
                <div class="input-group">
                    <input type="text" class="form-control" id="nip" name="nip" required placeholder="Masukkan NIP/Username">
                    <div class="input-group-append">    
                      <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                    </div>
              </div>
              
              </div>
              <br>
              <br>

                <div class="col-md-12">
                  <div class="input-group">
                      <input type="text" class="form-control" id="name" name="name" required placeholder="Masukkan Nama Guru">
                      <div class="input-group-append">    
                        <span class="input-group-text"><i class="fa fa-users"></i></span>
                      </div>
                </div>
                
              </div>
                          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary tombolClose" >Close</button>
        <button type="sumbit" class="btn btn-primary" id="action-button"></button>
      </div>
      </form>
    </div>
  </div>
</div>
{{-- end modal --}}

{{-- modal ganti password --}}
<div class="modal fade" id="modalPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formPass" name="formPass">
            <input type="hidden" name="id_user" id="id_user" value="">
            <div class="row">

              <div class="col-md-12">
                <div class="input-group">
                      <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan Password Baru">
                      <div class="input-group-append">    
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                      </div>
                </div>
                
              </div>               
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
        <button type="sumbit" class="btn btn-primary" id="buttonPass"></button>
      </div>
      </form>
    </div>
  </div>
</div>
{{-- end modal --}}
<script>
  $(function () {
    $("#tableGuru").DataTable({
      "order": [[2, 'asc']],
      "columnDefs": [{
      "targets": 3,
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
        $('#formguru').trigger("reset");
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
        
          var siswa_id=$(this).data('id');
          $.get('guru/'+siswa_id+'/edit',function(data){
            
          $("#id_guru").val(data.id);
          $("#id_users").val(data.id_users);
          $("#name").val(data.name);
          $("#nip").val(data.nip);

          $("#modalaction").modal("show");
          $(".modal-title").text("Edit Data Guru");
          $("#action-button").text("Simpan Perubahan");
          
          });
      })

      $(".delete-data").click(function(){
          var id_guru=$(this).data('id');
            Swal.fire({
            title: 'Anda Yakin?',
            text: "Anda akan kehilangan data tersebut!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
            type: "DELETE",
            url: "guru/"+id_guru,
            success: function (data) {
              console.log(data);
                $("#guru_id_" + id_guru).remove();
                toastr.success("Data Guru berhasil dihapus")
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
              Swal.fire(
                'Sukses!',
                'Hapus Data Berhasil Dilakukan !',
                'success'
              )
            }
            else if (
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
        $(".edit-password").click(function(){
          var guru_id=$(this).data('id');
          // alert(siswa_id);
          $("#modalPass").modal("show");
          $(".modal-title").text("Ganti Password");
          $("#buttonPass").text("Simpan");
          $("#id_user").val(guru_id);
        })
  });



if ($("#formguru").length > 0) {
    $("#formguru").validate({

   submitHandler: function(form) {

    var actionType = $('#action-button').val();
    $('#action-button').html('Sending..');

    data= $('#formguru').serialize();
    // alert(data);
    $.ajax({
        data: $('#formguru').serialize(),
        url: "{{ route('guru.store') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          toastr.success("Data Guru berhasil disimpan")
          console.log(data);
          // toastr.success("Berhasil");
          // var siswa='<tr id="siswa_id_'+data.id+'"><th scope="row">'+ data.id +'</th><td>'+ data.nis +'</td><td>'+ data.name +'</td><td>'+ data.kelas +'</td>';
          //  siswa+='<td class="text-center" width="1%"><div class="btn-group mr-2" role="group" aria-label="First group"><button class="btn btn-danger btn-sm" id="delete-data" data-id="'+ data.id +'"><i class="fa fa-trash"></i></button><button class="btn btn-primary btn-sm" id="edit-data" data-id="'+ data.id +'"><i class="fa fa-pen"></i></button></div></td></tr>';
             
            
          //   if (actionType == "tambah-data") {
          //       $('#siswa_id').prepend(post);
          //   } else {
          //       $("#siswa_id_" + data.id).replaceWith(post);
          //   }
            $('#formguru').trigger("reset");
            $('#modalaction').modal('hide');
            $("#action-button").text("Tambah Data");
            setTimeout(function() {
                    // Do something after 3 seconds
                    // This can be direct code, or call to some other function
                    location.reload();
                    }, 3000);
        },
        error: function (data) {
           toastr.error("Ada Kesalahan Teknis, Coba Lagi!")
            console.log('Error:', data);
            // toastr.error("Upss! Ada Error");
            $('#btn-save').html('Save Changes');
        }
    });
  }
})
}
if ($("#formPass").length > 0) {
    $("#formPass").validate({

   submitHandler: function(form) {

    var actionType = $('#buttonPass').val();
    $('#buttonPass').html('Sending..');

    data= $('#formPass').serialize();
    // alert(data);
    $.ajax({
        data: $('#formPass').serialize(),
        url: "{{ route('guru.gantipass') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          // alert(data);
          console.log(data);
         toastr.success("Password Berhasil di Update");
          // toastr.success("Ubah Password Berhasil");
          // var siswa='<tr id="siswa_id_'+data.id+'"><th scope="row">'+ data.id +'</th><td>'+ data.nis +'</td><td>'+ data.name +'</td><td>'+ data.kelas +'</td>';
          //  siswa+='<td class="text-center" width="1%"><div class="btn-group mr-2" role="group" aria-label="First group"><button class="btn btn-danger btn-sm" id="delete-data" data-id="'+ data.id +'"><i class="fa fa-trash"></i></button><button class="btn btn-primary btn-sm" id="edit-data" data-id="'+ data.id +'"><i class="fa fa-pen"></i></button></div></td></tr>';
             
            
          //   if (actionType == "tambah-data") {
          //       $('#siswa_id').prepend(post);
          //   } else {
          //       $("#siswa_id_" + data.id).replaceWith(post);
          //   }
            $('#formsiswa').trigger("reset");
            $('#modalaction').modal('hide');
            $("#action-button").text("Tambah Data");
            setTimeout(function() {
                    // Do something after 3 seconds
                    // This can be direct code, or call to some other function
                    location.reload();
                    }, 3000);
        },
        error: function (data) {
            // alert(data->responseText);
            console.log('Error:', data);
            // toastr.error("Upss! Ada Error");
            alert("Upss! Ada Error");
            $('#btn-save').html('Save Changes');
        }
    });
  }
})
}
</script>
@endsection
    