@extends('backend.layouts.index')
@section('title')
Tài Sản
@endsection
@section('main-content')
<div class="container">
	<h3 class="text-center">NHẬP DỮ LIỆU TỪ FILE EXCEL</h3>
	<form action="{{route('import.postImport')}}" enctype="multipart/form-data" method="POST">
		<div class="file-field input-field">
			<div class="file-up-btn">
				<a class="btn waves-effect waves-light btn-default" href="#">File</a>
			</div>
			<input type="file">
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text">
			</div>
		</div>
		<div class="text-center">
			<button type="submit" class="btn btn-success">Upload</button>
			<a href="{{route('tai-san.index')}}" class="btn waves-effect m-2 btn-info">BỎ QUA</a>
		</div>
	</form>
</div>
@endsection
