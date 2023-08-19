@extends('layout')

   

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Edit User</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('tasks.index') }}"> Back</a>

            </div>

        </div>

    </div>

   

    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Whoops!</strong> There were some problems with your input.<br><br>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

  
    @if ($message = Session::get('success'))

    <div class="alert alert-success">

        <p>{{ $message }}</p>

    </div>
    @elseif($message = Session::get('error'))
    <div class="alert alert-danger">

        <p>{{ $message }}</p>

    </div>
@endif
    <form action="{{ route('change_pw',$user->id) }}" method="POST">

        @csrf

        @method('PUT')

   

         <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Current Password:</strong>

                    <input type="text" name="c_password" value="" class="form-control" placeholder="Current Password">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>New Password:</strong>

                    <input type="text" name="n_password" value="" class="form-control" placeholder="New Password">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>New Password Confirmation:</strong>
                    <input type="text" name="nc_password" value="" class="form-control" placeholder="New Password Confirmation">


                </div>

            </div>
            


            

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

              <button type="submit" class="btn btn-primary">Submsit</button>

            </div>

        </div>

   

    </form>

@endsection