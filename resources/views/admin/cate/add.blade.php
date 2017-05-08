@extends('admin/layouts/adminmaster')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 col-centered">
				<div class="panel-title">
					<div class="col-centered">
						<h2 align="center">Add Category</h2><hr>
					</div>
				</div>

				<div class="panel-body">
					<form action="{{route('admin.cate.postAdd')}}" method="POST" role="form">

						<div class="form-group {{$errors->has('parent_id') ? 'has-error' : null}}">

							<label>Category Parent</label>
							<select name="parent_id" id="inputPa" class="form-control" autofocus >
								o
								<option disabled selected hidden>Please Choose Catgeory...</option>
								<option value="0">Parent Category</option>

								<?php cate_parent($parent,0,"-",old('parent_id')); ?>

							</select>

							@if($errors->has('parent_id'))
								<span class="help-block">
									<i>{{$errors->first('parent_id')}}</i>
								</span>
							@endif

						</div>

						<div class="form-group {{$errors->has('name') ? 'has-error' : null}}">

							<label for="">Category Name</label>
							<input type="text" class="form-control" id="" name="name" placeholder="Please Enter Category Name" value="{{old('name')}}">

							@if($errors->has('name'))
								<span class="help-block">
									<i>
										{{$errors->first('name')}}
									</i></span>
							@endif

						</div>

						<div class="form-group {{$errors->has('order') ? 'has-error' : null}}">

							<label for="">Category Order</label>
							<input type="text" class="form-control" id="" name="order" placeholder="Please Enter Category Order" value="{{old('order')}}">

							@if($errors->has('order'))
								<span class="help-block">
									<i>{{$errors->first('order')}}</i>
								</span>
							@endif

						</div>

						<div class="form-group {{$errors->has('keywords') ? 'has-error' : null}}">

							<label for="">Category keywords</label>
							<input type="text" class="form-control" id="" name="keywords" placeholder="Please Enter Category Keywords" value="{{old('keywords')}}">

							@if($errors->has('keywords'))
								<span class="help-block">
									<i>{{$errors->first('keywords')}}</i>
								</span>
							@endif

						</div>

						<div class="form-group {{$errors->has('description') ? 'has-error' : null}}">

							<label for="">Category Description</label>
							<textarea class="form-control" name="description" rows="3" placeholder="Please enter description">{{old('description')}}</textarea>
							@if($errors->has('description'))
								<span class="help-block">
									<i>{{$errors->first('description')}}</i>
								</span>
							@endif

						</div>

						{{csrf_field()}}

						<button type="submit" class="btn btn-basis">Add</button>

						<button class="btn btn-warning" type="reset">Reset</button>

					</form>

					<a href="{{route('admin.cate.show')}}">
						<button class="btn btn-default pull-right">Show categories</button>
					</a>

				</div>
			</div>
		</div>
	</div>

@stop