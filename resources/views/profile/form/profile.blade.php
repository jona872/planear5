<div class="form-group" >
			{!!Form::label('us_name2','Nombre: ')!!}
			{!!Form::text('us_name',null,['class'=>'form-control','placeholder'=> $u->us_name])!!}
</div>
<div class="form-group" >
			{!!Form::label('us_user','Nombre de Usuario: ')!!}
			<div class="form-control">{{$u->us_user}}</div>
</div>
<div class="form-group" >
			{!!Form::label('us_mail','Mail: ')!!}
			<div class="form-control">{{$u->us_mail}}</div>
</div>
<div class="form-group" >
			{!!Form::label('us_adre','Direccion: ')!!}
			<div class="form-control">{{$u->us_adre}}</div>
</div>
<div class="form-group" >
			{!!Form::label('us_tele','Telefono: ')!!}
			<div class="form-control">{{$u->us_tele}}</div>
</div>
<div class="form-group" >
			{!!Form::label('photolink','Fotolink: ')!!}
			<div class="form-control">{{$u->photolink}}</div>
</div>