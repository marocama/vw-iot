<div class="row">
    <div class="col-lg-4">
      <div class="card shadow mb-4 border-left-primary">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Entradas</h6>
        </div>
        <div class="d-flex justify-content-center table-responsive">
			<table class="table table-striped">
  				<thead>
    				<tr>
						<th scope="col">Identificador</th>
						<th scope="col" class="text-center">Status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>@if($transmitter->mark_id == NULL)E1 @else {{$transmitter->mark->mark['e1']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['e1'])btn-success @else bg-gray-300 @endif btn-circle btn-sm">
                  				@if($selection->protocol['e1'])<i class="fas fa-bolt text-white"></i>@endif
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)E2 @else {{$transmitter->mark->mark['e2']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['e2'])btn-success @else bg-gray-300 @endif btn-circle btn-sm">
                  				@if($selection->protocol['e2'])<i class="fas fa-bolt text-white"></i>@endif
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)E3 @else {{$transmitter->mark->mark['e3']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['e3'])btn-success @else bg-gray-300 @endif btn-circle btn-sm">
                  				@if($selection->protocol['e3'])<i class="fas fa-bolt text-white"></i>@endif
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)E4 @else {{$transmitter->mark->mark['e4']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['e4'])btn-success @else bg-gray-300 @endif btn-circle btn-sm">
                  				@if($selection->protocol['e4'])<i class="fas fa-bolt text-white"></i>@endif
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)E5 @else {{$transmitter->mark->mark['e5']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['e5'])btn-success @else bg-gray-300 @endif btn-circle btn-sm">
                  				@if($selection->protocol['e5'])<i class="fas fa-bolt text-white"></i>@endif
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)E6 @else {{$transmitter->mark->mark['e6']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['e6'])btn-success @else bg-gray-300 @endif btn-circle btn-sm">
                  				@if($selection->protocol['e6'])<i class="fas fa-bolt text-white"></i>@endif
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)E7 @else {{$transmitter->mark->mark['e7']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['e7'])btn-success @else bg-gray-300 @endif btn-circle btn-sm">
                  				@if($selection->protocol['e7'])<i class="fas fa-bolt text-white"></i>@endif
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)E8 @else {{$transmitter->mark->mark['e8']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['e8'])btn-success @else bg-gray-300 @endif btn-circle btn-sm">
                  				@if($selection->protocol['e8'])<i class="fas fa-bolt text-white"></i>@endif
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)E9 @else {{$transmitter->mark->mark['e9']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['e9'])btn-success @else bg-gray-300 @endif btn-circle btn-sm">
                  				@if($selection->protocol['e9'])<i class="fas fa-bolt text-white"></i>@endif
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)E10 @else {{$transmitter->mark->mark['e10']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['e10'])btn-success @else bg-gray-300 @endif btn-circle btn-sm">
                  				@if($selection->protocol['e10'])<i class="fas fa-bolt text-white"></i>@endif
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)E11 @else {{$transmitter->mark->mark['e11']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['e11'])btn-success @else bg-gray-300 @endif btn-circle btn-sm">
                  				@if($selection->protocol['e11'])<i class="fas fa-bolt text-white"></i>@endif
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)E12 @else {{$transmitter->mark->mark['e12']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['e12'])btn-success @else bg-gray-300 @endif btn-circle btn-sm">
                  				@if($selection->protocol['e12'])<i class="fas fa-bolt text-white"></i>@endif
                			</a>&nbsp;
			  			</td>
					</tr>
				</tbody>
			</table>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card shadow mb-4 border-left-primary">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Saídas</h6>
		</div>
		<div class="d-flex justify-content-center table-responsive">
			<table class="table table-striped">
  				<thead>
    				<tr>
						<th scope="col">Identificador</th>
						<th scope="col" class="text-center">Status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>@if($transmitter->mark_id == NULL)S1 @else {{$transmitter->mark->mark['s1']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['s1'])btn-danger @else bg-gray-300 @endif btn-circle">
                  				<i class="fas fa-power-off @if($selection->protocol['s1'])text-white @else text-dark @endif"></i>
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)S2 @else {{$transmitter->mark->mark['s2']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['s2'])btn-danger @else bg-gray-300 @endif btn-circle">
                  				<i class="fas fa-power-off @if($selection->protocol['s2'])text-white @else text-dark @endif"></i>
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)S3 @else {{$transmitter->mark->mark['s3']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['s3'])btn-danger @else bg-gray-300 @endif btn-circle">
                  				<i class="fas fa-power-off @if($selection->protocol['s3'])text-white @else text-dark @endif"></i>
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)S4 @else {{$transmitter->mark->mark['s4']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['s4'])btn-danger @else bg-gray-300 @endif btn-circle">
                  				<i class="fas fa-power-off @if($selection->protocol['s4'])text-white @else text-dark @endif"></i>
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)S5 @else {{$transmitter->mark->mark['s5']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['s5'])btn-danger @else bg-gray-300 @endif btn-circle">
                  				<i class="fas fa-power-off @if($selection->protocol['s5'])text-white @else text-dark @endif"></i>
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)S6 @else {{$transmitter->mark->mark['s6']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['s6'])btn-danger @else bg-gray-300 @endif btn-circle">
                  				<i class="fas fa-power-off @if($selection->protocol['s6'])text-white @else text-dark @endif"></i>
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)S7 @else {{$transmitter->mark->mark['s7']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['s7'])btn-danger @else bg-gray-300 @endif btn-circle">
                  				<i class="fas fa-power-off @if($selection->protocol['s7'])text-white @else text-dark @endif"></i>
                			</a>&nbsp;
			  			</td>
					</tr>
					<tr>
						<td>@if($transmitter->mark_id == NULL)S8 @else {{$transmitter->mark->mark['s8']}}@endif&nbsp;</td>
						<td class="text-center">
              				<a class="btn @if($selection->protocol['s8'])btn-danger @else bg-gray-300 @endif btn-circle">
                  				<i class="fas fa-power-off @if($selection->protocol['s8'])text-white @else text-dark @endif"></i>
                			</a>&nbsp;
			  			</td>
					</tr>
				</tbody>
			</table>
		</div>
	  </div>
	</div>
	<div class="col-lg-4">
      	<div class="card shadow mb-4 border-left-primary">
        	<div class="card-header py-3">
          		<h6 class="m-0 font-weight-bold text-primary">Analógica</h6>
        	</div>
        	<div class="card-body d-flex justify-content-center">
          		<div id="analog"></div>
        	</div>
		</div>
		<div class="card shadow mb-4 border-left-primary">
        	<div class="card-header py-3">
          		<h6 class="m-0 font-weight-bold text-primary">Localização</h6>
        	</div>
        	<iframe width="100%" height="190" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q={{$transmitter->location}}&amp;ie=UTF8&amp;t=&amp;z=15&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
      	</div>
    </div>
</div>
  
  @section('js')  
  <script src="{{ asset('js/raphael-2.1.4.min.js') }}"></script>
  <script src="{{ asset('js/justgage.js') }}"></script>
  <script>
      document.addEventListener("DOMContentLoaded", function(event) {
          
          var analog = new JustGage({
              id: 'analog',
              value: {{($selection->protocol['analog']*100)/1024}},
              min: 0,
              max: 100,
              donut: false,
              gaugeWidthScale: 1.2,
              counter: true,
              hideInnerShadow: false,
              symbol: ' %',
              pointer: true
          });
      });
  </script>
  <script>
      $(function () {
          $('[data-toggle="tooltip"]').tooltip()
      });
  </script>
  @endsection