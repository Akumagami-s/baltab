<?php

namespace App\Helpers;

use App\Models\Activity;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ActivityHelper {
	public static function syncActivity(){
		if(\Config::get('app.api_sync') === false){
			return;
		}

		$activities = Activity::where('sync', false)->orderBy('_id','asc')->get();

		$client = new \GuzzleHttp\Client();

		$input = [
			'key'=>\Config::get('app.api_key'),
		];

		$activities_arr = $activities->toArray();
		$activity_ids = [];

		if(count($activities_arr)){
			foreach ($activities_arr as $key => $values) {
				$activity_ids[] = $values['_id'];

				unset($values['_id']);
				unset($values['causer']);
				unset($values['subject']);

				$values['sync'] = true;
				$values['sync_date'] = date('Y-m-d H:i:s');

				$input['values'][] = $values;
			}
			
			try{
				$res = $client->request('post', \Config::get('app.api_domain'), [
						'json'=>$input
				]);

				if($res->getStatusCode() == '200'){
					foreach ($activity_ids as $activity_id) {
						$model = Activity::find($activity_id);
						$model->sync = true;
						$model->sync_date = date('Y-m-d H:i:s');
						$model->save();
					}
				}
			} catch (\Exception $e){
				$response = $e->getMessage();

				$log = ['description' => $response];

				$syngLog = new Logger('sync');
				$syngLog->pushHandler(new StreamHandler(storage_path('logs/sync.log')), Logger::WARNING);
				$syngLog->warning('SyncLog', $log);

				session()->flash('error', $response);

				return false;
			}
		}

		return count($activities_arr);
	}

	public static function unsync_count(){
		$activities = Activity::where('sync', false)->count();

		return $activities;
	}
} 