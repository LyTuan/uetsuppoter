<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;

use App\Point;
use App\Schedule;
use App\Semester;
use App\Tuition;
use PushNotification;

include('simple_html_dom.php');

class UetNews extends Controller
{
	public function sendNotificationToDevice($message)
    {
        $deviceToken = 'AIzaSyDgGS-4I2gVC0KxksiNksNyFbghai_jLPc';

        // Send the notification to the device with a token of $deviceToken
        $collection = PushNotification::app('appNameAndroid')
            ->to($deviceToken);
        $collection->adapter->setAdapterParameters(['sslverifypeer' => false]);
        $collection->send($message);
    
    }
    
	public function tuitionNews() {
		$tuitions = array();
		if (sizeof($tuitions) == 0) {
			# code...
			$articles = array();

	        $prefix = "http://uet.vnu.edu.vn";

	        $html = file_get_html('http://uet.vnu.edu.vn/coltech/taxonomy/term/56');
	     //    $html = new simple_html_dom();
		    // $html->load_file();
		 
		    $items = $html->find('div[class=views-field-title]');  
	 
			foreach($items as $post) {
			    # remember comments count as nodes
			    $tuition = new Tuition;
			    if ($post->children(0)->children(0) != null && $post->children(0)->children(0)->children(0) != null) {
			    	$tuition->title = $post->children(0)->children(0)->children(0)->plaintext;
			    	$tuition->link = $prefix.$post->children(0)->children(0)->href;
			    	$tuition->save();
			    	$articles[] = array($prefix.$post->children(0)->children(0)->href,
			                        $post->children(0)->children(0)->children(0)->plaintext);

			    }
			}
			$tuitions = $articles;
		} else {
			$tuitions = Tuition::orderBy('created_at','asc')->get();
		}
    	return response()->json($tuitions);
	}

    public function getTuitionNotification()
    {
    	$oldCount = Tuition::count();
    	$newCount = 0;
    	Tuition::truncate();
        $articles = array();
        $newArticles = array();

        $prefix = "http://uet.vnu.edu.vn";

        $html = file_get_html('http://uet.vnu.edu.vn/coltech/taxonomy/term/56');
     //    $html = new simple_html_dom();
	    // $html->load_file();
	 
	    $items = $html->find('div[class=views-field-title]');  
 
		foreach($items as $post) {
		    # remember comments count as nodes
		    $tuition = new Tuition;
		    if ($post->children(0)->children(0) != null && $post->children(0)->children(0)->children(0) != null) {
		    	$tuition->title = $post->children(0)->children(0)->children(0)->plaintext;
		    	$tuition->link = $prefix.$post->children(0)->children(0)->href;
		    	$tuition->save();
		    	$articles[] = array($post->children(0)->children(0)->href,
		                        $post->children(0)->children(0)->children(0)->plaintext);

		    }
		   
		}
		$newCount = sizeof($articles);
		if ($newCount > $oldCount) {
			$size = $newCount - $oldCount;
			for($i = 0; $i < $size; $i++) {
				$newArticles[$i] = $articles[$i];
			}
			$this->sendNotificationToDevice($newArticles);
			return response()->json(array(
		            'result' => true,
		            'news' => $newArticles,
		            'status_code' => 200
		        ));
		} else {
			return response()->json(array(
		            'result' => false,
		            'status_code' => 200
		        ));
		}
		// getArticles();

		// return view('index')->with('articles', $articles);
		// return response()->json($articles);
    }

    public function getAvailableSubject($id) {
    	$articles = array();
    	$prefix = "http://uet.vnu.edu.vn";

    	$url = "http://www.coltech.vnu.edu.vn/news4st/test.php";
		$query = http_build_query((array('lstClass' => $id)));
		$options = array(
		    'http' => array(
		        'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
		                    "Content-Length: ".strlen($query)."\r\n".
		                    "User-Agent:MyAgent/1.0\r\n",
		        'method'  => "POST",
		        'content' => $query,
		    ),
		);
		$context = stream_context_create($options);
		$result = file_get_contents($url, false, $context, -1, 40000);

		$html = str_get_html($result);

		// $json = json_decode($content, true);

		$items = $html->find('a[class=newslist]');  
		foreach($items as $post) {
		    # remember comments count as nodes

		    if ($post != null && $post->children(0) != null) {

		    	$articles[] = array($prefix.substr($post->href,2),
		                        $post->children(0)->plaintext);
		    }
		}

		return response()->json(array(
		            'result' => true,
		            'subject' => $articles,
		            'status_code' => 200
		        ));
    }

