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

                    <a href="{{route('push')}}">測試通知!</a>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script>
        var firebaseConfig = {
            apiKey: "XXXX",
            authDomain: "XXXX.firebaseapp.com",
            projectId: "XXXX",
            storageBucket: "XXXX",
            messagingSenderId: "XXXX",
            appId: "XXXX",
        };

        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        function notifyMe() {
            // 讓我們檢查瀏覽器是否支持通知
            if (!("Notification" in window)) {
                console.log("This browser does not support desktop notification");
            }

            // 讓我們檢查是否已經授予通知權限
            else if (Notification.permission === "granted") {
                // 如果同意取得通知權限，則可啟動通知
                startFCM();
            }

            // 否則，我們需要徵求用戶的許可
            else if (Notification.permission !== 'denied' || Notification.permission === "default") {
                Notification.requestPermission(function (permission) {
                // 如果同意取得通知權限，則可啟動通知
                if (permission === "granted") {
                    startFCM();
                }
                });
            }

            // 最後，如果用戶拒絕通知，而你想要尊重他們就沒有必要再打擾他們了
        }

        function startFCM() {
            messaging
                .requestPermission()
                .then(function () {
                    return messaging.getToken()
                })
                .then(function (request) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("fcm.token") }}',
                        type: 'POST',
                        data: {
                            token: request
                        },
                        dataType: 'JSON',
                        success: function (request) {
                            console.log('取得token成功');
                        },
                        error: function (error) {
                            console.log(error);
                        },
                    });

                }).catch(function (error) {
                    console.log(error);
                });
        }

        messaging.onMessage(function (payload) {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.image,
            };
            new Notification(title, options);
        });

        notifyMe();
    </script>
@endsection
