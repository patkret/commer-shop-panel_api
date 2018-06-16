<h1>Ustaw hasło do konta</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{ Form::open(['route' => ['setClientPassword', $client_id] ,'method' => 'PUT'])}}
{{ Form::label('password', 'Hasło')}}
{{ Form::input('password', 'password') }}
{{ Form::label('confirm-password', 'Powtórz hasło')}}
{{ Form::input('password', 'confirm-password') }}
{{ Form::submit('Ustaw')}}
{{ Form::close() }}


