<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>流媒体的播放</title>
  <!-- video.js -->
  <script src="video.js"></script>
  <!-- Media Sources plugin -->
  <script src="/pages/js/videojs-media-sources.js"></script>
  <!-- HLS plugin -->
  <script src="/pages/js/videojs-hls.js"></script>
  <!-- m3u8 handling -->
  <script src="/pages/js/m3u8/m3u8-parser.js"></script>
  <script src="/pages/js/playlist-loader.js"></script>

  <style>
	*{margin:0; padding:0;}
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
	  background-color:#e9e9e9;
    }
    .info {
      background-color: #eee;
      border: thin solid #333;
      border-radius: 3px;
      padding: 0 5px;
      margin: 20px 0;
    }
	
	.play {
	  margin:100px auto;
	}
  </style>
</head>
<body>
<!--  <div class="play">
    <video id="video" class="video-js vjs-default-skin" height="600" width="100%" 
	  poster="http://video-js.zencoder.com/oceans-clip.png"	
    controls>
      <source src="http://live.3gv.ifeng.com/zixun.m3u8" type="application/x-mpegURL">
    </video>
  </div>
  <script>
    videojs.options.flash.swf = 'node_modules/videojs-swf/dist/video-js.swf';
    // initialize the player
    var player = videojs('video');
	videojs('video').ready(function() {
		var myPlayer = this;
		myPlayer.play();
	});
  </script>-->
</body>
</html>
