<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AIController extends Controller
{
    public function generate(Request $request)
    {
        $client = new Client();
        $response = $client->request('POST', 'https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_KEY'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
				'model' => 'gpt-3.5-turbo',
				'messages' => [
					[
						'role' => 'system',
						'content' => 'You are a helpful assistant.',
					],
					[
						'role' => 'user',
						'content' => $request->input('content'),
					],
				],
				//'max_tokens' => 200,
			],
        ]);

        $result = json_decode($response->getBody(), true);
        return response()->json($result);
    }
}
