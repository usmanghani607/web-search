<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend/pages/index');
    }


    public function restaurant()
    {
        return view('frontend/pages/restaurant-listing');
    }

    public function searchRestaurant()
    {
        return view('frontend/pages/search-restaurants');
    }

    public function chat()
    {
        return view('frontend/pages/chat');
    }

    public function chatGrid()
    {
        return view('frontend/pages/chat-grid');
    }
    public function login()
    {
        return view('frontend/pages/login');
    }

    // public function loginNew()
    // {
    //     return view('frontend/pages/login_new');
    // }


    public function getToken()
    {
        $tokenEndpoint = "https://api.therecz.com/api/token/generate.php";
        $ch = curl_init();

        $postfields = json_encode([
            'apiKey' => '9555d4b55ecf4d24b897e34f5f623d38',
            'callFrom' => 'WEBSITE'
        ]);

        curl_setopt($ch, CURLOPT_URL, $tokenEndpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            throw new \Exception("Error fetching token: " . $error_msg);
        }

        curl_close($ch);

        $response = json_decode($result, true);

        if (isset($response['token'])) {
            return $response['token'];
        } else {
            throw new \Exception("Token not found in response");
        }
    }


    public function loginProcess(Request $request)
    {
        $request->validate([
            'emailID' => 'required|email',
            'pass' => 'required',
        ]);

        $email = $request->input('emailID');
        $password = $request->input('pass');

        $endpoint = "https://api.therecz.com/api/user/login.php";
        $postfields = json_encode([
            'emailID' => $email,
            'pass' => $password,
            'apiKey' => '9555d4b55ecf4d24b897e34f5f623d38',
            'callFrom' => 'WEBSITE',
            'deviceToken' => '...',
        ]);

        $ch = curl_init();

        try {
            $token = $this->getToken();
        } catch (\Exception $e) {
            return response()->json(['errors' => ['token' => $e->getMessage()]], 500);
        }

        $authorization = "Authorization: Bearer $token";

        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            curl_close($ch);
            return response()->json(['errors' => ['password' => $error_msg]], 500);
        }

        curl_close($ch);

        $response = json_decode($result, true);

        if ($response['success']) {
            Session::put('api_token', $response['token']);
            Session::put('firstName', $response['data']['firstName']); // Store firstName in session

            // dd($response);
            // exit();

            return response()->json([
                'success' => true,
                'message' => 'You are successfully logged in',
                'redirect_url' => route('index'),
                'token' => $response['token'],
                'firstName' => $response['data']['firstName'], // Include the user name in the response
            ]);
        } else {
            return response()->json([
                'success' => false,
                'errors' => ['password' => 'The email or password you entered is incorrect']
            ], 401);
        }
    }

    public function searchList()
    {
        return view('frontend/pages/search-list');
    }

    public function placeProcess(Request $request)
    {
        $searchQuery = $request->input('search_query');
        $endpoint = "https://api.therecz.com//api/search/places.php";
        $postfields = [
            'search' => $searchQuery,
            'type' => '',
            'skipCache' => false
        ];

        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['errors' => ['token' => 'Authorization token not provided']], 401);
        }

        // dd($token);
        // exit();

        $response = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $token,
        ])->post($endpoint, $postfields);

        if ($response->failed()) {
            return response()->json(['errors' => ['search_query' => 'Error fetching data from API']], $response->status());
        }

        $responseData = $response->json();

        // dd($responseData);
        // exit();

        if (isset($responseData['result'])) {
            $result = $responseData['result'];

            return response()->json([
                'success' => true,
                'result' => $result,
                'search_query' => $searchQuery,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'errors' => ['search_query' => 'No results found for your query']
            ], 401);
        }
    }

    public function googleMapProcess(Request $request)
    {
        $searchQuery = $request->input('search_query');
        $endpoint = "https://api.therecz.com//api/search/places.php";
        $postfields = [
            'search' => $searchQuery,
            'type' => '',
            'skipCache' => false
        ];

        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['errors' => ['token' => 'Authorization token not provided']], 401);
        }

        // dd($token);
        // exit();

        $response = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $token,
        ])->post($endpoint, $postfields);

        if ($response->failed()) {
            return response()->json(['errors' => ['search_query' => 'Error fetching data from API']], $response->status());
        }

        $responseData = $response->json();

        // dd($responseData);
        // exit();

        if (isset($responseData['result']) && !empty($responseData['result'])) {
            $results = $responseData['result'];
            $locations = array_map(function ($result) {
                return [
                    'latitude' => $result['latitude'] ?? '',
                    'longitude' => $result['longitude'] ?? '',
                ];
            }, $results);

            return response()->json([
                'success' => true,
                'locations' => $locations,
                'search_query' => $searchQuery,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'errors' => ['search_query' => 'No results found for your query']
            ], 401);
        }
    }


    // public function restaurantProcess(Request $request)
    // {
    //     $searchQuery = $request->input('search_query');
    //     $endpoint = "https://api.therecz.com//api/search/nearby-posts.php";
    //     $postfields = [
    //         'search' => $searchQuery,
    //         'latitude' => 32.1343,
    //         'longitude' => 74.0153,
    //         'skipCache' => true
    //     ];

    //     $token = $request->header('Authorization');
    //     if (!$token) {
    //         return response()->json(['errors' => ['token' => 'Authorization token not provided']], 401);
    //     }

    //     // dd($searchQuery);
    //     // exit();

    //     $response = Http::withOptions([
    //         'verify' => false,
    //     ])->withHeaders([
    //         'Content-Type' => 'application/json',
    //         'Authorization' => $token,
    //     ])->post($endpoint, $postfields);

    //     if ($response->failed()) {
    //         return response()->json(['errors' => ['search_query' => 'Error fetching data from API']], $response->status());
    //     }

    //     $responseData = $response->json();

    //     // dd($responseData);
    //     // exit();

    //     if (isset($responseData['result'])) {
    //         $result = $responseData['result'];

    //         return response()->json([
    //             'success' => true,
    //             'result' => $result,
    //             'search_query' => $searchQuery,
    //         ]);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'errors' => ['search_query' => 'No results found for your query']
    //         ], 401);
    //     }
    // }

    public function restaurantProcess(Request $request)
    {
        $searchQuery = $request->input('search_query');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $endpoint = "https://api.therecz.com//api/search/nearby-posts.php";
        $postfields = [
            'search' => $searchQuery,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'skipCache' => true
        ];

        // dd($postfields);
        // exit();

        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['errors' => ['token' => 'Authorization token not provided']], 401);
        }

        // dd($token);
        // exit();

        $response = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $token,
        ])->post($endpoint, $postfields);

        // dd($postfields);
        // exit();

        if ($response->failed()) {
            return response()->json(['errors' => ['search_query' => 'Error fetching data from API']], $response->status());
        }

        $responseData = $response->json();

        // dd($responseData);
        // exit();

        if (isset($responseData['result'])) {
            $result = $responseData['result'];

            return response()->json([
                'success' => true,
                'result' => $result,
                'search_query' => $searchQuery,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'errors' => ['search_query' => 'No results found for your query']
            ], 401);
        }
    }


    public function searchListProcess(Request $request)
    {

        $searchQuery = $request->input('search_query');
        $catID = $request->input('catID', 0);
        $endpoint = "https://api.therecz.com/api/search/post-v2.php";
        $postfields = [
            'catID' => $catID,
            'search' => $searchQuery,
            'userID' => 0,
            'page' => 1,
        ];

        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['errors' => ['token' => 'Authorization token not provided']], 401);
        }

        $response = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $token,
        ])->post($endpoint, $postfields);

        if ($response->failed()) {
            return response()->json(['errors' => ['search_query' => 'Error fetching data from API']], $response->status());
        }

        $responseData = $response->json();

        // dd($responseData);
        // exit();

        if (!isset($responseData['result']) || is_null($responseData['result'])) {

            return redirect()->back()->with('notfound_message', 'This content is no longer available');
        }

        if (isset($responseData['result'])) {
            $result = $responseData['result'];

            session(['search_query' => $searchQuery]);

            Log::info('Search query successful. Redirecting to search-list with result:', ['result' => $result]);

            return response()->json([
                'success' => true,
                'result' => $result,
                'search_query' => $searchQuery,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'errors' => ['search_query' => 'No results found for your query']
            ], 401);
        }
    }


    public function searchDetail(Request $request)
    {
        $id = $request->query('id');

        if (!$id) {
            return redirect()->back()->withErrors('No ID provided for search detail.');
        }

        $token = $request->session()->get('api_token') ?: $request->header('Authorization');

        if (!$token) {
            return redirect()->back()->withErrors('Authorization token not provided.');
        }

        // Fetch post details
        $postEndpoint = "https://api.therecz.com/api/post/get.php";
        $postfields = ['pid' => $id];

        $postResponse = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ])
            ->post($postEndpoint, $postfields);

        if ($postResponse->failed()) {
            return redirect()->back()->withErrors('Error fetching post data from API.');
        }

        $postData = $postResponse->json();

        // dd($postData);
        // exit();

        if (!isset($postData['result']) || is_null($postData['result'])) {

            return redirect()->back()->with('popup_message', 'This content is deleted or no longer available');
        }

        $result = $postData['result'];

        // Fetch comments
        $commentsEndpoint = "https://api.therecz.com/api/post/get-comments.php";
        $commentsFields = ['pid' => $id, 'page' => 1];

        $commentsResponse = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ])
            ->post($commentsEndpoint, $commentsFields);

        if ($commentsResponse->failed()) {
            $comments = [];
            Log::error('Error fetching comments from API.');
        } else {
            $commentsData = $commentsResponse->json();
            $comments = isset($commentsData['result']) ? $commentsData['result'] : [];
        }

        // Fetch similar posts
        $similarEndpoint = "https://api.therecz.com/api/post/get-similar-posts.php";
        $similarFields = ['pid' => $id];

        $similarResponse = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ])
            ->post($similarEndpoint, $similarFields);

        if ($similarResponse->failed()) {
            $similarPosts = [];
            Log::error('Error fetching similar posts from API.');
        } else {
            $similarData = $similarResponse->json();
            $similarPosts = isset($similarData['result']) ? $similarData['result'] : [];
        }

        if (isset($result['link']) && strpos($result['link'], 'youtube.com') !== false) {
            $result['embed_link'] = $this->getYoutubeEmbedUrl($result['link']);
        } else {
            $result['embed_link'] = null;
        }

        Log::info('Search detail successful. Displaying result:', ['result' => $result]);

        return view('frontend.pages.search-detail', compact('result', 'comments', 'similarPosts'));
    }


    private function getYoutubeEmbedUrl($url)
    {
        preg_match("/v=([a-zA-Z0-9_-]+)/", $url, $matches);
        return isset($matches[1]) ? 'https://www.youtube.com/embed/' . $matches[1] : $url;
    }



    public function searchDetail2()
    {


        return view('frontend.pages.search-detail2');
    }
}
