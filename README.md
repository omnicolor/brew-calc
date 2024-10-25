# Brew Calc

Simple Alexa skill to help a brew understand how much malt extract to add to you boil to raise the specific gravity. Part of my *Alexa, Ask Me About PHP* conference talk, given most recently at [Cascadia PHP 2024](https://cascadiaphp.com).

This is not meant to be an example of production code. It doesn't handle interactive requests through LaunchRequest, nor the related CanFulfillIntentRequest and SessionEndedRequest. It does not handle errors, for example the malt extract types not being either DME or LME, or the gravity readings being out of bounds or reversed.

But it shows how easy it is to create something useful for Alexa to do using PHP.

## Running it

It's a simple index.php file with no dependencies. Copy it to your web server or a directory on your web server and point the endpoint for your skill on the [Amazon Developer Console](https://developer.amazon.com).

## Tests

None written. Feel free to add some!
