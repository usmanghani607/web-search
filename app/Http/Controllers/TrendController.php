<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TrendController extends Controller
{
    // public function fetchTrends(Request $request)
    // {
    //     $endpoint = 'https://api-dev.therecz.com/api/post/get-trends.php';

    //     $token = $request->header('Authorization');

    //     // dd($token);
    //     // exit();

    //     if (!$token) {
    //         Log::error('Authorization token not provided.');
    //         return view('frontend.pages.index')->with(['fetch' => 'Authorization token not provided']);
    //     }

    //     $response = Http::withOptions([
    //         'verify' => false,
    //     ])->withHeaders([
    //         'Authorization' => $token,
    //         'Content-Type' => 'application/json',
    //     ])->get($endpoint);

    //     // dd($response);
    //     // exit();

    //     if ($response->failed()) {
    //         Log::error('Failed to fetch trends from API.', ['endpoint' => $endpoint]);
    //         return view('frontend.pages.index')->with(['fetch' => 'Error fetching data from API']);
    //     }

    //     $responseData = $response->json();

    //     // dd($response);
    //     // exit();

    //     if ($responseData['success'] && isset($responseData['result'])) {
    //         $trends = $responseData['result'];

    //         dd($responseData);
    //         exit();

    //         Log::info('Trends fetched successfully.', ['trends' => $trends]);

    //         return view('frontend.pages.index', ['trends' => $trends]);
    //     } else {
    //         return view('frontend.pages.index')->with(['fetch' => 'No trends found or API response error']);
    //     }
    // }

    // public function fetchTrends(Request $request)
    // {
    //     $endpoint = 'https://api-dev.therecz.com/api/post/get-trends.php';

    //     $token = $request->header('Authorization');

    //     if (!$token) {
    //         Log::error('Authorization token not provided.');
    //         return response()->json(['errors' => ['token' => 'Authorization token not provided']], 401);
    //     }

    //     // dd($token);
    //     // exit();

    //     $response = Http::withOptions([
    //         'verify' => false,
    //     ])->withHeaders([
    //         'Authorization' => $token,
    //         'Content-Type' => 'application/json',
    //     ])->get($endpoint);

    //     if ($response->failed()) {
    //         Log::error('Failed to fetch trends from API.', ['endpoint' => $endpoint]);
    //         return response()->json(['errors' => ['fetch' => 'Error fetching data from API']], $response->status());
    //     }

    //     $responseData = $response->json();

    //     dd($responseData);
    //     exit();

    //     if (isset($responseData['success']) && $responseData['success'] && isset($responseData['result'])) {
    //         $trends = $responseData['result'];

    //         Log::info('Trends fetched successfully.', ['trends' => $trends]);

    //         return response()->json([
    //             'success' => true,
    //             'result' => $trends,
    //         ]);
    //     } else {
    //         Log::info('No trends found or API response error.', ['response' => $responseData]);
    //         return response()->json([
    //             'success' => false,
    //             'errors' => ['fetch' => 'No trends found or API response error'],
    //         ], 401);
    //     }
    // }

    public function fetchTrends()
    {
        $endpoint = 'https://api-dev.therecz.com/api/post/get-trends.php';

        // Hard-coded token for testing
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MjI1MDA4MTAsImV4cCI6MTc1NDAzNjgxMCwiYXVkIjoiVVNFUiIsImRhdGEiOnsidWlkIjoiNDgxIiwiZmlyc3ROYW1lIjoidGVzdGluZyIsImxhc3ROYW1lIjoidGVzdGluZzEiLCJlbWFpbElEIjoiZ2hhbmlza3luZXRAZ21haWwuY29tIiwibG9naW5UeXBlIjpudWxsLCJjYWxsRnJvbSI6IklPUyJ9fQ.Eyk07gjtsfaMPqf0z2B6erVJC7DjmUJMeW39suC8GFA'; // Replace with your actual token

        // $token ='eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MjI1MDA4NjAsImV4cCI6MTc1NDAzNjg2MCwiYXVkIjoiVVNFUiIsImRhdGEiOnsidWlkIjoiMjk0MzEiLCJmaXJzdE5hbWUiOiJVc21hbiIsImxhc3ROYW1lIjoiR2hhbmkiLCJlbWFpbElEIjoiZ2hhbmlza3luZXRAZ21haWwuY29tIiwibG9naW5UeXBlIjpudWxsLCJjYWxsRnJvbSI6IldFQlNJVEUifX0.mN9FDvnLhEuu0c114vIAZJMtShACaYf64lxJ-oqvfuY';

        Log::info('Using hard-coded token:', ['token' => $token]);

        $response = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->get($endpoint);

        if ($response->failed()) {
            Log::error('Failed to fetch trends from API.', ['endpoint' => $endpoint]);
            return response()->json(['errors' => ['fetch' => 'Error fetching data from API']], $response->status());
        }

        $responseData = $response->json();

        // dd($responseData);
        // exit();

        if (isset($responseData['success']) && $responseData['success'] && isset($responseData['result'])) {
            $trends = $responseData['result'];

            Log::info('Trends fetched successfully.', ['trends' => $trends]);

            return response()->json([
                'success' => true,
                'result' => $trends,
            ]);
        } else {
            Log::info('No trends found or API response error.', ['response' => $responseData]);
            return response()->json([
                'success' => false,
                'errors' => ['fetch' => 'No trends found or API response error'],
            ], 401);
        }
    }
}
