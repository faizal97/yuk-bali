<!DOCTYPE html>
<html>
<?php
$a = 'https://www.youtube.com/watch?v=ntKn5TPHHAk';
$id = explode("v=",$a);
?>
    <div id="player"></div>
<script src="<?php echo base_url() ?>js/ytapi.js"></script>
    <script>
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '480',
          width: '680',
          videoId: '<?php echo $id[1] ?>',
          events: {
            'onReady': onPlayerReady
          }
        });
      }
    </script>