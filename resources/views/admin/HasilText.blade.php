@extends('admin.Template')
@section('title')
    Hasil Pemilihan | Kilat
@endsection
@section('body')
    <script>
    $(document).ready(function() {
        $("li").removeClass('active');
    $("#hasil_text").addClass('active');
    $("#parent_hasil").addClass('active');
    });
    </script>
<style>
  td {
    padding:5px
  }
</style>

<link rel="stylesheet" href="/css/dataTables.bootstrap.min.css">
<div id="myApp">


  <div class="row">
    <div class="col-md-6">
      <div class="box box-solid">
        <div class="box-header with-border text-light-blue">
          <i class="fa fa-exclamation-circle"></i>
  
          <h3 class="box-title">Suara terbanyak</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table>
              <tr>
                <td>Kandidat no</td>
                <td>:</td>
                <td style="font-weight:450"><span>@{{ no }}</span></td>
              </tr>
              <tr>
                <td>Pasangan kandidat</td>
                <td>:</td>
                <td style="font-weight:450"><span>@{{ nama }}</span></td>
              </tr>
              <tr>
                <td>Jumlah Suara</td>
                <td>:</td>
                <td style="font-weight:450"><span>@{{ suara }}</span> Suara</td>
              </tr>
            </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- ./col -->
  </div>


<div class="box">
    <div class="box-header">
      <h3 class="box-title">Hasil Pemilihan Ketua Kilat<button class="btn btn-default btn-flat" style="padding:5px;margin-left:15px" onclick="location.reload()">Refresh</button>
      </h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Pilihan</th>
          <th>Tanggal</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @php
            $no=1;
        @endphp
        @foreach ($data as $val)
            
        <tr>
          <td>{{ $no++ }}</td>
          <td>{{ $val->nama }}</td>
          <td>No. {{ $val->no_kandidat }}</td>
          <td>{{ $val->created_at }}</td>
          <td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $no }}">Delete</button></td>
        </tr>


            <div id="deleteModal{{ $no }}" class="modal fade" role="dialog">
                <div class="modal-dialog">
              
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title text-danger">Konfirmasi</h4>
                    </div>
                    <div class="modal-body">
                      <p>Apa kamu yakin ingin menghapus pilihan {{ $val->nama }} ?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> <a href="{{ route('admin.hasil.delete',['id'=>$val->id]) }}" class="btn btn-danger">Delete</a>
                    </div>
            </div>
              
                </div>
              </div>
        @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->


</div>
<!-- DataTables -->
<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/dataTables.bootstrap.min.js"></script>









<script>
    $(function () {
      $('#example1').DataTable()
    })
</script>



<script>
var myApp = new Vue({
  el:'#myApp',
  data:{
    no:'',
    nama:'',
    suara:''
  },
  created() {
    this.getSuaraTerbanyak()
  },
  methods:{
    getSuaraTerbanyak:function() {
      axios.get('{{ route('suaraTerbanyak') }}').then(response => {
        console.log(response)
        this.no=response.data.suaraTerbanyak[0].no_kandidat
        this.nama=response.data.suaraTerbanyak[0].nama
        this.suara=response.data.jumlahSuara
      })
    }
  }
})

</script>


@endsection
