<?php

namespace app\models;
use yii\base\Model;

class UploadFileMoeld extends Model {
	
	public $imageFile;
	
	public $zipFile;//泛指压缩文件，在验证规则扩展
	
	public function rules()
	{
		return [
				[['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
				[['zipFile'] , 'file' , 'skipOnEmpty' =>false , 'extensions' => 'zip,rar'],
		];
	}
	
	public function uploadImage()
	{
		if ($this->validate()) {
			$this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
			return true;
		} else {
			return false;
		}
	}
	
	public function uploadZip(){
		
		if($this->validate()) {
			$this->zipFile->saveAs('uploads/'.$this->zipFile->baseName.'.'.$this->zipFile->extension);
		}
	}
	
	
	
}