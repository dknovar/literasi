@extends('layout.app')

@section('title','Daftar Literasi')


@section('content')

<section class="content">
@if (!empty(session('sukses')))
<div class="alert-sukses"></div>
@endif
@if (!empty(session('error')))
<div class="alert-gagal"></div>
@endif
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <button type="button" class="btn btn-md btn-sm btn-primary">
                        Jumlah Data <span class="badge badge-light">{{$jml}}</span>
                    </button>
                </div>
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <button type="button" class="btn btn-md btn-sm btn-primary" id="tambah-data">
                        <i class="fa fa-user mr-2"></i>
                        Tambah Literasi
                    </button>
                </div>
            </h3>

            {{-- <div class="card-tools">
                <input type="text" class="form-control" placeholder="Search">
            </div> --}}
        </div>
        <div class="card-body">
            <table id="tableLiterasi" class="table table-sm table-bordered table-hover table-responsive">
                <thead class="text-center">
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Tgl</th>
                        {{-- <th scope="col">Nama Siswa</th> --}}
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Guru</th>

                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="data-siswa">
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($data as $item)
                    @php
                        $i++;
                    @endphp
                    <tr class="text-center" id="literasi_id_{{$item->id}}">
                        <td class="text-center" width="6%">{{$i}}</td>
                        <td>{{\Carbon\Carbon::parse($item->tanggal)->format('d/m/Y H:i')}}</td>
                        {{-- <td>{{$item->siswa}}</td> --}}
                        <td>{{$item->judul}}</td>
                        <td>{{$item->guru}}</td>
                        <td class="text-center" width="1%">
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                <button class="btn btn-info btn-sm detail-data" id="detail-data" data-id="{{$item->id}}" title="Detail"><i class="fa fa-eye"></i></button>
                                <button class="btn btn-primary btn-sm edit-data" id="edit-data" data-id="{{$item->id}}" title="Edit Literasi"><i class="fa fa-pen"></i></button>
                                <button class="btn btn-danger btn-sm delete-data" id="delete-data" data-id="{{$item->id}}" title="Hapus Literasi"><i class="fa fa-trash"></i></button>
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

                </div>
            </div>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>


<!-- Modal INPUT DAN EDIT-->
<div class="modal fade" id="modalaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formliterasi" name="formliterasi">
                    <input type="hidden" name="id_letrasi" id="id_letrasi">
                    <div class="row">
                        {{-- <div class="col-md-12">
                            <div class="input-group">
                                <select name="id_siswa" id="id_siswa" class="form-control select2"  style="width: 80%;">
                                    @if ($datasiswa->count() > 0)
                                    <option value="" selected disabled>Pilih Nama Siswa..</option>
                                    @foreach ($datasiswa as $s)

                                    <option value="{{$s->id}}">{{$s->name}} -kelas</option>
                                    @endforeach

                                    @else
                                    <option value="" disabled>Data Siswa Belum Ada</option>
                                    @endif

                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-users"></i></span>
                                </div>
                            </div>

                        </div> --}}
                        <br>
                        {{-- <br>
                        <br> --}}

                        <div class="col-md-12">
                            <div class="input-group">
                                <select name="id_guru" id="id_guru" class="form-control select2" style="width: 80%;">
                                    {{-- @if ($dataguru->count() > 0) --}}
                                    <option value="" selected disabled>Pilih Nama Guru..</option>
                                    @foreach ($dataguru as $guru)

                                    <option value="{{$guru->id}}">{{$guru->name}}</option>
                                    @endforeach

                                    {{-- @else
                                    <option value="" disabled>Data Guru Belum Ada</option>
                                    @endif --}}

                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                            </div>

                        </div>
                        <br>
                        <br>
                        <br>

                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" class="form-control" id="judulbuku" name="judulbuku" required
                                    placeholder="Masukkan Judul Buku">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-book"></i></span>
                                </div>
                            </div>

                        </div>
                        <br>
                        <br>
                        <br>

                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" class="form-control" id="halaman" name="halaman" required
                                    placeholder="Masukkan Halaman Buku">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-book-open"></i></span>
                                </div>
                            </div>

                        </div>
                        <br>
                        <br>
                        <br>

                        <div class="col-md-12">
                            <div class="input-group">
                                <textarea name="review" id="review" cols="30" rows="2" class="form-control"
                                    placeholder="Review Buku"></textarea>
                            </div>

                        </div>
                        <br>
                        <br>
                        <br>
                        <br>

                        <div class="col-md-12">
                            <div class="input-group">
                                <textarea name="ket" id="ket" cols="30" rows="2" class="form-control"
                                    placeholder="Keterangan Buku"></textarea>
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

