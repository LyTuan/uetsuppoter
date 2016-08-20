<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use PushNotification;

class PushNotificationController extends Controller
{
   public function sendNotificationToDevice()
    {
        $deviceToken = 'AIzaSyDgGS-4I2gVC0KxksiNksNyFbghai_jLPc';

        $message = 'We have successfully sent a push notification!';

        // Send the notification to the device with a token of $deviceToken
        $collection = PushNotification::app('appNameAndroid')
            ->to($deviceToken);
        $collection->adapter->setAdapterParameters(['sslverifypeer' => false]);
        $collection->send($message);

        return response()->json(array(
                'result' => true,
                'status_code' => 200
            ));
    }
}
