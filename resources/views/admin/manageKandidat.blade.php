@extends('admin.Template')
@section('title')
Manage Kandidat | Kilat
@endsection
@section('body')

<script>
    $(document).ready(function() {
    $("li").removeClass('active');
    $("#manageKandidat").addClass('active');
  });
</script>




<style>
	.fade-enter-active , .fade-leave-active {
		-webkit-transition: opacity .3s ease;
		-moz-transition: opacity .3s ease;
		-o-transition: opacity .3s ease;
		transition: opacity .3s ease;
	}
	.fade-enter, .fade-leave-to {
		opacity: 0
    }
    
</style>

<div id="app">
	<div class="aya-choose">
		<span v-on:click="currentView='dataKandidat'" class="button">Data Kandidat
		</span>
		<span  v-on:click="currentView='addKandidat'" class="button">Add Kandidat
		</span>
	</div>
	<transition name="fade" mode="out-in"><component v-bind:is="currentView" keep-alive></component></transition>
</div>



<template id="dataKandidat">
	<div>
	<h3 class="aya-text">Data Kandidat</h3>

	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Kandidat list :</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>No</th>
                  <th>Foto ketua</th>
                  <th>Ketua</th>
                  <th>Foto Wakil</th>
                  <th>Wakil</th>
                  <th>Visi</th>
                  <th>Misi</th>
                  <th>Action</th>
                </tr>
              @php $no=1; @endphp
              @foreach($data as $val)
                <tr>
                  <td>{{ $val->no_kandidat }}</td>
                  <td><img src="/uploads/{{ explode(",",$val->foto)[0] }}" alt="{{ explode(",",$val->foto)[0] }}" class="img-thumbnail" height="96" width="96"></td>
                  <td>{{ explode(',',$val->nama)[0] }}</td>
                  <td><img src="/uploads/{{ explode(",",$val->foto)[1] }}" alt="{{ explode(",",$val->foto)[1] }}" class="img-thumbnail" height="96" width="96"></td>
                  <td>{{ explode(',',$val->nama)[1] }}</td>
                  <td><textarea  cols="30" rows="10" disabled="" style="background-color: #fff;border:none">{{ $val->visi }}</textarea></td>
                  <td><textarea  cols="30" rows="10" disabled="" style="background-color: #fff;border:none">{{ $val->misi }}</textarea></td>
                  <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal{{ $no }}">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $no }}">Delete</button></td></tr>
<!-- Modal -->



<div id="deleteModal{{ $no }}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-danger">Confirmation</h4>
      </div>
      <div class="modal-body">
        <p>What you sure to delete Kandidat number {{ $val->no_kandidat }} ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> <a href="{{ route('kandidat.account.delete',['id'=>$val->id]) }}" class="btn btn-danger">Delete</a>
      </div>
    </div>

  </div>
</div>

			  @php $no++ @endphp
              @endforeach

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
  </div>
</template>
@php $no=1 @endphp
@foreach($data as $val)
<div id="editModal{{ $no }}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title aya-title"><span>Edit admin account</span></h4>
      </div>

      <div class="modal-body">
<div class="row" style="margin-top:-50px">
    <div class="col-md-2"></div>
