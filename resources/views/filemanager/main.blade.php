@extends('layouts.bare')

@section('content')
	<div id="params" style="display: none;">
		<span id="userBaseDir">{{$currentDir}}</span>
		<span id="actionUrl">{{$actionUrl}}</span>
		<span id="rowNumber"></span>
	</div>
	<img src="" id="output" width=300px;>
	<div id="fmg_top" class="d-flex">

		<div class="flex-b1 bxw-3">
			{!! Form::open(['action' => 'InfoletterController@store','method'=>'POST','name'=> 'fmg_mkdir', 'id'=>'fmg_mkdir']) !!}
			    {{Form::label('name','Créer un dossier')}}
                {{Form::submit('Créer',['class'=>'btn btn-primary','id'=>'fmg_btn_mkdir'])}}
                {{ Form::text('name','',['class'=>'form-control','id'=>'fmg_dirname'])}}

            {!! Form::close() !!}
		</div>

		<div class="flex-b2 bxw-3" >
			<div id="fmg_file_drop_target" >
       {{-- 
				{!!Form::open(array('id'=>'fmg-form','method'=>'POST', 'url'=>"filemanager/manage", 'enctype'=>'multipart/formdata'))  !!} 
				<div class="flex-column">
					<div >
						 {{Form::label('filename','Choisissez vos fichiers')}}
						 {{ Form::file('fmg-multiple-input[]',['id'=>'fmg-multiple-input','type'=>'file','multiple'=>'multiple'])}}
					</div>
					<div>
					{{Form::submit('Envoyer', ['class'=>'btn btn-upload btn-success'])}}
					</div>
					

			    </div>		
				 {!! Form::close() !!}--}}

                {{-- SOLUTION ALTERNATIVE SANS LA CLASS Form --}}
				<form id="fmg-form" method="post" action="{{url('filemanager/manage')}}" enctype="multipart/form-data">
					{{csrf_field()}}
					  <div class="input-group form-group "style="display:flex; flex-direction:column;">
						<div style="border:1px solid green;">
							<span  id='fmg-multiple-input-label'></span>
						</div>
						<div style="border:1px solid red;">
							<input id='fmg-multiple-input' type="file" name="fmg-multiple-input[]" class="myfrm form-control " multiple="multiple"></div>
					</div>
					  <button type="submit" class="btn btn-danger btn-upload" style="margin-top:10px">Submit</button>
				  </form>     



			</div>
		</div>
		<div id="fmg_delete_selection" class=" flex-b1 bxw-3">
			<div>
				<!-- ce bouton n'apparait qu'après sélection d'une ou plusieurs images-->
				<button class="delete_selection">Effacer les images sélectionnées</button>
			</div>
			<div class="fmg-my-bottom-link">
			<a href="" >Voir la vidéo explicative</a>
			</div><div class="fmg-my-bottom-link">
			<a href="" >Télécharger la vidéo explicative</a>
			</div>
		</div>


	</div>

	<div id="status"></div>

	<div id="fmg_breadcrumb">&nbsp;
	</div>

	<div id="fmg_upload_progress"></div>

	<div id="fmg_preview" draggable="true"></div>

	<table id="fmg_table" class="table">
		<thead>
			<tr>
				<th>Nom</th>
				<th>Taille</th>
				<th>Dernière modification</th>
				<th>Permissions</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody id="fmg_listing"></tbody>
	</table>

@endsection
@section('script')
<script src="{{ asset('js/filemanager.js') }}" ></script>

@endsection