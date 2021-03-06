@extends('user_interface.layouts.user_header')
@section('content')
	<div class="codes agileitsbg5">
		<div class="container">
			<div class="grid_3 grid_5 w3-agileits">
				<h3 class="w3ls-hdg">Listening Article</h3><br>
					@foreach($listening as $detail)
						<div class="col-sm-5 col-xs-5 w3ltext-grids md_5 desktop">
							<h4 class="w3t-text"><a href="{{route('detail_article',[$detail->type,$detail->alias])}}">{!!remove_dash(htmlspecialchars_decode($detail->tittle))!!} </a></h4>
							<p align="center" class="overflow">{!!remove_dash(htmlspecialchars_decode($detail->introduce))!!} </p>
							<h4 align="center"><a href="{{route('detail_article',[$detail->type,$detail->alias])}}">Continue read..</a></h4>
						</div>
					@endforeach
				<div class="clearfix">
				</div>
				<script>$(function () {
				  $('[data-toggle="tooltip"]').tooltip()
				})</script>
					Total Pages: {!! $listening->lastPage() !!}

					<div class="pagination pull-right {{($listening->lastPage()==0)?'hidden':''}}">
						<a href="{{$listening->url(1)}}" class="{{($listening->currentPage()==1) ? 'hidden':''}}">&laquo;</a>
						<a href="{{$listening->url($listening->currentPage()-1)}}" class="{{($listening->currentPage()==1) ? 'hidden':''}}">Prev</a>
						@for($i=1; $i<=$listening->lastPage(); $i++)
							<a href="{{$listening->url($i)}}" class="{{($listening->currentPage()==$i)? 'active':''}}">{{$i}}</a>
						@endfor
						<a href="{{$listening->url($listening->currentPage()+1)}}" class="{{($listening->currentPage()==$listening->lastPage())?'hidden' : ''}}">Next</a>
						<a href="{{$listening->url($listening->lastPage())}}" class="{{($listening->currentPage()==$listening->lastPage())?'hidden' : ''}}">&raquo;</a>
					</div>
			</div>
		</div>
	</div>

@stop