<div class="col-md-8 col-xs-11 offset-xs-1 aya-login-form aya-register-form" style="position:relative;filter:none;">
	<form action="{{ route('kandidat.account.edit',['id'=>$val->id]) }}" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="PUT">
	<table>
		<tr>
			<td style="text-align:right">No : </td>
			<td><input type="number" name="no" placeholder="Nomor Kandidat" class="aya-input {{ $errors->has('no') ? 'aya-is-invalid' : '' }}" autocomplete="off" required="" value="{{ $val->no_kandidat }}"></td>
		</tr>
				@if($errors->has('no'))
				<tr>
					<td colspan="2"><div class="aya-invalid-feedback"><i class="fa fa-window-close" aria-hidden="true"></i> {{ $errors->first('no') }}</div></td>
				</tr>
				@endif
    <tr>
			<td style="text-align:right">Ketua : </td>
			<td><input type="text" name="ketua" placeholder="Ketua" class="aya-input {{ $errors->has('ketua') ? 'aya-is-invalid' : '' }}" autocomplete="off" required="" value="{{ explode(',',$val->nama)[0] }}"></td>
		</tr>
				@if($errors->has('ketua'))
				<tr>
					<td colspan="2"><div class="aya-invalid-feedback"><i class="fa fa-window-close" aria-hidden="true"></i> {{ $errors->first('ketua') }}</div></td>
				</tr>
        @endif
        <tr>
            <td style="text-align:right">foto ketua : </td>
            <input type="hidden" name="foto_ketua_ori" value="{{ explode(',',$val->foto)[0] }}">
            <input type="hidden" name="foto_wakil_ori" value="{{ explode(',',$val->foto)[1] }}">
            <td><input type="file" name="foto_ketua" placeholder="foto_ketua" class="aya-input {{ $errors->has('foto_ketua') ? 'aya-is-invalid' : '' }}" autocomplete="off" value="{{ old('foto_ketua') }}"></td>
          </tr>
              @if($errors->has('foto_ketua'))
              <tr>
                <td colspan="2"><div class="aya-invalid-feedback"><i class="fa fa-window-close" aria-hidden="true"></i> {{ $errors->first('foto_ketua') }}</div></td>
              </tr>
              @endif
		    <tr>
            <td style="text-align:right">Wakil : </td>
            <td><input type="text" name="wakil" placeholder="Wakil Ketua" class="aya-input {{ $errors->has('wakil') ? 'aya-is-invalid' : '' }}" autocomplete="off" required="" value="{{ explode(',',$val->nama)[1] }}"></td>
        </tr>
                @if($errors->has('wakil'))
                <tr>
                    <td colspan="2"><div class="aya-invalid-feedback"><i class="fa fa-window-close" aria-hidden="true"></i> {{ $errors->first('wakil') }}</div></td>
                </tr>
                @endif
        <tr>
            <td style="text-align:right">foto wakil : </td>
            <td><input type="file" name="foto_wakil" placeholder="foto wakil Ketua" class="aya-input {{ $errors->has('foto_wakil') ? 'aya-is-invalid' : '' }}" autocomplete="off" value="{{ old('foto_wakil') }}"></td>
        </tr>
                @if($errors->has('foto_wakil'))
                <tr>
                    <td colspan="2"><div class="aya-invalid-feedback"><i class="fa fa-window-close" aria-hidden="true"></i> {{ $errors->first('foto_wakil') }}</div></td>
                </tr>
                @endif

	</table>
<table>
    <tr>
        <td style="text-align:right">Visi : </td>
        <td>
            <textarea name="visi" placeholder="Visi" cols="25" rows="5" class="aya-input {{ $errors->has('visi') ? 'aya-is-invalid' : '' }}" autocomplete="off" required="" style="resize:vertical">{{ $val->visi }}</textarea>
    </tr>
            @if($errors->has('visi'))
            <tr>
                <td colspan="2"><div class="aya-invalid-feedback"><i class="fa fa-window-close" aria-hidden="true"></i> {{ $errors->first('visi') }}</div></td>
            </tr>
            @endif
    <tr>
            <td style="text-align:right">Misi : </td>
            <td>
                <textarea name="misi" placeholder="Misi" cols="25" rows="5" class="aya-input {{ $errors->has('misi') ? 'aya-is-invalid' : '' }}" autocomplete="off" required="" style="resize:vertical">{{ $val->misi }}</textarea>
            </td>
    </tr>
                @if($errors->has('misi'))
                <tr>
                    <td colspan="2"><div class="aya-invalid-feedback"><i class="fa fa-window-close" aria-hidden="true"></i> {{ $errors->first('misi') }}</div></td>
                </tr>
                @endif
    
</table>


</div>
</div>

</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" onclick="submit_edit({{ $no }})" class="btn btn-info">Edit</button>       	    
      </form>

      </div>
    </div>

  </div>
</div>
@php $no++ @endphp
@endforeach
<template id="addKandidat">
	<div>
      
<div class="row">
    <div class="col-md-2"></div>
