@extends('Master')
@section('title')
Login Page | Kilat
@endsection
@section('body')
<link rel="stylesheet" href="/css/signin.css">

@if(Session::has('message'))
<script>
	swal({
  type: 'error',
  title: 'Oops...',
  text: 'Username atau password anda salah !'
})
</script>
@endif
<style>
	body {
		background-color: #fff;
		border-top:3px solid #26a267
	}
</style>


    <div class="container col-md-3">

      <form class="form-signin" action="{{ route('user.auth') }}" method="post">
      	{{ csrf_field() }}
        <h2 class="form-signin-heading text-center">Selamat Datang</h2>
        <hr>
        <label for="inputEmail" class="sr-only">Nama Lengkap</label>
        <input type="text" name="nama" placeholder="Nama Lengkap" class="form-control {{ $errors->has('nama') ? 'aya-is-invalid' : '' }}" autocomplete="off" required="" value="{{ old('nama') }}">
		<br>
        <button class="btn btn-md btn-success btn-block" type="submit">LOGIN</button>
      </form>

    </div> <!-- /container -->



@endsection