@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>


            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">{{ __('Notification Types') }}</div>

                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notificationTypes as $type)
                                    <tr>
                                        <td>{{ $type->type }}</td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('send.notification.async', ['type' => $type->type]) }}">send</a>
                                            @if (!in_array($type->id, $userNotifications))
                                                <a class="btn btn-info"
                                                    href="{{ route('subscribe.notification.async', ['type' => $type->id]) }}">subscribe</a>
                                            @else
                                                <a class="btn btn-warning"
                                                    href="{{ route('subscribe.notification.async', ['type' => $type->id, 'unsubscribe' => 1]) }}">unsubscribe</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">{{ __('RealTime Notification') }}</div>

                    <div class="card-body">
                        <form id="notificationForm">
                            <input type="hidden" name="sender" value="{{ auth()->id() }}">
                            <div class="form-group">
                                <label for="message">Message</label>
                                <input type="text" class="form-control" id="message" name="message" required>
                            </div>
                            <div class="form-group">
                                <label for="type">Notification Type</label>
                                <select class="form-control" id="type" name="type">
                                    @foreach ($notificationTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Send Notification</button>
                        </form>

                        <div id="notificationResponse" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#notificationForm').on('submit', function(e) {
                e.preventDefault();

                var message = $('#message').val();
                var types = $('#type').val();
                var formData = $(this).serialize();
                userNotifications = @json($userNotifications);


                $.ajax({
                    type: 'GET',
                    url: '{{ route('send.notification.realtime') }}', // Route to send to
                    data: formData,
                    success: function(response) {
                        $('#notificationForm')[0].reset();


                        Echo.channel('testing')
                            .listen('RealTimeNotificationEvent', (e) => {
                                if (userNotifications.includes(parseInt(e.type))) {
                                    if ({{ auth()->id() }} != e.sender) {
                                        $('#notificationResponse').html(
                                            `<div class="alert alert-success">${e.message}</div>`
                                        );
                                    }
                                }
                            });
                    },
                    error: function(xhr, status, error) {
                        $('#notificationResponse').html(
                            '<div class="alert alert-danger">Failed to send notification.</div>'
                        );
                    }
                });
            });
        });
    </script>
@endsection
