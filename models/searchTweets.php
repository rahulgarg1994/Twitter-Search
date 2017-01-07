<?php

class searchTweets {

	private $twitter_response = NULL;


	//Constuctor function for getting response from Twitter Search API
	
	function __construct(){

		// oauth connection to Twitter API
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_ACCESS_TOKEN, OAUTH_ACCESS_TOKEN_SECRET);

		//URL of the twitter API with given hashtag Search
		$url = BASE_URL . '?q=' . urlencode( '#' . HASHTAG ) . '&result_type=recent&count='. COUNT;

		// Storing Response from the API
		$response = $connection->get($url);

		$this->twitter_response = $response;

	}


	//function to get twitter Response returned by API
	public function returnResponse(){
		return $this->twitter_response;
	}
}