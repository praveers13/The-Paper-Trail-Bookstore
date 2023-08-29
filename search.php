<?php
if (isset($_POST['submit'])) {
    $keyword = $_POST['keyword'];

    if (empty($keyword)) {
        $response = array(
            "type" => "error",
            "message" => "Please enter the search phrase."
        );
    } else {
        $apikey = 'AIzaSyCScG9HuiFEDqPz5vKZSMxTNTTtJssnJmI';
        $phrase = urlencode($keyword);
        $googleApiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . $phrase . '&maxResults=10&key=' . $apikey;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        curl_close($ch);
        $data = json_decode($response);
        $videos = $data->items;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Video Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .result-heading {
            text-align: center;
            padding: 20px;
            color: #333;
            font-size: 24px;
        }

        .videos-data-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .video-tile {
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .videoDiv {
            width: 40%;
            padding-right: 20px;
        }

        .videoInfo {
            width: 60%;
        }

        .videoTitle {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .videoDesc {
            color: #666;
        }

        .response {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .error {
            background-color: #ffdddd;
            color: #cc0000;
        }

        .success {
            background-color: #ddffdd;
            color: #008000;
        }
    </style>
</head>
<body>
    <?php if (isset($videos)) { ?>
        <div class="result-heading"><?php echo count($videos); ?> Results</div>
        <div class="videos-data-container" id="SearchResultsDiv">
            <?php foreach ($videos as $video) { ?>
                <div class="video-tile">
                    <div class="videoDiv">
                        <iframe id="iframe" style="width:100%;height:100%" src="//www.youtube.com/embed/<?php echo $video->id->videoId; ?>" 
data-autoplay-src="//www.youtube.com/embed/<?php echo $video->id->videoId; ?>?autoplay=1"></iframe>         
                    </div>
                    <div class="videoInfo">
                        <div class="videoTitle"><b><?php echo $video->snippet->title; ?></b></div>
                        <div class="videoDesc"><?php echo $video->snippet->description; ?></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } elseif (isset($response)) { ?>
        <div class="response <?php echo $response["type"]; ?>"><?php echo $response["message"]; ?></div>
    <?php } ?>
</body>
</html>
