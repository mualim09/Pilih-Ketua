@extends('admin.Template')
@section('title')
Dashboard Admin | Kilat
@endsection
@section('body')
<script>
  $(document).ready(function() {
    $("li").removeClass('active');
    $("#home").addClass('active');
  });
</script>


<div class="row">
<div class="col-md-9" style="float:none;margin:0 auto">
 <!-- ./col -->
        <div class="col-md-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green" style="height: 138px">
            <div class="inner">
              <h3>{{ $data[0] }}</h3>

              <p>Kandidat</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{ route('admin.manageKandidat') }}" class="small-box-footer" style="top:10px">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow" style="height: 138px">
            <div class="inner">
              <h3>{{ $data[1] }}</h3>

              <p>Pemilih</p>
            </div>
            <div class="icon">
              <i class="fa fa-address-card-o"></i>
            </div>
            <a href="{{ route('admin.hasil.text') }}" class="small-box-footer" style="top:10px">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red" style="height: 138px">
            <div class="inner">
              <h3>{{ $data[2] }}</h3>

              <p>Admin</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-circle-o"></i>
            </div>
            <a href="{{ route('admin.manageAdmin') }}" class="small-box-footer" style="top:10px">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        </div>
        <!-- ./col -->
      </div>


<div class="row" >
    <div class="col-md-9" style="float:none;margin:0 auto">
    <div class="box box-solid col-md-4" style="padding: 15px">
      <div class="box-header with-border text-light-blue">
        <i class="fa fa-exclamation-circle"></i>

        <h3 class="box-title">Status Pemilihan</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
          <div class="switch"></div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- ./col -->


</div>


</div>
      <!-- /.row -->


























<script>
	$(document).ready(function() {
    var checkActive = $.get('{{ route('pemilihan.active') }}',function(data) {
      if(data.value==1) {
        $(".switch").addClass('on')
      }
      else {
        $('.switch').removeClass('on');
      }
    });



    // I'm sorry for using jQuery... I truly am.
    $('.switch').click(function(){
      if($(this).hasClass('on')){
        $(this).removeClass('on');
        $.ajax({
          type: "POST",
          url: '{{ route('pemilihan.off') }}',
          data: {
            "_token": "{{ csrf_token() }}"
          },
          success:function() {
            console.log('off')
          }

        });
      } else {
        $(this).addClass('on');
        $.ajax({
          type: "POST",
          url: '{{ route('pemilihan.on') }}',
          data: {
            "_token": "{{ csrf_token() }}"
          },
          success:function() {
            console.log('on')
          }

        });
      }
    })

	});
</script>
@endsection