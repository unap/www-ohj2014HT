@extends('layouts.master')

@section('main')
<h1> {{ Lang::get('messages.listofallusers') }} </h1>

<ul>

  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>{{ Lang::get('messages.firstname') }}</th>
        <th>{{ Lang::get('messages.email') }}</th>
        <?php $admin = Sentry::getUser(); ?>
        @if($admin && $admin->hasAccess('admin'))
          <th>{{ Lang::get('messages.groups') }}</th>
          <th>{{ Lang::get('messages.delete') }}</th>
        @endif
      </tr>
    </thead>

    <tbody data-link="row" class="rowlink">
      @foreach ($users as $user)
      <tr>
        <td>{{ HTML::linkRoute('userprofile', $user->first_name, $user->id )}}</td>
        <td>{{ $user->email }}</td>

        @if($admin && $admin->hasAccess('admin'))
        <td>
          @foreach($user->getGroups() as $group)
            {{ $group->name }} 
          @endforeach
        </td>
         <td class="rowlink-skip">
          <button class="btn btn-danger" onclick="myConfirm({{$user->id}})">Delete</a>
        </td>
        @endif
        
      </tr>
      @endforeach

    </tbody>

  </table>

</ul>

@if($admin && $admin->hasAccess('admin'))
<script type="text/javascript">
  function myConfirm (id) {
    if (confirm("Really delete user?")) {
      window.location.href = "http://"+window.location.hostname+"/deleteuser/"+id;
    }
  }
</script>
@endif


@stop