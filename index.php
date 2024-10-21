<?php

declare(strict_types=1);

/**
 * Format a response to send back to the user's Alexa device.
 */
function buildResponse(string $responseText): string
{
    return json_encode(
        [
            'version' => '1.0',
            'response' => [
                'shouldEndSession' => true,
                'outputSpeech' => [
                    'type' => 'PlainText',
                    'text' => $responseText,
                ],
            ],
        ]
    );
}

header('Content-Type: application/json;charset=UTF-8');
$input = json_decode(file_get_contents('php://input'));
$request = $input->request;

// Make sure the user actually uttered the magic words.
if ('LaunchRequest' === $request->type) {
    echo buildResponse('You didn\'t tell me what to ask brew calc');
    exit();
}

$slots = $request->intent->slots;
$extractType = strtoupper(
    $slots->extract->resolutions->resolutionsPerAuthority[0]->values[0]->value->name
    ?? $slots->extract->value
);
$actual = (int)$slots->actual->value;
$expected = (int)$slots->expected->value;

// Make some assumptions about how much potential yield the two types add.
if ('LME' === $extractType) {
    $extract = 38;
} else {
    $extract = 45;
}

// Volume of my boils is almost always 6.5 gallons.
// This could be another slot the user fills.
$volume = 6.5;

// Calculate how many "points" are needed.
$needed = $expected - $actual;

// Calculate how much malt extract to add.
$toAdd = $needed / ($extract / $volume);

echo buildResponse(sprintf(
    'You need %1.2f pounds of %s',
    $toAdd,
    $extractType
));
