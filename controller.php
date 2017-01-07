<?php

	require_once 'config/credentials.php';
	require_once 'models/searchTweets.php';
	require_once 'config/lib/twitteroauth.php';


	// function to fetch tweets for the API and generate required JSON repsonse
	function returnResponse(){

		//final response array to be printed
		$response = array(
			'tweets'	=> array(),
		);

		//initialising searchTweets Object
		$searchTweets = new searchTweets();

		// get object
		$tweets_data = $searchTweets->returnResponse();
		$tweets_data = json_decode(strip_tags(json_encode($tweets_data)), true);

		foreach($tweets_data['statuses'] as $tweet){
			//Filtering tweets, which have been retweeted more than once
			if($tweet['retweet_count'] > 0){	
				$tweet_json = array(
					'text'				=> $tweet['text'],
					'retweet_count'		=> $tweet['retweet_count'],
					'user'				=> array(
						'name'		=> $tweet['user']['name'],
						'handle'	=> $tweet['user']['screen_name'],
						'image'	=> $tweet['user']['profile_image_url_https'],
					),
					'time'				=> $tweet['created_at'],
				);
				//storing response
				array_push($response['tweets'], $tweet_json);
			}
		}
		echo json_encode($response);
	}

	returnResponse();
?>