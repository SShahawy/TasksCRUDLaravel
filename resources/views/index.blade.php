@extends('layout')

 

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Tasks</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-success" href="{{ route('tasks.create') }}"> Create New Tasks</a>

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

            <th>Name</th>

            <th>Description</th>

            <th>Start Date</th>
            
            <th>End Date</th>

            <th width="280px">Action</th>

        </tr>

        @foreach ($tasks as $task)

        <tr>

            <td>{{ $loop->index +1 }}</td>

            <td>{{ $task->name }}</td>

            <td>{{ $task->desc }}</td>
              
            <td>{{ $task->start_date }}</td>

            <td>{{ $task->end_date }}</td>
            <td>

                <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">

   

                    <a class="btn btn-info" href="{{ route('tasks.show',$task->id) }}">Show</a>

    

                    <a class="btn btn-primary" href="{{ route('tasks.edit',$task->id) }}">Edit</a>

   

                    @csrf

                    @method('DELETE')

      

                    <button type="submit" class="btn btn-danger">Delete</button>

                </form>

            </td>

        </tr>

        @endforeach

    </table>

  



      

@endsection