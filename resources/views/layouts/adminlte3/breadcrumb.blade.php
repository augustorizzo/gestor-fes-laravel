

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="{{$icone_titulo}}"></i> {{$titulo}}
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>

                    @foreach($breadcrumb as $bread)

                        @if(!$loop->last)
                            <li class="breadcrumb-item">
                                <a href="#">{{$bread}}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item active">{{$bread}}</li>
                        @endif

                    @endforeach

                </ol>
            </div>
        </div>
    </div>
</div>
