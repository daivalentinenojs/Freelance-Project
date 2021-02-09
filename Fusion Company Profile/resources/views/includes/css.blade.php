<link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="{{ mix('css/vid.css') }}">
{{--<link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">--}}
<link
    href="https://unpkg.com/@videojs/themes@1/dist/city/index.css"
    rel="stylesheet"
/>
<link
    href="https://fonts.googleapis.com/css?family=Dosis:300,400,600,700%7COpen+Sans:300,400,700%7CPlayfair+Display:400,400i,700,700i"
    rel="stylesheet">
<style>
    select {
        border-radius: 25px !important;
    }

    .video-center {
        top: 50%;
        left: 50%;
        margin-left: -150px;
        margin-top: 10px;
        left: calc(50% - 150px);
    }

    .video-live {
        width: 100%;
        height: 720px;
    }
</style>
