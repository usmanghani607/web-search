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
        return view('frontend/pages/restaurants');
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
        $tokenEndpoint = "https://api-dev.therecz.com/api/token/generate.php";
        $ch = curl_init();

        $postfields = json_encode([
            'apiKey' => 'ac0e4eb5a33848a3a28159ac07df3e62',
            'callFrom' => 'ANDROID'
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

        $endpoint = "https://api-dev.therecz.com/api/user/login.php";
        $postfields = json_encode([
            'emailID' => $email,
            'pass' => $password,
            'apiKey' => 'thp74it7oiyob7fivnpgsm5bngtzil',
            'callFrom' => 'IOS',
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

    public function searchListProcess(Request $request)
    {

        $searchQuery = $request->input('search_query');
        $endpoint = "https://api-dev.therecz.com/api/search/post-v2.php";
        $postfields = [
            'catID' => 0,
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


    // public function searchDetail(Request $request)
    // {
    //     $id = $request->query('id');
    //     if (!$id) {
    //         return redirect()->back()->withErrors('No ID provided for search detail.');
    //     }

    //     $endpoint = "https://api-dev.therecz.com/api/post/get-v2.php";
    //     $postfields = [
    //         'groupID' => 0,
    //         'dataSrc' => 'TMDB',
    //         'dataSrcID' => 10137
    //     ];

    //     // Check if the token is stored in the session or request header
    //     $token = $request->session()->get('api_token') ?: $request->header('Authorization');

    //     // dd($token);
    //     // exit();

    //     if (!$token) {
    //         return redirect()->back()->withErrors('Authorization token not provided.');
    //     }

    //     $response = Http::withOptions([
    //         'verify' => false,
    //     ])->withHeaders([
    //         'Content-Type' => 'application/json',
    //         'Authorization' => 'Bearer ' . $token,
    //     ])->post($endpoint, $postfields);

    //     // dd($response);
    //     // exit();

    //     if ($response->failed()) {
    //         return redirect()->back()->withErrors('Error fetching data from API.');
    //     }

    //     // dd($response);
    //     // exit();

    //     $responseData = $response->json();

    //     // dd($responseData);
    //     // exit();

    //     if (isset($responseData['result'])) {
    //         $result = $responseData['result'];

    //         Log::info('Search detail successful. Displaying result:', ['result' => $result]);

    //         return view('frontend.pages.search-detail', compact('result'));
    //     } else {
    //         return redirect()->back()->withErrors('No results found for the given ID.');
    //     }
    // }


    public function searchDetail(Request $request)
    {
        $id = $request->query('id');
        $dataSrcID = $request->query('dataSrcID');

        // dd($id);
        // exit();

        if (!$id && !$dataSrcID) {
            return redirect()->back()->withErrors('No ID or dataSrcID provided for search detail.');
        }

        // dd($dataSrcID);
        // exit();

        $token = $request->session()->get('api_token') ?: $request->header('Authorization');
        if (!$token) {
            return redirect()->back()->withErrors('Authorization token not provided.');
        }

        if (is_numeric($dataSrcID)) {
            $endpoint = "https://api-dev.therecz.com/api/post/get-v2.php";
            $postfields = [
                'groupID' => 0,
                'dataSrc' => 'TMDB',
                'dataSrcID' => $dataSrcID
            ];

            // dd($dataSrcID);
            // exit();

        } else {
            $endpoint = "https://api-dev.therecz.com/api/post/get.php";
            $postfields = [
                'pid' => $id
            ];

            // dd($id);
            // exit();
        }

        // Make the API request
        $response = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->post($endpoint, $postfields);

        // dd($response);
        // exit();

        // Check for response errors
        if ($response->failed()) {
            return redirect()->back()->withErrors('Error fetching data from API.');
        }

        $responseData = $response->json();

        // dd($responseData);
        // exit();

        if (isset($responseData['result'])) {
            $result = $responseData['result'];

            Log::info('Search detail successful. Displaying result:', ['result' => $result]);

            return view('frontend.pages.search-detail', compact('result'));
        } else {
            return redirect()->back()->withErrors('No results found for the given ID.');
        }
    }




    public function searchDetail2()
    {


        return view('frontend.pages.search-detail2');
    }
}
