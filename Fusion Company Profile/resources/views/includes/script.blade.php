<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
<script type="text/javascript" src="{{ mix('js/vid.js') }}"></script>
{{--<script type="text/javascript" src="node_modules/videojs-youtube/dist/Youtube.min.js"></script>--}}
{{--<script src="https://unpkg.com/video.js/dist/video.js"></script>--}}
{{--<script src="https://unpkg.com/@videojs/http-streaming/dist/videojs-http-streaming.js"></script>--}}

<script>
    $(function () {
        if ($('#live_video_1').length) {
            var player = videojs('live_video_1', {autoplay: true});
            // player.ready(function () {
            //     var promise = player.play();
            //     if (promise !== undefined) {
            //         promise.then(function () {
            //             var promise1 = player.requestPictureInPicture();
            //             if (promise1 !== undefined) {
            //                 promise1.then(function () {
            //
            //                 }).catch(function (error) {
            //
            //                 });
            //             }
            //         }).catch(function (error) {
            //
            //         });
            //     }
            // });
        }
    });
</script>
