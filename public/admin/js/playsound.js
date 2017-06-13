jQuery(function ($){
var supportsAudio = !!document.createElement('audio').canPlayType;
    if (supportsAudio) {
        var playing = false,
        audioEle = $('#audioEle').bind('play', function () {
                    playing = true;
                }).bind('pause', function () {
                    playing = false;
                }).bind('ended', function () {
                    audio.pause();
                }).get(0);
    }
});

