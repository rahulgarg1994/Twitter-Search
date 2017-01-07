function displayTweet(){
    $('#tweets').html('');
    //Showing Loader GIF
    $('.tweetContainer .loader').show();
    $.ajax({
        url : 'controller.php',
        success : function(data){
            $('.tweetContainer .loader').hide();
            data = jQuery.parseJSON(data);
            // Iterarting over JSON data to populate the list
            for (var index in data.tweets) {
                var temp = data.tweets[index],
                    html = '<li class="tweetList"> <div class="tweetUser"> <img src="' + temp.user.image + '" class="proPic" /> <a href="https://www.twitter.com/' + temp.user.handle + '" target="_blank"> <span class="handle">@' + temp.user.handle + '</span> </a> <div class="author">' + temp.user.name + '</div> </div> <p class="tweetText">' + temp.text + '</p> <div class="tweetInfo"> <span class="postTime">' + temp.time.substr(0,20) + '</span> <span class="retweetCount flr">♺ ' + temp.retweet_count + '</span> </div> </li>';
                // Appending html 
                $('#tweets').append(html);
            }
        }
    });
}

$(document).ready(function(){
	displayTweet();

    // Setting Auto Refresh After a minute to load new Tweets
    setTimeout(function(){
        displayTweet();
        window.location.href = window.location.href
    }, 60000);
});