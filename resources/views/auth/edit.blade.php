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

   

    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>
        @elseif($message = Session::get('error'))
        <div class="alert alert-danger">

            <p>{{ $message }}</p>

        </div>
    @endif

  

    <form action="{{ route('update_user',$user->id) }}" method="POST">

        @csrf

        @method('PUT')

   

         <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>First Name:</strong>

                    <input type="text" name="fname" value="{{ strtok($user->name, ' ') }}" class="form-control" placeholder="Name">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Last Name:</strong>

                    <input type="text" name="lname" value="{{ strrchr($user->name,' ') }}" class="form-control" placeholder="Name">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Email:</strong>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" placeholder="Email">


                </div>

            </div>
            


            

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

              <button type="submit" class="btn btn-primary">Submit</button>

            </div>

        </div>

   

    </form>

@endsection