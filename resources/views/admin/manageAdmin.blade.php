@extends('admin.Template')
@section('title')
Manage Admin | Kilat
@endsection
@section('body')
<script>
	$(document).ready(function() {
		$("li").removeClass('active');
		$("#manageAdmin").addClass('active');
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
		<span v-on:click="currentView='dataAdmin'" class="button">Data Admin
		</span>
		<span  v-on:click="currentView='addAdmin'" class="button">Add Admin
		</span>
	</div>
	<transition name="fade" mode="out-in"><component v-bind:is="currentView" keep-alive></component></transition>
</div>



<template id="dataAdmin">
	<div class="col-md-8 col-md-offset-2">
	<h3 class="aya-text">Data Admin</h3>

	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Admin list :</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Action</th>
                </tr>
              @php $no=1; @endphp
              @foreach($data as $val)
                <tr>
                  <td>{{ $no }}</td>
                  <td>{{ $val->username }}</td>
									<td>{{ substr($val->password,0,10)."..." }}</td>
									
									<td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal{{ $no }}">Edit</button>
										@if($val->username!=\Auth::user()->username)
										<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $no }}">Delete</button>
										@endif
									</td></tr>
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
        <p>What you sure to delete {{ $val->username }} account ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> <a href="{{ route('admin.account.delete',['id'=>$val->id]) }}" class="btn btn-danger">Delete</a>
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
			<form action="{{ route('admin.account.edit',['id'=>$val->id]) }}" method="post" name="form{{ $no }}" id="form{{ $no }}" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="PUT">
				{{ csrf_field() }}				

				<span>new Username : </span><input type="text" name="username" placeholder="username" class="aya-input aya-input-long" autocomplete="off" required="" value="{{ $val->username }}"><br>
				<span>new Password : </span><input type="password" name="newpassword" placeholder="password" class="aya-input aya-input-long" required="" value="">
				<input type="hidden" name="password" value="{{ $val->password }}">

			</form>

</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" onclick="submit_edit({{ $no }})" class="btn btn-info">Edit</button>       	    

      </div>
    </div>

  </div>
</div>
@php $no++ @endphp
@endforeach
<template id="addAdmin">
	<div>
      










<div class="row">
	<div class="col-md-4"></div>
<div class="col-md-offset-3 col-md-4 col-xs-11 offset-xs-1 aya-login-form aya-register-form">

	<h4 class="aya-title"><span>Add admin</span></h4>

	<form action="{{ route('admin.postRegister') }}" method="POST">
	{{ csrf_field() }}
	<table>

		<tr>
			<td style="text-align:right">Username : </td>
			<td><input type="text" name="username" placeholder="username" class="aya-input {{ $errors->has('username') ? 'aya-is-invalid' : '' }}" autocomplete="off" required="" value="{{ old('username') }}"></td>
		</tr>
				@if($errors->has('username'))
				<tr>
					<td colspan="2"><div class="aya-invalid-feedback"><i class="fa fa-window-close" aria-hidden="true"></i> {{ $errors->first('username') }}</div></td>
				</tr>
				@endif
		<tr>
			<td style="text-align:right">Password : </td>
			<td><input type="password" name="password" placeholder="password" class="aya-input {{ $errors->has('password') ? 'aya-is-invalid' : '' }}" required=""></td>
		</tr>
				@if($errors->has('password'))
				<tr>
					<td colspan="2"><div class="aya-invalid-feedback"><i class="fa fa-window-close" aria-hidden="true"></i> {{ $errors->first('password') }}</div></td>
				</tr>
				@endif
		<tr>
			<td style="text-align:right">Confirm Password : </td>
			<td><input type="password" name="password_confirmation" placeholder="password confirmation" class="aya-input {{ $errors->has('password_confirmation') ? 'aya-is-invalid' : '' }}" required=""></td>
		</tr>
		<tr>
			<td></td>
			<td><button type="submit" class="button" >Add</button></td>
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

@if($errors->has('email') or $errors->has('username') or $errors->has('password'))
	$(".aya-choose span").eq(1).css({"background-color":"#3c8dbc","color":"#fff"});

@else
	$(".aya-choose span").eq(0).css({"background-color":"#3c8dbc","color":"#fff"});

@endif
		$(".aya-choose span").click(function() {
	$(".aya-choose span").css({"background-color":"#fff","color":"#aaa"});
	$(this).css({"background-color":"#3c8dbc","color":"#fff"});
	});



	});
	Vue.component('dataAdmin',{
		template:'#dataAdmin'
	});
	Vue.component('addAdmin',{
		template:'#addAdmin'
	});

	var app = new Vue({
		el:'#app',
		data: {
				@if($errors->has('email') or $errors->has('username') or $errors->has('password'))
			currentView:'addAdmin'
				@else
			currentView:'dataAdmin'
			@endif

		}
	});
</script>
@endsection