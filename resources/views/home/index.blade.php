@extends('planear')

@section('content')

<h3 >Home->allEvent(), seria una portada principal con todos los eventos(onda blog) --> PUBLICOS <-- </h3>
[ event tendria q tener owner, y que se complete con el nobre del us q lo creo
                     asi aca abajo llamo a "{$u->event_owner}}" ]

     
@foreach ($home as $u)
<div class="container" >
         <div class="row">
             <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                 <div class="post-preview">
                     <a href="#">
                         <h2 class="post-title">{{$u->event_name}} </h2>
                         <h3 class="post-subtitle">{{$u->event_desc}} </h3>
                     </a>
                     {{-- event tendria q tener owner, y que se complete con el nobre del us q lo creo
                     asi aca abajo llamo a {{$u->event_owner}} --}}
                     <p class="post-meta">Created by <a>{{$u->event_owner}}</a> on September 24, 2014</p>
{!!link_to_route('event.show', $title = 'Ver mas ->', $parameters = $u->id , $attributes = ['class'=>'btn btn-default'])!!}
                 </div>
                 <hr>
            </div>
        </div>
    </div>

@endforeach




@endsection
