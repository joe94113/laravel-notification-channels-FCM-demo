# Laravel notification channels fcm demo

> 範例使用 [Laravel FCM (Firebase Cloud Messaging) Notification Channel](https://laravel-notification-channels.com/fcm/#installation).

## 效果如下圖

![](https://i.imgur.com/98Zaci1.gif)

## 安裝

-   `git clone https://github.com/joe94113/laravel-notification-channels-FCM-demo.git`
-   `laravel-notification-channels-FCM-demo`
-   `copy .env.example .env`
-   `composer install`
-   `php artisan migrate`
-   `npm install`
-   `npm run dev`

更改`firebase-messaging-sw.js`以及`home.blade.php`
將以下資料填入

```
apiKey: "XXXX",
authDomain: "XXXX.firebaseapp.com",
projectId: "XXXX",
storageBucket: "XXXX",
messagingSenderId: "XXXX",
appId: "XXXX",
```

記得下載服務帳戶 JSON 文件，修改`.env`

```env
# 服務帳戶 JSON 文件的相對或完整路徑
FIREBASE_CREDENTIALS=
# 您可以在以下位置找到項目的數據庫 URL
# https://console.firebase.google.com/project/_/database
FIREBASE_DATABASE_URL=https://<your-project>.firebaseio.com
```

-   `php artisan serve`
