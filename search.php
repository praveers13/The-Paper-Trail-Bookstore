<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the search keyword from the form
    $keyword = $_POST['keyword'];

    // Check if the keyword is empty
    if (empty($keyword)) {
        // Prepare an error response if the keyword is empty
        $response = array(
            "type" => "error",
            "message" => "Please enter the search phrase."
        );
    } else {
        // YouTube Data API key
        $apikey = 'AIzaSyCScG9HuiFEDqPz5vKZSMxTNTTtJssnJmI';

        // URL for the YouTube Data API search
        $phrase = urlencode($keyword);
        $googleApiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . $phrase . '&maxResults=10&key=' . $apikey;

        // Initialize a cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Execute the cURL request and get the response
        $response = curl_exec($ch);

        // Close the cURL session
        curl_close($ch);

        // Decode the JSON response from YouTube Data API
        $data = json_decode($response);

        // Extract the list of videos
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
        /* Define CSS styles for the HTML elements */
        body {
            /* Set font and background styles */
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }
        
        .result-heading {
            /* Styling for result heading */
            text-align: center;
            padding: 20px;
            color: #333;
            font-size: 24px;
        }

        .videos-data-container {
            /* Styling for the container holding video data */
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .video-tile {
            /* Styling for individual video tile */
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .videoDiv {
            /* Styling for video iframe container */
            width: 40%;
            padding-right: 20px;
        }

        .videoInfo {
            /* Styling for video information container */
            width: 60%;
        }

        .videoTitle {
            /* Styling for video title */
            font-size: 18px;
            margin-bottom: 10px;
        }

        .videoDesc {
            /* Styling for video description */
            color: #666;
        }

        .response {
            /* Styling for response message container */
            text-align: center;
            padding: 20px;
            font-size: 18px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .error {
            /* Styling for error response */
            background-color: #ffdddd;
            color: #cc0000;
        }

        .success {
            /* Styling for success response */
            background-color: #ddffdd;
            color: #008000;
        }
    </style>
</head>
<body>
    <?php if (isset($videos)) { ?>
        <!-- Display search results if videos are available -->
        <div class="result-heading"><?php echo count($videos); ?> Results</div>
        <div class="videos-data-container" id="SearchResultsDiv">
            <?php foreach ($videos as $video) { ?>
                <!-- Display each video result -->
                <div class="video-tile">
                    <div class="videoDiv">
                        <!-- Embed YouTube video using iframe -->
                        <iframe id="iframe" style="width:100%;height:100%" src="//www.youtube.com/embed/<?php echo $video->id->videoId; ?>" 
data-autoplay-src="//www.youtube.com/embed/<?php echo $video->id->videoId; ?>?autoplay=1"></iframe>         
                    </div>
                    <div class="videoInfo">
                        <!-- Display video title and description -->
                        <div class="videoTitle"><b><?php echo $video->snippet->title; ?></b></div>
                        <div class="videoDesc"><?php echo $video->snippet->description; ?></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } elseif (isset($response)) { ?>
        <!-- Display a response message if no videos or an error occurs -->
        <div class="response <?php echo $response["type"]; ?>"><?php echo $response["message"]; ?></div>
    <?php } ?>
</body>
</html>
