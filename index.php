<?php

require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

function view_tweet($data)
{
    echo '<div class="tweet">';
    echo '<div class="left">';
    echo '<img src="' . $data["user"]["profile_image_url_https"] . '">';
    echo '</div>';
    echo '<div class="center">';
    echo '<p class="header">';
    echo '<span class="name">';
    echo mb_substr($data["user"]["name"], 0, 20);;
    echo '</span>';
    echo '<span class="screen_name">@';
    echo $data["user"]["screen_name"];
    echo '</span>';
    echo '</p>';
    echo '<div class="body">';
    $text_list = explode("\n", $data["text"]);
    foreach ($text_list as $text) {
        echo '<p>';
        echo preg_replace('/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/', '<a href="$1">$1</a>', $text);
        echo '</p>';
    }
    if (isset($data["entities"]["media"])) {
        echo '<div class="media">';
        foreach ($data["entities"]["media"] as $media) {
            echo '<img class="image" src="' . $media["media_url_https"] . '">';
        }
        echo '</div>';
    }
    if ($data["in_reply_to_status_id_str"] !== null) {
        echo '<blockquote class="twitter-tweet"><a href="https://twitter.com/' . $data["in_reply_to_screen_name"] . '/status/' . $data["in_reply_to_status_id_str"] . '"></a></blockquote>';
    }
    if (isset($data["quoted_status"])) {
        echo '<div class="quoted">';
        view_tweet($data["quoted_status"]);
        echo '</div>';
    }
    echo '</div>';
    echo '<div class="footer">';
    echo '<div class="count">';
    echo '<svg viewBox="0 0 24 24" class="r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1hdv0qi"><g><path d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.044.286.12.403.142.225.384.347.632.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.367-3.43-7.787-7.8-7.788zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.335-.75-.75-.75h-.396c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z"></path></g></svg>';
    echo "0";
    echo '</div>';
    echo '<div class="count">';
    echo '<svg viewBox="0 0 24 24" class="r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1hdv0qi"><g><path d="M23.77 15.67c-.292-.293-.767-.293-1.06 0l-2.22 2.22V7.65c0-2.068-1.683-3.75-3.75-3.75h-5.85c-.414 0-.75.336-.75.75s.336.75.75.75h5.85c1.24 0 2.25 1.01 2.25 2.25v10.24l-2.22-2.22c-.293-.293-.768-.293-1.06 0s-.294.768 0 1.06l3.5 3.5c.145.147.337.22.53.22s.383-.072.53-.22l3.5-3.5c.294-.292.294-.767 0-1.06zm-10.66 3.28H7.26c-1.24 0-2.25-1.01-2.25-2.25V6.46l2.22 2.22c.148.147.34.22.532.22s.384-.073.53-.22c.293-.293.293-.768 0-1.06l-3.5-3.5c-.293-.294-.768-.294-1.06 0l-3.5 3.5c-.294.292-.294.767 0 1.06s.767.293 1.06 0l2.22-2.22V16.7c0 2.068 1.683 3.75 3.75 3.75h5.85c.414 0 .75-.336.75-.75s-.337-.75-.75-.75z"></path></g></svg>';
    echo $data["retweet_count"];
    echo '</div>';
    echo '<div class="count">';
    echo '<svg viewBox="0 0 24 24" class="r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1hdv0qi"><g><path d="M12 21.638h-.014C9.403 21.59 1.95 14.856 1.95 8.478c0-3.064 2.525-5.754 5.403-5.754 2.29 0 3.83 1.58 4.646 2.73.814-1.148 2.354-2.73 4.645-2.73 2.88 0 5.404 2.69 5.404 5.755 0 6.376-7.454 13.11-10.037 13.157H12zM7.354 4.225c-2.08 0-3.903 1.988-3.903 4.255 0 5.74 7.034 11.596 8.55 11.658 1.518-.062 8.55-5.917 8.55-11.658 0-2.267-1.823-4.255-3.903-4.255-2.528 0-3.94 2.936-3.952 2.965-.23.562-1.156.562-1.387 0-.014-.03-1.425-2.965-3.954-2.965z"></path></g></svg>';
    echo $data["favorite_count"];
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '<div class="right">';
    echo '</div>';
    echo '</div>';
}

$config = file_get_contents("config.json");
$config = (array) json_decode($config, true);

foreach ($config["user_timeline"] as $user_timeline) {
    $user_id = $user_timeline["user_id"];

    if (!file_exists($user_id)) {
        mkdir($user_id, 0700);
        touch($user_id . "/tmp.json");
        chmod($user_id . "/tmp.json", 0700);
        chmod("config.json", 0700);
    }

    $data = file_get_contents("data.json");
    $data = (array) json_decode($data, true);

    if ($data["lasted"] + 60 < time()) {
        $userConnect = new TwitterOAuth(
            $config["consumerKey"],
            $config["consumerSecrect"],
            $config["accessToken"],
            $config["accessTokenSecret"]
        );

        $statuses = $userConnect->get(
            'statuses/user_timeline',
            $user_timeline
        );
        if ($statuses->errors == null or true) {
            file_put_contents($user_id . "/tmp.json", json_encode($statuses));
        }
        $data["lasted"] = time();
        file_put_contents("data.json", json_encode($data));
    }
}
if (isset($_GET["id"])) {
    if (isset($config["user_timeline"][$_GET["id"]])) {
        $user_id = $config["user_timeline"][$_GET["id"]]["user_id"];
    } else {
        header("HTTP/1.1 404 Not Found");
        die();
    }
} else {
    $user_id = $config["user_timeline"][0]["user_id"];
}

if (isset($_GET["type"])) {
    if ($_GET["type"] == "json") {
        echo file_get_contents($user_id . "/tmp.json");
        die();
    } else {
        header("HTTP/1.1 404 Not Found");
        die();
    }
}

$tmp = json_decode(file_get_contents($user_id . "/tmp.json"), true);
ob_start();
foreach ($tmp as $data) {
    if (isset($data["retweeted_status"])) {
        view_tweet($data["retweeted_status"]);
    } else {
        view_tweet($data);
    }
}
$output = ob_get_contents();
ob_end_clean();
echo str_replace("{{output}}", $output, file_get_contents("asset/template.html"));