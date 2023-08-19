@extends('layout')

@section('content')
      <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Show Users</h2>

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
   
    <table class="table table-bordered">

      <tr>

          <th>No</th>

          <th>First Name</th>

          <th>Last Name</th>

          <th>Email</th>

          <th width="280px">Action</th>

      </tr>

      <tr>

          <td>{{ $user->id }}</td>

          <td>{{ strtok($user->name, ' '); }}</td>

          <td>{{ strrchr($user->name,' ') }}</td>
          <td>{{ $user->email }}</td>
            
          <td>

              <form action="{{ route('delete_user',$user->id) }}" method="POST">

 
                  <a class="btn btn-primary" href="{{ route('edit_user',$user->id) }}">Edit</a>
                  <a class="btn btn-warning" href="{{ route('change_pw_pg',$user->id) }}">Change Password</a>
 

                  @csrf

                  @method('DELETE')

    

                  <button type="submit" class="btn btn-danger">Delete</button>

              </form>

          </td>

      </tr>


  </table>

    {{-- <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>First Name:</strong>

                {{ strtok($user->name, ' '); }}

            </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Last Name:</strong>

                {{ strrchr($user->name,' ') }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Email:</strong>

                {{ $user->email }}

            </div>

        </div>
       

    </div> --}}

@endsection