<div class="col-md-8 col-xs-11 offset-xs-1 aya-login-form aya-register-form" style="position:relative">

	<h4 class="aya-title"><span>Add Kandidat</span></h4>

	<form action="{{ route('kandidat.postRegister') }}" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
	<table class="table-responsive" style="margin:0 auto;">

		<tr>
			<td style="text-align:right">No : </td>
			<td><input type="number" name="no" placeholder="Nomor Kandidat" class="aya-input {{ $errors->has('no') ? 'aya-is-invalid' : '' }}" autocomplete="off" required="" value="{{ old('no') }}"></td>
		</tr>
				@if($errors->has('no'))
				<tr>
					<td colspan="2"><div class="aya-invalid-feedback"><i class="fa fa-window-close" aria-hidden="true"></i> {{ $errors->first('no') }}</div></td>
				</tr>
				@endif
    <tr>
			<td style="text-align:right">Ketua : </td>
			<td><input type="text" name="ketua" placeholder="Ketua" class="aya-input {{ $errors->has('ketua') ? 'aya-is-invalid' : '' }}" autocomplete="off" required="" value="{{ old('ketua') }}"></td>
		</tr>
				@if($errors->has('ketua'))
				<tr>
					<td colspan="2"><div class="aya-invalid-feedback"><i class="fa fa-window-close" aria-hidden="true"></i> {{ $errors->first('ketua') }}</div></td>
				</tr>
        @endif
        <tr>
            <td style="text-align:right">foto ketua : </td>
            <td><input type="file" name="foto_ketua" placeholder="foto_ketua" class="aya-input {{ $errors->has('foto_ketua') ? 'aya-is-invalid' : '' }}" autocomplete="off" required="" value="{{ old('foto_ketua') }}"></td>
          </tr>
              @if($errors->has('foto_ketua'))
              <tr>
                <td colspan="2"><div class="aya-invalid-feedback"><i class="fa fa-window-close" aria-hidden="true"></i> {{ $errors->first('foto_ketua') }}</div></td>
              </tr>
              @endif
		    <tr>
            <td style="text-align:right">Wakil : </td>
            <td><input type="text" name="wakil" placeholder="Wakil Ketua" class="aya-input {{ $errors->has('wakil') ? 'aya-is-invalid' : '' }}" autocomplete="off" required="" value="{{ old('wakil') }}"></td>
        </tr>
                @if($errors->has('wakil'))
                <tr>
                    <td colspan="2"><div class="aya-invalid-feedback"><i class="fa fa-window-close" aria-hidden="true"></i> {{ $errors->first('wakil') }}</div></td>
                </tr>
                @endif
        <tr>
            <td style="text-align:right">foto wakil : </td>
            <td><input type="file" name="foto_wakil" placeholder="foto wakil Ketua" class="aya-input {{ $errors->has('foto_wakil') ? 'aya-is-invalid' : '' }}" autocomplete="off" required="" value="{{ old('foto_wakil') }}"></td>
        </tr>
                @if($errors->has('foto_wakil'))
                <tr>
                    <td colspan="2"><div class="aya-invalid-feedback"><i class="fa fa-window-close" aria-hidden="true"></i> {{ $errors->first('foto_wakil') }}</div></td>
                </tr>
                @endif

	</table>
<table>
    <tr>
        <td style="text-align:right">Visi : </td>
        <td>
            <textarea name="visi" placeholder="Visi" cols="25" rows="5" class="aya-input {{ $errors->has('visi') ? 'aya-is-invalid' : '' }}" autocomplete="off" required="" style="resize:vertical">{{ old('visi') }}</textarea>
    </tr>
            @if($errors->has('visi'))
            <tr>
                <td colspan="2"><div class="aya-invalid-feedback"><i class="fa fa-window-close" aria-hidden="true"></i> {{ $errors->first('visi') }}</div></td>
            </tr>
            @endif
    <tr>
            <td style="text-align:right">Misi : </td>
            <td>
                <textarea name="misi" placeholder="Misi" cols="25" rows="5" class="aya-input {{ $errors->has('misi') ? 'aya-is-invalid' : '' }}" autocomplete="off" required="" style="resize:vertical">{{ old('misi') }}</textarea>
            </td>
    </tr>
                @if($errors->has('misi'))
                <tr>
                    <td colspan="2"><div class="aya-invalid-feedback"><i class="fa fa-window-close" aria-hidden="true"></i> {{ $errors->first('misi') }}</div></td>
                </tr>
                @endif
    <tr>
        <td></td>
        <td><button type="submit" class="button">Add</button></td>
      </tr>
</table>


	</form>
</div>
</div>
</div>
</template>
<script>
		function submit_edit(id) {
			$("#form"+id).submit();
		}
	$(document).ready(function() {

@if($errors->has('email') or $errors->has('username') or $errors->has('password') or $errors->has('foto_ketua') or $errors->has('foto_wakil'))
	$(".aya-choose span").eq(1).css({"background-color":"#3c8dbc","color":"#fff"});

@else
	$(".aya-choose span").eq(0).css({"background-color":"#3c8dbc","color":"#fff"});

@endif
		$(".aya-choose span").click(function() {
	$(".aya-choose span").css({"background-color":"#fff","color":"#aaa"});
	$(this).css({"background-color":"#3c8dbc","color":"#fff"});
	});


	});
	Vue.component('dataKandidat',{
		template:'#dataKandidat'
	});
	Vue.component('addKandidat',{
		template:'#addKandidat'
	});

	var app = new Vue({
		el:'#app',
		data: {
				@if($errors->has('email') or $errors->has('username') or $errors->has('password') or $errors->has('foto_ketua') or $errors->has('foto_wakil'))
			currentView:'addKandidat'
				@else
			currentView:'dataKandidat'
			@endif

		}
	});
</script>
@endsection