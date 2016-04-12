<?php

namespace common\traits;

use Yii;

use yii\base\Model;
use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Image\ImageInterface;





trait ImageUploadTrait
{
	
 	public function uploadImage($image,$name,$main_folder,$size)
    {
		//Tinify\setKey('o4wsFZIT3uOpeoHzkMt4VWG7HL6GAZ9b');
		$imagine = new Image();		
		$folders = Yii::$app->params['folders']['name'];
		$image_name = $name.'.'. $image->extension;
		foreach($folders as $folder){
			
			$$folder = Yii::$app->params[$folder] . $main_folder .'/'. $image_name;
			if (!file_exists(Yii::$app->params[$folder] . $main_folder )) {
				mkdir(Yii::$app->params[$folder] . $main_folder , 0777, true);
			}
		}

		if($image->saveAs($uploadMain)){
			
			$imagineObj =  yii\imagine\Image::getImagine();			
		
			
				$compress = array('quality' => 75);
				$imagineObj->open($uploadMain)
				->save($uploadMain, $compress); // from 0 to 9	


			
			list($newWidth, $newHeight) = getimagesize($uploadMain);
			
			//$imageObj->thumbnail(new Box($newWidth, $newHeight))->save($uploadMain , $compress);


			   
			$i = 0;
			foreach($folders as $folder){
				$imaginename = 'imgobj'.$i;
				if($folder == 'uploadThumbs' && $size[$folder] != ''){		
					$$imaginename = $imagineObj->open($uploadMain);					
					$$imaginename->resize($$imaginename->getSize()->widen($size[$folder]))->save(Yii::$app->params[$folder] . $main_folder .'/'. $image_name);	 				
				
					//Image::thumbnail($uploadMain, $size[$folder], $size[$folder])
						//->save(Yii::$app->params[$folder] . $main_folder .'/'. $image_name, $compress);	   
				}else if($folder != 'uploadMain' && $size[$folder] != ''){
					$$imaginename = $imagineObj->open($uploadMain);	
					
					$$imaginename->resize($$imaginename->getSize()->widen($size[$folder]))->save(Yii::$app->params[$folder] . $main_folder .'/'. $image_name);	
				}
				
				$i++;
			}
			
			return $image_name;
		}else{
			return false;
		}
    }
 	public function uploadImageArray($image,$name,$main_folder,$size)
    {

		//Tinify\setKey('o4wsFZIT3uOpeoHzkMt4VWG7HL6GAZ9b');
		$imagine = new Image();		
		$folders = Yii::$app->params['folders']['name'];
		$image_name = $name.'.'. $image->extension;
		foreach($folders as $folder){
			
			$$folder = Yii::$app->params[$folder] . $main_folder .'/'. $image_name;
			if (!file_exists(Yii::$app->params[$folder] . $main_folder )) {
				mkdir(Yii::$app->params[$folder] . $main_folder , 0777, true);
			}
		}

		if($image->saveAs($uploadMain)){
		
			$imagineObj =  new gd();			
			if($image->extension == 'jpg' || $image->extension == 'JPEG'){			
			
				$compress = array('quality' => 75);
				$imagineObj->open($uploadMain)
				->save($uploadMain, $compress); // from 0 to 9	
			}else{	
			
				$imagineObj =   new gd();
				$compress = array('quality' => 67);		
				$imagineObj->open($uploadMain)
					->save($uploadMain, $compress); // from 0 to 9	
			   
				$filesize = round((filesize($uploadMain)/1024));
/* 				if($filesize > 200){
					try {
						Tinify\fromFile($uploadMain)->toFile($uploadMain);
					}catch(Exception $e) {
						Tinify\setKey('o4wsFZIT3uOpeoHzkMt4VWG7HL6GAZ9b');
						try {
							Tinify\fromFile($uploadMain)->toFile($uploadMain);
						}catch(Exception $e) {
							
						}
						
					}
				}	 */
			}
		
			list($newWidth, $newHeight) = getimagesize($uploadMain);
			
			$i = 0;
			foreach($folders as $folder){
				$imaginename = 'imgobj'.$i;
				if($folder == 'uploadThumbs' && $size[$folder] != ''){		
					//Image::thumbnail($uploadMain, $size[$folder], $size[$folder])
						//->save(Yii::$app->params[$folder] . $main_folder .'/'. $image_name, ['quality' => 80]);

					$$imaginename = $imagineObj->open($uploadMain);					
					$$imaginename->resize($$imaginename->getSize()->widen($size[$folder]))->save(Yii::$app->params[$folder] . $main_folder .'/'. $image_name);	
					
				}else if($folder != 'uploadMain' && $size[$folder] != ''){
					$$imaginename = $imagineObj->open($uploadMain);	
					
					$$imaginename->resize($$imaginename->getSize()->widen($size[$folder]))->save(Yii::$app->params[$folder] . $main_folder .'/'. $image_name);	
				}
				
				$i++;
			}
			
			return $image_name;
		}else{
			return false;
		}
    }


}


