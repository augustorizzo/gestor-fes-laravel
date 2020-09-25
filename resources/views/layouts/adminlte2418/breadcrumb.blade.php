{{-- Content Header (Page header) --}}
<section class="content-header">
    <h1>
        <i class="{{$icone_titulo}}"></i> {{$titulo}}
        {{-- <small>Control panel</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      
        @foreach($breadcrumb as $bread)
            
            @if(!$loop->last)
                <li><a href="#">{{$bread}}</a></li>
            @else
                <li class="active">{{$bread}}</li>
            @endif

        @endforeach

    </ol>

  </section>