@extends('layouts.app')

@section('content')
    <div id="app" class="container">
        <div class="row">
            <h1>Chat Room</h1>
                <chat-component></chat-component>
        </div>

        <div class="row">
            <board-component> </board-component>
        </div>
    </div>
@endsection