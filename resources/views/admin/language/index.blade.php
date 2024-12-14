@extends('admin.master')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="page-title-box">
			<div class="float-right">
				<a class="btn btn-primary float-right" href="{{ route('languages.create') }}">{{ trans('site.add') }}</a>
			</div>
			<h4 class="page-title">{{ trans('site.language.title') }}</h4>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="card mt-3">
			<div class="card-body">
				<div class="table-rep-plugin">
					<div class="table-responsive mb-0" data-pattern="priority-columns">
						<table id="tech-companies-1" class="table table-striped mb-0">
							<thead>
								<tr>
									<th></th>
									<th data-priority="1">{{ trans('site.language.name') }}</th>
									<th data-priority="1">{{ trans('site.language.code') }}</th>
									<th data-priority="1">{{ trans('site.language.default') }}</th>
									<th data-priority="1"></th>
								</tr>
							</thead>
							<tbody>
								@foreach($languages as $language)
									<tr>
										<th>{{ $loop->iteration }}</th>
										<td>{{ $language->name }}</td>
										<td>{{ $language->code }}</td>
										<td>
											@if($language->default)
												<div class="custom-control custom-switch switch-primary">
													<input type="checkbox" class="custom-control-input"
														   id="customSwitchStatus{{ $loop->iteration }}" checked>
													<label class="custom-control-label" for="customSwitchStatus{{ $loop->iteration }}"></label>
												</div>
											@else
												<div class="custom-control custom-switch">
													<input type="checkbox" class="custom-control-input" id="customSwitchcustomSwitchStatus{{ $loop->iteration }}">
													<label class="custom-control-label" for="customSwitchStatus{{ $loop->iteration }}"></label>
												</div>
											@endif
										</td>
										<td class="text-right">
											<form class="float-right" action="/admin/languages/{{ $language-> id  }}"
												  method="POST" onSubmit="if(!confirm('{{ trans('site.language.confirm') }}'))
												  {return false;}">
												{{ method_field('DELETE') }}
												{{ csrf_field() }}
												<button type="submit" class="btn btn-xs btn-danger"><i class="fas
												fa-trash"></i></button>
											</form>
											<div class="float-right">
												<a class="btn btn-xs btn-primary mr-3" href="{{ route('languages.edit',$language) }}">
													<i class="far fa-edit"></i>
												</a>
											</div>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection