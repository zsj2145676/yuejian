<?php

class UploadAction extends Action {

function ImageCreateFromBMP( $filename ) 
{ 
	if ( ! $f1 = fopen ( $filename , "rb" )) return FALSE ; 

	$FILE = unpack ( "vfile_type/Vfile_size/Vreserved/Vbitmap_offset" , fread ( $f1 , 14 )); 
	if ( $FILE [ 'file_type' ] != 19778 ) return FALSE ; 

	$BMP = unpack ( 'Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel' . '/Vcompression/Vsize_bitmap/Vhoriz_resolution' . 
	'/Vvert_resolution/Vcolors_used/Vcolors_important' , fread ( $f1 , 40 )); 
	$BMP [ 'colors' ] = pow ( 2 , $BMP [ 'bits_per_pixel' ]); 
	if ( $BMP [ 'size_bitmap' ] == 0 ) $BMP [ 'size_bitmap' ] = $FILE [ 'file_size' ] - $FILE [ 'bitmap_offset' ]; 
	$BMP [ 'bytes_per_pixel' ] = $BMP [ 'bits_per_pixel' ] / 8 ; 
	$BMP [ 'bytes_per_pixel2' ] = ceil ( $BMP [ 'bytes_per_pixel' ]); 
	$BMP [ 'decal' ] = ( $BMP [ 'width' ] * $BMP [ 'bytes_per_pixel' ] / 4 ); 
	$BMP [ 'decal' ] -= floor ( $BMP [ 'width' ] * $BMP [ 'bytes_per_pixel' ] / 4 ); 
	$BMP [ 'decal' ] = 4 - ( 4 * $BMP [ 'decal' ]); 
	if ( $BMP [ 'decal' ] == 4 ) $BMP [ 'decal' ] = 0 ; 

	$PALETTE = array (); 
	if ( $BMP [ 'colors' ] < 16777216 ) 
	{ 
	$PALETTE = unpack ( 'V' . $BMP [ 'colors' ] , fread ( $f1 , $BMP [ 'colors' ] * 4 )); 
	} 

	$IMG = fread ( $f1 , $BMP [ 'size_bitmap' ]); 
	$VIDE = chr ( 0 ); 
	$res = imagecreatetruecolor( $BMP [ 'width' ] , $BMP [ 'height' ]); 
	$P = 0 ; 
	$Y = $BMP [ 'height' ] - 1 ; 
	while ( $Y >= 0 ) 
	{ 
	$X = 0 ; 
	while ( $X < $BMP [ 'width' ]) 
	{ 
	if ( $BMP [ 'bits_per_pixel' ] == 24 ) 
	$COLOR = unpack ( "V" , substr ( $IMG , $P , 3 ) . $VIDE ); 
	elseif ( $BMP [ 'bits_per_pixel' ] == 16 ) 
	{ 
	$COLOR = unpack ( "n" , substr ( $IMG , $P , 2 )); 
	$COLOR [ 1 ] = $PALETTE [ $COLOR [ 1 ] + 1 ]; 
	} 
	elseif ( $BMP [ 'bits_per_pixel' ] == 8 ) 
	{ 
	$COLOR = unpack ( "n" , $VIDE . substr ( $IMG , $P , 1 )); 
	$COLOR [ 1 ] = $PALETTE [ $COLOR [ 1 ] + 1 ]; 
	} 
	elseif ( $BMP [ 'bits_per_pixel' ] == 4 ) 
	{ 
	$COLOR = unpack ( "n" , $VIDE . substr ( $IMG , floor ( $P ) , 1 )); 
	if (( $P * 2 ) % 2 == 0 ) $COLOR [ 1 ] = ( $COLOR [ 1 ] >> 4 ) ; else $COLOR [ 1 ] = ( $COLOR [ 1 ] & 0x0F ); 
	$COLOR [ 1 ] = $PALETTE [ $COLOR [ 1 ] + 1 ]; 
	} 
	elseif ( $BMP [ 'bits_per_pixel' ] == 1 ) 
	{ 
	$COLOR = unpack ( "n" , $VIDE . substr ( $IMG , floor ( $P ) , 1 )); 
	if (( $P * 8 ) % 8 == 0 ) $COLOR [ 1 ] = $COLOR [ 1 ] >> 7 ; 
	elseif (( $P * 8 ) % 8 == 1 ) $COLOR [ 1 ] = ( $COLOR [ 1 ] & 0x40 ) >> 6 ; 
	elseif (( $P * 8 ) % 8 == 2 ) $COLOR [ 1 ] = ( $COLOR [ 1 ] & 0x20 ) >> 5 ; 
	elseif (( $P * 8 ) % 8 == 3 ) $COLOR [ 1 ] = ( $COLOR [ 1 ] & 0x10 ) >> 4 ; 
	elseif (( $P * 8 ) % 8 == 4 ) $COLOR [ 1 ] = ( $COLOR [ 1 ] & 0x8 ) >> 3 ; 
	elseif (( $P * 8 ) % 8 == 5 ) $COLOR [ 1 ] = ( $COLOR [ 1 ] & 0x4 ) >> 2 ; 
	elseif (( $P * 8 ) % 8 == 6 ) $COLOR [ 1 ] = ( $COLOR [ 1 ] & 0x2 ) >> 1 ; 
	elseif (( $P * 8 ) % 8 == 7 ) $COLOR [ 1 ] = ( $COLOR [ 1 ] & 0x1 ); 
	$COLOR [ 1 ] = $PALETTE [ $COLOR [ 1 ] + 1 ]; 
	} 
	else 
	return FALSE ; 
	imagesetpixel( $res , $X , $Y , $COLOR [ 1 ]); 
	$X ++ ; 
	$P += $BMP [ 'bytes_per_pixel' ]; 
	} 
	$Y -- ; 
	$P += $BMP [ 'decal' ]; 
	} 

	fclose ( $f1 ); 
	return $res ; 
} 


function ImageToJPG($srcFile,$dstFile) 
{ 
	// dump($dstFile);
	$quality=80; 
	$data = @GetImageSize($srcFile); 
	// dump($data);
	$towidth = $data[0];
	$toheight = $data[1];
	switch ($data['2']) 
	{ 
	case 1: 
	$im = imagecreatefromgif($srcFile); 
	break; 
	
	case 2: 
	$im = imagecreatefromjpeg($srcFile); 
	break; 
	
	case 3: 
	$im = imagecreatefrompng($srcFile); 
	break; 

	case 6: 
	$im = ImageCreateFromBMP( $srcFile ); 
	break; 
	} 
	// $dstX=$srcW=@ImageSX($im); 
	// $dstY=$srcH=@ImageSY($im); 
	// dump($im);
	$srcW=@ImageSX($im); 
	$srcH=@ImageSY($im); 
	$dstX=$towidth; 
	$dstY=$toheight; 

	$ni=@imageCreateTrueColor($dstX,$dstY); 
	$bg = imagecolorallocate($ni, 255, 255, 255);
	imagefill($ni, 0, 0, $bg);
	@ImageCopyResampled($ni,$im,0,0,0,0,$dstX,$dstY,$srcW,$srcH); 
	@ImageJpeg($ni,$dstFile,$quality); 
	@imagedestroy($im); 
	@imagedestroy($ni); 
}

//ImageToJPG('源文件名','目标文件名',目标宽,目标高); 

	public function avatar(){
		$small_w = SMALL_W;
		$small_h = SMALL_H;
		$large_w = LARGE_W;
		$large_h = LARGE_H;
		$normal_w = NORMAL_W;
		$normal_h = NORMAL_H;
		$ret = null;
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  AVATAR_DIR;//'./Uploads/avatar/';// 设置附件上传目录
		$upload->thumb = false;
		// $upload->thumbPrefix = 'small_,large_,normal_';
		// $upload->thumbRemoveOrigin = false;
		//$upload->thumbExt = AVATAR_EXT;
		// $upload->thumbMaxWidth = "$small_w,$large_w,$normal_w";
		// $upload->thumbMaxHeight = "$small_h,$large_h,$normal_h";
		$upload->imageClassPath = 'ORG.Util.Image';
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
			import('Org.Util.Image');
			$path = $info[0]['savename'];
			$src = AVATAR_DIR.$path;
			// dump($info);
			if($info[0]['type']!='image/jpeg'){
				// du
				// dump('hhe');
				$segs = explode('.',$path);
				$jpegdst = AVATAR_DIR.$segs[0].'.jpg';
				$this->ImageToJPG($src,$jpegdst);
				unlink($src);
				$path = $segs[0].'.jpg';
				$src = $jpegdst;
			}
			$large_path = AVATAR_DIR.'large_'.$path;
			Image::thumb($src,$large_path,'jpg',LARGE_W,LARGE_H);
			$normal_path = AVATAR_DIR.'normal_'.$path;
			Image::thumb($src,$normal_path,'jpg',NORMAL_W,NORMAL_H);
			$small_path = AVATAR_DIR.'small_'.$path;
			Image::thumb($src,$small_path,'jpg',SMALL_W,SMALL_H);
			unlink($src);
			//$name = explode('.',$path)[0];
                        $ret['status']=1;
			$ret['small'] = avatar_url($path,'small');
			$ret['large'] = avatar_url($path,'large');
			$ret['normal'] = avatar_url($path,'normal');
			import('@.Action.User');
			$user = new UserAction();
			$user->setAvatar($path);
		}
		$this->ajaxReturn($ret,'JSON');
	}
	
	/*!
	* @return 成功返回路径，否则返回null
	*/
	public function crop($src, $x, $y, $w, $h)
	{
		$ret = NULL;
		$tmp = explode('_',$src);
		$name = $tmp[1];
		$path = 'crop_'.$name;
		$src_path = ".".$src;
		import('Org.Util.Image');
		$info = Image::getImageInfo($src_path);
		$type = $info['type'];
		// $x = (int)($x*$info['width']/LARGE_W);
		// $w = (int)($w*$info['width']/LARGE_W);
		// $y = (int)($y*$info['height']/LARGE_H);
		// $h = (int)($h*$info['height']/LARGE_H);
		// dump("$x-$y:$w-$h");
		$x = (int) ($x);
		$y = (int) ($y);
		$w = (int) ($w);
		$h = (int) ($h);
		
        $createFun = 'ImageCreateFrom' . ($type == 'jpg' ? 'jpeg' : $type);
        if(!function_exists($createFun)) {
            return false;
        }
        $src_im = $createFun($src_path);
		$crop_im = imagecreatetruecolor($w, $h);
		imagecopyresampled($crop_im,$src_im,0,0,$x,$y,$w,$h,$w,$h);
		$crop_path = AVATAR_DIR.$path;
		$ImageFun = 'image' . $type;
		// dump($crop_im);
		// $image, $thumbname, $type='', $maxWidth=200, $maxHeight=50, $interlace=true
		if($ImageFun($crop_im,$crop_path)){
			$normal_path = AVATAR_DIR.'normal_'.$name;
			Image::thumb($crop_path,$normal_path,$type,NORMAL_W,NORMAL_H);
			$small_path = AVATAR_DIR.'small_'.$name;
			Image::thumb($crop_path,$small_path,$type,SMALL_W,SMALL_H);
			$ret['normal'] = $normal_path;
			$ret['small'] = $small_path;
			imagedestroy(src_im);
			imagedestroy(crop_im);
			unlink($crop_path);
		}
		$this->ajaxReturn($ret,'JSON');
	}
}