<?php

namespace App\Http\Controllers;

use App\Models\Course;
use GuzzleHttp\Client;

class CourseController extends Controller
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getExternalUserData()
{
    $response = $this->client->request('GET', 'https://jsonplaceholder.typicode.com/users/1');

    if ($response->getStatusCode() === 200) {
        $userData = json_decode($response->getBody()->getContents(), true);
        return Course::create($userData);
    } else {
        return response()->json(['error' => 'Failed to consume API'], $response->getStatusCode());
    }
}

public function index()
{
 $test = Course::all();
 return view('op', compact('test'));
}
}


// class CourseController extends Controller
// {
//     public function storeDataFromApi()
//     {
//         $client = new Client();

//         // Ganti dengan URL API eksternal
//         $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/users/');

//         if ($response->getStatusCode() === 200) {
//             $data = json_decode($response->getBody()->getContents(), true);

//             foreach ($data['users'] as $courseData) {
//                 $course = new Course();
//                 // $course->course_code = $courseData['course_code'];
//                 // $course->class_id = $courseData['class_id'];
//                 $course->email = $courseData['email'];
//                 $course->password = $courseData['password'];
//                 $course->name = $courseData['name'];
//                 $course->save();
//             }

//             return response()->json(['message' => 'Data berhasil disimpan']);
//         } else {
//             return response()->json(['message' => 'Gagal mengambil data dari API'], 500);
//         }
//     }
//     public function index()
//     {
//         $courses = Course::all();
//         return view('op', compact('courses'));
//     }
// }