    public function point() {

    	$semester = Semester::where('userID', 1)->first()->semester;
    	$requireSubject = Point::where('userID', 1)->get();
    	$articles = array();
    	$availleSubject = array();

    	$url = "http://www.coltech.vnu.edu.vn/news4st/test.php";
		$query = http_build_query((array('lstClass' => $semester)));
		$options = array(
		    'http' => array(
		        'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
		                    "Content-Length: ".strlen($query)."\r\n".
		                    "User-Agent:MyAgent/1.0\r\n",
		        'method'  => "POST",
		        'content' => $query,
		    ),
		);
		$context = stream_context_create($options);
		$result = file_get_contents($url, false, $context, -1, 40000);

		$html = str_get_html($result);

		// $json = json_decode($content, true);

		$items = $html->find('a[class=newslist]');  
		foreach($items as $post) {
		    # remember comments count as nodes

		    if ($post != null && $post->children(0) != null) {

		    	$articles[] = array($post->href,
		                        $post->children(0)->plaintext);
		    	for ($i=0; $i < sizeof($requireSubject); $i++) { 
		    		if (strpos($post->children(0)->plaintext, $requireSubject[$i]->subject) !== false) {
					    array_push($availleSubject, $requireSubject[$i]);
					}
		    	}
		    }
			
		}
		$this->sendNotificationToDevice($availleSubject);

		return response()->json($availleSubject);
    }

    public function scheduleNews() {
		$schedules = array();
		if (sizeof($schedules) == 0) {
			# code...$articles = array();
	        $articles = array();

	        $prefix = "http://uet.vnu.edu.vn";

	        $html = file_get_html('http://uet.vnu.edu.vn/coltech/taxonomy/term/54');
	     //    $html = new simple_html_dom();
		    // $html->load_file();
		 
		    $items = $html->find('div[class=views-field-title]');  
	 
			foreach($items as $post) {
				$schedule = new Schedule;
			    # remember comments count as nodes
			    if ($post->children(0)->children(0) != null && $post->children(0)->children(0)->children(0) != null) {
			    	$schedule->title = $post->children(0)->children(0)->children(0)->plaintext;
			    	$schedule->link = $prefix.$post->children(0)->children(0)->href;
			    	$schedule->save();

			    	$articles[] = array($prefix.$post->children(0)->children(0)->href,
			                        $post->children(0)->children(0)->children(0)->plaintext);
			    }
			   
			}
			$schedules = $articles;
		} else {
			$schedules = Schedule::orderBy('created_at','asc')->get();
		}
    	return response()->json($schedules);
	}

	public function registerSemester(Request $request) {
		$semester = $request->all();
	   	Semester::create($semester);
	   	return response()->json(array(
		            'result' => true,
		            'status_code' => 200
		        ));
	}

	public function registerSubject(Request $request) {
		$subject = $request->all();
	   	Point::create($subject);
	   	return response()->json(array(
		            'result' => true,
		            'status_code' => 200
		        ));
	}

    public function getScheduleNotification()
    {

    	$oldCount = Schedule::count();
    	$newCount = 0;
    	Schedule::truncate();
        $articles = array();
        $newArticles = array();

        $prefix = "http://uet.vnu.edu.vn";

        $html = file_get_html('http://uet.vnu.edu.vn/coltech/taxonomy/term/54');
     //    $html = new simple_html_dom();
	    // $html->load_file();
	 
	    $items = $html->find('div[class=views-field-title]');  
 
		foreach($items as $post) {
			$schedule = new Schedule;
		    # remember comments count as nodes
		    if ($post->children(0)->children(0) != null && $post->children(0)->children(0)->children(0) != null) {
		    	$schedule->title = $post->children(0)->children(0)->children(0)->plaintext;
		    	$schedule->link = $prefix.$post->children(0)->children(0)->href;
		    	$schedule->save();

		    	$articles[] = array($post->children(0)->children(0)->href,
		                        $post->children(0)->children(0)->children(0)->plaintext);
		    }
		   
		}
		$newCount = sizeof($articles);
		if ($newCount > $oldCount) {
			$size = $newCount - $oldCount;
			for($i = 0; $i < $size; $i++) {
				$newArticles[$i] = $articles[$i];
			}

			$this->sendNotificationToDevice($newArticles);
			return response()->json(array(
		            'result' => true,
		            'news' => $newArticles,
		            'status_code' => 200
		        ));
		} else {
			return response()->json(array(
		            'result' => false,
		            'status_code' => 200
		        ));
		}
		// getArticles();

		// return view('index')->with('articles', $articles);
		return response()->json($articles);
    }

}
