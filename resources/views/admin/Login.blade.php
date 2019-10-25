@extends('Master')
@section('title')
Admin Login | Kilat
@endsection
@section('body')
<script>
	$(document).ready(function() {
	var h = $(window).height();
			$("body").css({"min-height":h+"px"});

		});
</script>

<style>
body,html {
	overflow: hidden;
	border-top: none;
}
	@keyframes bg {
		0% {
		border-top: 5px solid rgba(0,0,0,0);
		}
		50% {
			border-top: 5px solid #0fafff;

		}
		100% {
			border-top: 5px solid rgba(0,0,0,0);
		}
	}
#particles-js {
	transition: 1s;
	background: -moz-linear-gradient(139deg, #367fa9 0, #0FAFFF 85%);/* FF3.6+ */
	background: -webkit-gradient(linear, 139deg, color-stop(0, #0FAFFF), color-stop(85%, #0FAFFF));/* Chrome,Safari4+ */
	background: -webkit-linear-gradient(139deg, #367fa9 0, #0FAFFF 85%);/* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(139deg, #367fa9 0, #0FAFFF 85%);/* Opera 11.10+ */
	background: -ms-linear-gradient(139deg, #367fa9 0, #0FAFFF 85%);/* IE10+ */
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#1301FE', endColorstr='#F4F60C', GradientType='1'); /* for IE */
	background: linear-gradient(139deg, #367fa9 0, #0FAFFF 85%);/* W3C */
	top:0;
	animation: 5s bg linear infinite;
		background-repeat: no-repeat;
		background-size: cover;
		background-position: 0 0;
		padding: 0;
		margin: 0;
		width: 100%;
		background-attachment:fixed;
		position:absolute;
}
	.swal2-popup {
  font-size: 0.8rem !important;
}
</style>

@if(Session::has('message'))
<script>
swal({
  type: 'error',
  title: 'Oops...',
  text: 'Username atau password anda salah !'
})
</script>
@endif
<div id="particles-js"></div>

<div class="row">
<div class="col-xs-10 offset-xs-1 col-sm-8 offset-sm-2 col-md-4 offset-md-4 aya-login-form">

	<h5 class="aya-title"><span>Admin Login</span></h5>

	<form action="{{ route('admin.auth') }}" method="POST">
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
			<td></td>
			<td><button type="submit" class="button" >Login</button></td>
		</tr>
	</table>



	</form>
</div>
</div>
<script src="/js/particles.js"></script>
<script src="/js/particles.min.js"></script>
<script src="/js/particles/app.js"></script>

<script>
	$(document).ready(function() {
	var height=$(window).innerHeight();
	var h = $(window).height();
			$("body").css({"min-height":h+"px"});
			$("#particles-js").css({"height":height});

		});
</script>
@endsection