<!-- Modal Detail-->
<div class="modal fade" id="modalaDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body col-md-12">
                <form class="form-horizontal">
                    <div class="form-group row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tanggal" placeholder="Tanggal" disabled>
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="nama_siswa" class="col-sm-2 col-form-label">Nama Siswa</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_siswa" placeholder="Name" disabled>
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kelas2" placeholder="Kelas" disabled>
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="nama_siswa" class="col-sm-2 col-form-label">Nama Guru</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_guru" placeholder="Nama Guru" disabled>
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul Buku</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="judul2" placeholder="Judul Buku" disabled>
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="halaman" class="col-sm-2 col-form-label">Halaman</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="halaman2" placeholder="Halaman" disabled>
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="review" class="col-sm-2 col-form-label">Review</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="review2" placeholder="Review" disabled></textarea>
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="ket" class="col-sm-2 col-form-label">Kritik/Saran</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="ket2" placeholder="Kritik/Saran" disabled></textarea>
                    </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- end modal --}}

<script>
    $(function () {
    $('.select2').select2()

      $("#tableLiterasi").DataTable({
        // "order": [[1, 'desc']],
        "columnDefs": [{
        "targets": 4,
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
          $('#formliterasi').trigger("reset");
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

        $(".detail-data").click(function(){
            var literasi_id=$(this).data('id');
            $.get('literasi-siswa/'+literasi_id,function(data){
                console.log(data)

                $("#tanggal").val(data.tanggal);
                $("#nama_siswa").val(data.siswa);
                $("#nama_guru").val(data.guru);
                $("#kelas2").val(data.kelas);
                $("#judul2").val(data.judul);
                $("#halaman2").val(data.halaman);
                $("#review2").val(data.review);
                $("#ket2").val(data.ket);

                $("#modalaDetail").modal("show");
                $(".modal-title").text("Detail Literasi");
            // $("#action-button").text("Simpan Perubahan");
            });
        })

        $(".edit-data").click(function(){
          
            var literasi_id=$(this).data('id');
            $.get('literasi-siswa/'+literasi_id+'/edit',function(data){

              var id_guru = document.getElementById("id_guru");
              var options = id_guru.options;
              guru_id = data.id_guru;
              for (var i = 0; i < options.length; i++) {
                if (options[i].value == guru_id) {
                    id_guru.selectedIndex = i;
                  }
              }
            $("#id_letrasi").val(data.id);
            $("#id_siswa").val(data.id_siswa);
            $("#id_guru").val(data.id_guru);
            $("#judulbuku").val(data.judul);
            $("#halaman").val(data.halaman);
            $("#review").val(data.review);
            $("#ket").val(data.ket);

            $("#modalaction").modal("show");
            $(".modal-title").text("Edit Data Literasi");
            $("#action-button").text("Simpan Perubahan");
            
            });
        })

        $(".delete-data").click(function(){
            var id_literasi=$(this).data('id');
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
              url: "literasi-siswa/"+id_literasi,
              success: function (data) {
                console.log(data);
                  $("#literasi_id_" + id_literasi).remove();
                  toastr.success("Data literasi berhasil dihapus")
                  setTimeout(function() {
                    // Do something after 3 seconds
                    // This can be direct code, or call to some other function
                    location.reload();
                    }, 1000);
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
          
          $(".edit-password").click(function(){
            var siswa_id=$(this).data('id');
            // alert(siswa_id);
            $("#modalPass").modal("show");
            $(".modal-title").text("Ganti Password");
            $("#buttonPass").text("Simpan");
            $("#id_user").val(siswa_id);
          })
    });



if ($("#formliterasi").length > 0) {
      $("#formliterasi").validate({
 
     submitHandler: function(form) {

      var actionType = $('#action-button').val();
      $('#action-button').html('Sending..');

      data= $('#formliterasi').serialize();
      // alert(data);
      $.ajax({
          data: $('#formliterasi').serialize(),
          url: "{{ route('literasi-siswa.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
            // alert("Berhasil");
            console.log(data);
            // toastr.success("Berhasil");
            // var siswa='<tr id="siswa_id_'+data.id+'"><th scope="row">'+ data.id +'</th><td>'+ data.nis +'</td><td>'+ data.name +'</td><td>'+ data.kelas +'</td>';
            //  siswa+='<td class="text-center" width="1%"><div class="btn-group mr-2" role="group" aria-label="First group"><button class="btn btn-danger btn-sm" id="delete-data" data-id="'+ data.id +'"><i class="fa fa-trash"></i></button><button class="btn btn-primary btn-sm" id="edit-data" data-id="'+ data.id +'"><i class="fa fa-pen"></i></button></div></td></tr>';
               
              
            //   if (actionType == "tambah-data") {
            //       $('#siswa_id').prepend(post);
            //   } else {
            //       $("#siswa_id_" + data.id).replaceWith(post);
            //   }
              $('#formliterasi').trigger("reset");
              $('#modalaction').modal('hide');
              $("#action-button").text("Tambah Data");
              toastr.success("Data Literasi berhasil disimpan")
                setTimeout(function() {
                // Do something after 3 seconds
                // This can be direct code, or call to some other function
                location.reload();
                }, 1000);
          },
          error: function (data) {
              alert("Upss! Ada Error");
              console.log('Error:', data);
              // toastr.error("Upss! Ada Error");
              $('#btn-save').html('Save Changes');
          }
      });
    }
  })
}

</script>
@endsection
