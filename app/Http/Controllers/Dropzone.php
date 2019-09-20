<?php

namespace App\Http\Controllers;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

use Illuminate\Http\Request;
//use App\Libraries\Custom\S3;
use Illuminate\Contracts\Filesystem\Filesystem;
use Session;

class Dropzone extends Controller
{

    /**
     * This function used to upload image from grapes editor into S3 server
     * @param Request $request
     */
    public function upload_editor_image(Request $request)
    {

        /*$file = $request->file('files')->storeAs('campaign', 'umair.jpg', 's3');
        echo "Path is $file";
        pre($file);
        echo "File Name is ". $file->store;
        die;
        if(!empty($file)){

        }*/
        if (!empty($_FILES)) {
            //Collect Text Review(Save Video into S3)
            $oResource = isset($_FILES['files']) ? $_FILES['files'] : false;
            $ext = pathinfo($oResource['name'], PATHINFO_EXTENSION);
            $allowed_types = array("png", "gif", "jpeg", "jpg", "JPG", "JPEG", "PNG", "GIF");
            $error = "";
            if ($oResource !== false) {
                if (empty($error) && !in_array($ext, $allowed_types))
                    $error = "Invalid video file format";
                if (empty($error) && (!isset($oResource['size']) || $oResource['size'] > (6291456 * 100)))
                    $error = "Maximum filesize limit is 600MB only.";
                if (empty($error)) {
                    // Put file to AWS S3
                    $oResourceFile = "template_img_" . rand(1, 10000) . "_" . sha1(time()) . "." . $ext;
                    $filekey = "campaigns/" . $oResourceFile;
                    //$input = file_get_contents($oResource['tmp_name']);
                    //$this->s3->putObject($input, AWS_BUCKET, $filekey);
                    $input = file_get_contents($oResource['tmp_name']);
                    $s3 = \Storage::disk('s3');
                    $s3->put($filekey,$input, 'public');
                    //$path = $request->file('files')->store($filekey, 's3');
                } else {
                    echo "Error: " . $error;
                }
                //$aReviewData['comment_video'] = $oResourceFile;
                $s3Src = "https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/{$oResourceFile}";
                $img = file_get_contents($s3Src);
                $encodedImg = 'data:image/' . $ext . ';base64,' . base64_encode($img);

                $aData = array(
                    'type' => 'image',
                    'src' => $encodedImg,
                    'width' => 250,
                    'height' => 350
                );
                $response = array('data' => $aData);
                echo json_encode($response);
                exit;
            }
        }
    }


    /**
     *
     */
    public function upload_image(Request $request)
    {

        if (!empty($_FILES)) {

            //Collect Text Review(Save Video into S3)
            $videoReview = isset($_FILES['file']) ? $_FILES['file'] : false;
            $ext = pathinfo($videoReview['name'], PATHINFO_EXTENSION);
            $allowed_types = array("png", "gif", "jpeg", "jpg", "JPG", "JPEG", "PNG", "GIF");
            $error = "";
            if ($videoReview !== false) {
                if (empty($error) && !in_array($ext, $allowed_types))
                    $error = "Invalid video file format";

                if (empty($error) && (!isset($videoReview['size']) || $videoReview['size'] > (6291456 * 100)))
                    $error = "Maximum filesize limit is 600MB only.";

                if (empty($error)) {
                    // Put file to AWS S3
                    $videoReviewFile = "text_review_" . rand(1, 10000) . "_" . sha1(time()) . "." . $ext;
                    $filekey = "campaigns/" . $videoReviewFile;
                    $filename = $videoReview['name'];
                    $input = file_get_contents($videoReview['tmp_name']);
                    $s3 = \Storage::disk('s3');
                    $s3->put($filekey,$input, 'public');
                    //$path = $request->file('file')->store($filekey, 's3');
                }
                //$aReviewData['comment_video'] = $videoReviewFile;
                echo $videoReviewFile;
            }
        }
    }

    /**
     * Used to upload chat related images/videos upload
     */
    public function upload_chat_image(Request $request)
    {

        if (!empty($_FILES)) {

            //Collect Text Review(Save Video into S3)
            $videoReview = isset($_FILES['file']) ? $_FILES['file'] : false;
            $ext = pathinfo($videoReview['name'], PATHINFO_EXTENSION);
            $allowed_types = array("png", "gif", "jpeg", "jpg", "JPG", "JPEG", "PNG", "GIF");
            $error = "";
            if ($videoReview !== false) {
                if (empty($error) && !in_array($ext, $allowed_types))
                    $error = "Invalid video file format";

                if (empty($error) && (!isset($videoReview['size']) || $videoReview['size'] > (6291456 * 100)))
                    $error = "Maximum filesize limit is 600MB only.";

                if (empty($error)) {
                    // Put file to AWS S3
                    $videoReviewFile = "chat_logo_" . rand(1, 10000) . "_" . sha1(time()) . "." . $ext;
                    $filekey = "campaigns/" . $videoReviewFile;
                    //$this->s3->putObject($input, AWS_BUCKET, $filekey);
                    $filename = $videoReview['name'];
                    $input = file_get_contents($videoReview['tmp_name']);
                    $s3 = \Storage::disk('s3');
                    $s3->put($filekey,$input, 'public');
                    //$path = $request->file('files')->store($filekey, 's3');
                }
                //$aReviewData['comment_video'] = $videoReviewFile;
                echo $videoReviewFile;
            }
        }
    }

    /**
     * @param Request $request
     */
    public function upload_campaign_files(Request $request)
    {

        if (!empty($_FILES)) {

            //Collect Text Review(Save Video into S3)
            $videoReview = isset($_FILES['file']) ? $_FILES['file'] : false;
            $ext = pathinfo($videoReview['name'], PATHINFO_EXTENSION);
            $allowed_types = array("doc", "docx", "odt", "png", "gif", "jpeg", "jpg", "pdf", "PDF", "JPG", "JPEG", "PNG", "GIF", "DOC", "DOCX", "ODT");
            $error = "";
            if ($videoReview !== false) {
                if (empty($error) && !in_array($ext, $allowed_types))
                    $error = "Invalid video file format";

                if (empty($error) && (!isset($videoReview['size']) || $videoReview['size'] > (6291456 * 100)))
                    $error = "Maximum filesize limit is 600MB only.";

                if (empty($error)) {
                    // Put file to AWS S3
                    $videoReviewFile = "text_review_" . rand(1, 10000) . "_" . sha1(time()) . "." . $ext;
                    $filekey = "campaigns/" . $videoReviewFile;
                    //$this->s3->putObject($input, AWS_BUCKET, $filekey);
                    $filename = $videoReview['name'];
                    $input = file_get_contents($videoReview['tmp_name']);
                    $s3 = \Storage::disk('s3');
                    $s3->put($filekey,$input, 'public');
                    //$path = $request->file('file')->store($filekey, 's3');
                }

                echo $videoReviewFile;
                exit;
            }
        }
    }


    /**
     * Upload product related imgaes
     */
    public function upload_campaign_product_image(Request $request)
    {

        if (!empty($_FILES)) {

            //Collect Text Review(Save Video into S3)
            $videoReview = isset($_FILES['file']) ? $_FILES['file'] : false;
            $ext = pathinfo($videoReview['name'], PATHINFO_EXTENSION);
            $allowed_types = array("png", "jpeg", "jpg", "JPG", "JPEG", "PNG");
            $error = "";
            if ($videoReview !== false) {
                if (empty($error) && !in_array($ext, $allowed_types))
                    $error = "Invalid video file format";

                if (empty($error) && (!isset($videoReview['size']) || $videoReview['size'] > (6291456 * 100)))
                    $error = "Maximum filesize limit is 600MB only.";

                if (empty($error)) {
                    // Put file to AWS S3
                    $videoReviewFile = "bb_product_img_" . rand(1, 10000) . "_" . sha1(time()) . "." . $ext;
                    $filekey = "campaigns/" . $videoReviewFile;
                    //$this->s3->putObject($input, AWS_BUCKET, $filekey);
                    $filename = $videoReview['name'];
                    $input = file_get_contents($videoReview['tmp_name']);
                    $s3 = \Storage::disk('s3');
                    $s3->put($filekey,$input, 'public');
                    //$path = $request->file('file')->store($filekey, 's3');
                }
                //$aReviewData['comment_video'] = $videoReviewFile;
                echo $videoReviewFile;
            }
        }
    }


    /**
     * Used to upload videos
     * @param Request $request
     */
    public function upload_video(Request $request)
    {

        if (!empty($_FILES)) {

            //Collect Text Review(Save Video into S3)
            $videoReview = isset($_FILES['file']) ? $_FILES['file'] : false;
            $ext = pathinfo($videoReview['name'], PATHINFO_EXTENSION);
            //$allowed_types = array("avi", "asf", "mov", "qt", "avchd", "flv", "swf", "mpg", "mp4", "wmv", "h.264", "divx");
            $allowed_types = array("mp4");

            $error = "";
            if ($videoReview !== false) {
                if (empty($error) && !in_array($ext, $allowed_types))
                    $error = "Invalid video file format";

                if (empty($error) && (!isset($videoReview['size']) || $videoReview['size'] > (62914 * 100)))
                    $error = "Maximum filesize limit is 6MB only.";

                if (empty($error)) {
                    // Put file to AWS S3
                    $videoReviewFile = "video_review_" . rand(1, 10000) . "_" . sha1(time()) . "." . $ext;
                    $filekey = "campaigns/" . $videoReviewFile;
                    $filename = $videoReview['name'];
                    /*$res = $this->s3->putObject($input, clickdrop, $filekey);
                    var_dump($res);*/
                    $input = file_get_contents($videoReview['tmp_name']);
                    $s3 = \Storage::disk('s3');
                    $s3->put($filekey,$input, 'public');
                    //$path = $request->file('file')->store($filekey, 's3');
                }
                //$aReviewData['comment_video'] = $videoReviewFile;
                echo $videoReviewFile;
            }
        }
    }

    /**
     * Used to upload file
     * @param Request $request
     */
    public function upload(Request $request)
    {

        if (!empty($_FILES)) {

            //Collect Text Review(Save Video into S3)
            $upload = isset($_FILES['file']) ? $_FILES['file'] : false;
            $ext = pathinfo($upload['name'], PATHINFO_EXTENSION);
            //$allowed_types = array("avi", "asf", "mov", "qt", "avchd", "flv", "swf", "mpg", "mp4", "wmv", "h.264", "divx");
            $allowed_types = array("doc", "docx", "odt", "png", "gif", "jpeg", "jpg", "pdf", "PDF", "JPG", "JPEG", "PNG", "GIF", "DOC", "DOCX", "ODT", "mp4");

            $error = "";
            if ($upload !== false) {
                if (empty($error) && !in_array($ext, $allowed_types))
                    $error = "Invalid video file format";

                if (empty($error) && (!isset($upload['size']) || $upload['size'] > (102914 * 100)))
                    $error = "Maximum filesize limit is 10MB only.";

                if (empty($error)) {
                    // Put file to AWS S3
                    $videoReviewFile = "review_" . sha1(time()) . "." . $ext;
                    $filekey = "campaigns/" . $videoReviewFile;
                    /*
                    $res = $this->s3->putObject($input, clickdrop, $filekey);
                    var_dump($res);*/
                    $filename = $upload['name'];
                    $input = file_get_contents($upload['tmp_name']);
                    $s3 = \Storage::disk('s3');
                    $s3->put($filekey,$input, 'public');
                    //$path = $request->file('file')->store($filekey, 's3');
                }
                //$aReviewData['comment_video'] = $videoReviewFile;
                echo $videoReviewFile;
            }
        }
    }

    /**
     * Upload site Review files
     * @param Request $request
     */
    public function uploadSiteReviewFile(Request $request)
    {

        if (!empty($_FILES)) {

            //Collect Text Review(Save Video into S3)
            $videoReview = isset($_FILES['file']) ? $_FILES['file'] : false;
            $mediaName = $videoReview['name'];
            $ext = pathinfo($videoReview['name'], PATHINFO_EXTENSION);
            $allowed_types = array("doc", "docx", "odt", "png", "gif", "jpeg", "jpg", "pdf", "PDF", "JPG", "JPEG", "PNG", "GIF", "DOC", "DOCX", "ODT", "mp4");
            $error = "";
            if ($videoReview !== false) {
                if (empty($error) && !in_array($ext, $allowed_types))
                    $error = "Invalid video file format";

                if (empty($error) && (!isset($videoReview['size']) || $videoReview['size'] > (6291456 * 100)))
                    $error = "Maximum filesize limit is 600MB only.";

                if (empty($error)) {
                    // Put file to AWS S3
                    $videoReviewFile = "review_" . sha1(time()) . "." . $ext;
                    /*$filename = $videoReview['name'];
                    $this->s3->putObject($input, AWS_BUCKET, $filekey);*/
                    $filekey = "campaigns/" . $videoReviewFile;
                    $input = file_get_contents($videoReview['tmp_name']);
                    $s3 = \Storage::disk('s3');
                    $s3->put($filekey,$input, 'public');
                    //$path = $request->file('file')->store($filekey, 's3');
                }
                $mediaUrl = $videoReviewFile;
                //$mediaType = 'image';

                if ($ext == 'mp4') {
                    $mediaType = 'video';
                } else {
                    $mediaType = 'image';
                }

                //echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$mediaUrl;
                //echo '<input type="hidden" name="brand_img[media_url][]" value="'.$mediaUrl.'"><input type="hidden" name="brand_img[media_type][]" value="'.$mediaType.'">';

                echo '<input type="hidden" name="site_uploaded_name[media_url][]" value="' . $mediaUrl . '"><input type="hidden" name="site_uploaded_name[media_type][]" value="' . $mediaType . '"><input type="hidden" name="uploaded_name[media_name][]" value="' . $mediaName . '">';
                exit;
            }
        }

    }

    /**
     * Upload Company Logo
     * @param Request $request
     */
    public function uploadCompanyLogo(Request $request)
    {

        if (!empty($_FILES)) {

            //Collect Text Review(Save Video into S3)
            $file = isset($_FILES['file']) ? $_FILES['file'] : false;

            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $allowed_types = array("png", "gif", "jpeg", "jpg", "JPG", "JPEG", "PNG", "GIF");
            $error = "";
            if ($file !== false) {
                if (empty($error) && !in_array($ext, $allowed_types))
                    $error = "Invalid image file format";

                if (empty($error) && (!isset($file['size']) || $file['size'] > (6291456 * 100)))
                    $error = "Maximum filesize limit is 600MB only.";

                if (empty($error)) {
                    // Put file to AWS S3
                    $fileName = "company_" . sha1(time()) . "." . $ext;
                    /* $filename = $file['name'];
                    $this->s3->putObject($input, AWS_BUCKET, $filekey);*/
                    $filekey = "campaigns/" . $fileName;
                    $input = file_get_contents($file['tmp_name']);
                    $s3 = \Storage::disk('s3');
                    $s3->put($filekey,$input, 'public');
                    //$path = $request->file('file')->store($filekey, 's3');
                }
                $mediaUrl = $fileName;

                if ($ext == 'mp4') {
                    $mediaType = 'video';
                } else {
                    $mediaType = 'image';
                }

                echo '<input type="hidden" name="company_logo" value="' . $mediaUrl . '">';
                exit;
            }
        }
    }

    /**
     * Upload Product Review File
     * @param Request $request
     */
    public function uploadProductReviewFile(Request $request)
    {

        $orderVal = $request->orderVal;
        if (!empty($_FILES)) {

            //Collect Text Review(Save Video into S3)
            $videoReview = isset($_FILES['file']) ? $_FILES['file'] : false;
            $mediaName = $videoReview['name'];
            $ext = pathinfo($videoReview['name'], PATHINFO_EXTENSION);
            $ext = strtolower($ext);
            $allowed_types = array("doc", "docx", "odt", "png", "gif", "jpeg", "jpg", "pdf", 'mov', "mp4", 'asf', 'flv', 'm4v', 'm4a', '3g2', 'mj2', 'wmv', "PDF", "JPG", "JPEG", "PNG", "GIF", "DOC", "DOCX", "ODT", "MP4", 'MOV', 'ASF', 'FLV', 'M4V', 'M4A', '3G2', 'MJ2', 'WMV');
            $error = "";
            if ($videoReview !== false) {
                if (empty($error) && !in_array($ext, $allowed_types))
                    $error = "Invalid video file format";

                if (empty($error) && (!isset($videoReview['size']) || $videoReview['size'] > (6291456 * 100)))
                    $error = "Maximum filesize limit is 600MB only.";

                if (empty($error)) {
                    // Put file to AWS S3
                    $videoReviewFile = "review_" . sha1(time()) . "." . $ext;
                    $filekey = "campaigns/" . $videoReviewFile;
                    //$this->s3->putObject($input, AWS_BUCKET, $filekey);
                    $filename = $videoReview['name'];
                    $input = file_get_contents($videoReview['tmp_name']);
                    $s3 = \Storage::disk('s3');
                    $s3->put($filekey,$input, 'public');
                    //$path = $request->file('file')->store($filekey, 's3');
                }
                $mediaUrl = $videoReviewFile;


                $videoExt = array('mp4', 'mov', 'flv', 'm4v', 'm4a', 'wmv');
                $imageExt = array('png', 'gif', 'jpeg', 'jpg');

                if (in_array($ext, $videoExt)) {
                    $mediaType = 'video';
                } else if (in_array($ext, $imageExt)) {
                    $mediaType = 'image';
                } else {
                    $mediaType = 'other';
                }

                //echo 'https://s3-us-west-2.amazonaws.com/brandboost.io/campaigns/'.$mediaUrl;
                //echo '<input type="hidden" name="brand_img[media_url][]" value="'.$mediaUrl.'"><input type="hidden" name="brand_img[media_type][]" value="'.$mediaType.'">';

                echo '<input type="hidden" name="uploaded_name_' . $orderVal . '[media_url][]" value="' . $mediaUrl . '"><input type="hidden" name="uploaded_name_' . $orderVal . '[media_type][]" value="' . $mediaType . '"><input type="hidden" name="uploaded_name_' . $orderVal . '[media_name][]" value="' . $mediaName . '">';
                exit;
            }
        }

    }

    /**
     * Upload chat attachments
     * @param Request $request
     */
    public function upload_chat_attachment(Request $request)
    {

        $videoReviewFile = '';
        $error = "";
        $filesize = getFileSize('filesize');
        if (!empty($_FILES)) {

            $videoReview = isset($_FILES['files']) ? $_FILES['files'] : false;


            $ext = pathinfo($videoReview['name'][0], PATHINFO_EXTENSION);

            $allowed_types = array("doc", "docx", "odt", "png", "gif", "jpeg", "jpg", 'csv', "pdf", "PDF", "JPG", "JPEG", "PNG", "GIF", "DOC", "DOCX", "ODT", "CSV", "mp4", "3gp", "webm", "ogv", "mpeg", "mov");
            $error = "";

            //$fileSizeMax = FileSizeConvert($filesize);
            $filesizeInBytes = FileSizeConvertToBytes($filesize);
            if ($videoReview !== false) {
                if (empty($error) && !in_array($ext, $allowed_types))
                    $error = "Invalid file format";

                if (empty($error) && (!isset($videoReview['size'][0]) || $videoReview['size'][0] > ($filesizeInBytes)))
                    $error = "Maximum filesize limit is " . $filesize . "MB only.";

                if (empty($error)) {
                    // Put file to AWS S3
                    $videoReviewFile = "chat_" . rand(1, 10000) . "_" . sha1(time()) . "." . $ext;
                    $filekey = "campaigns/" . $videoReviewFile;
                    //$filekey = "chat_attachments/". $videoReviewFile;
                    /*$filename = $videoReview['name'][0];
                    $this->s3->putObject($input, AWS_BUCKET, $filekey);*/
                    $input = file_get_contents($videoReview['tmp_name'][0]);
                    $s3 = \Storage::disk('s3');
                    $s3->put($filekey,$input, 'public');
                    //$path = $request->file('files')->store($filekey, 's3');

                }
            }
        } else {
            $error = "Maximum filesize limit is " . $filesize . "MB only.";
        }

        $response = array('result' => $videoReviewFile, 'error' => $error);
        echo json_encode($response);
        exit;
    }

    /**
     * This function used to upload user images to the amazon s3 server
     * @return type object
     */
    public function upload_profile_image(Request $request)
    {

        if (!empty($_FILES)) {

            //Collect Text Review(Save Video into S3)
            $videoReview = isset($_FILES['file']) ? $_FILES['file'] : false;
            $ext = pathinfo($videoReview['name'], PATHINFO_EXTENSION);
            $allowed_types = array("png", "jpeg", "jpg", "JPG", "JPEG", "PNG");
            $error = "";
            if ($videoReview !== false) {
                if (empty($error) && !in_array($ext, $allowed_types))
                    $error = "Invalid video file format";

                if (empty($error) && (!isset($videoReview['size']) || $videoReview['size'] > (6291456 * 100)))
                    $error = "Maximum filesize limit is 600MB only.";

                if (empty($error)) {
                    // Put file to AWS S3
                    $videoReviewFile = "profile_image_" . rand(1, 10000) . "_" . sha1(time()) . "." . $ext;
                    $filekey = "campaigns/".$videoReviewFile;
                    $filePath = "campaigns";
                    $filename = $videoReview['name'];
                    $input = file_get_contents($videoReview['tmp_name']);
                    $s3 = \Storage::disk('s3');
                    $s3->put($filekey,$input, 'public');
                    //$path = $request->file('file')->storeAs($filePath, $videoReviewFile, 's3');


                }
                echo $videoReviewFile;
            }
        }
    }

    /**
     * This function used to edit review image to the amazon s3 server
     * @return type object
     */
    public function edit_review_image(Request $request)
    {

        if (!empty($_FILES)) {

            $filesize = getFileSize('filesize');
            $filesizeInBytes = FileSizeConvertToBytes($filesize);

            $allowed_types = array("doc", "docx", "odt", "png", "gif", "jpeg", "jpg", 'csv', "pdf", "mp4", "webm", "ogg", "txt");

            $videoReview = isset($_FILES['file']) ? $_FILES['file'] : false;
            $mediaName = $videoReview['name'];
            $ext = pathinfo($videoReview['name'], PATHINFO_EXTENSION);

            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif') {
                $mediaType = 'images';
                $mediaTypeNew = 'image';
            } else if ($ext == 'doc' || $ext == 'docx' || $ext == 'odt' || $ext == 'csv' || $ext == 'pdf' || $ext == 'txt') {
                $mediaType = 'files';
                $mediaTypeNew = 'file';
            } else if ($ext == 'mp4' || $ext == 'ogg' || $ext == 'webm') {
                $mediaType = 'videos';
                $mediaTypeNew = 'video';
            }

            if ($videoReview !== false) {
                if (empty($error) && !in_array($ext, $allowed_types))
                    $error = "Invalid file format";

                if (empty($error) && (!isset($videoReview['size']) || $videoReview['size'] > ($filesizeInBytes)))
                    $error = "Maximum filesize limit is " . $filesize . "MB only.";

                if (empty($error)) {
                    // Put file to AWS S3
                    $videoReviewFile = "s3_" . rand(1, 10000) . "_" . sha1(time()) . "." . $ext;
                    $filekey = "campaigns/" . $videoReviewFile;
                    //$filekey = "chat_attachments/". $videoReviewFile;
                    $filename = $videoReview['name'];
                    $input = file_get_contents($videoReview['tmp_name']);
                    $s3 = \Storage::disk('s3');
                    $s3->put($filekey,$input, 'public');
                    //$path = $request->file('file')->store($filekey, 's3');
                }
            }

            echo $filekey . '||<input type="hidden" class="imageUrlS3" name="question_uploaded_name[media_url][]" value="' . $filekey . '"><input type="hidden" name="question_uploaded_name[media_type][]" value="' . $mediaTypeNew . '"><input type="hidden" name="question_uploaded_name[media_name][]" value="' . $mediaName . '">';
            exit;
        }
    }


    /**
     * This function used to upload images to the amazon s3 server
     * @param type $clientId
     * @param type $clientId
     * @return type
     */

    public function upload_s3_attachment(Request $request)
    {
        $clientId = $request->clientId;
        $folderName = $request->folderName;
        $userDetail = getUserDetailsByUserID($clientId);
        if ($userDetail->s3_allow_size > $userDetail->s3_used_size) {

            $videoReviewFile = '';
            $error = "";
            //This function get the maximum allowed filesize from the settings(in Megabytes)
            $filesize = getFileSize('filesize');
            //Upload multiple files
            if (!empty($_FILES)) {

                $allowed_types = array("doc", "docx", "odt", "png", "gif", "jpeg", "jpg", 'csv', "pdf", "mp4", "webm", "ogg", "txt");
                $error = "";
                //Convert maximum allowed filesize in bytes
                $filesizeInBytes = FileSizeConvertToBytes($filesize);

                //Check if Team member is logged in
                $isLoggedInTeam = Session::get('team_user_id');

                //Collect Text Review(Save Video into S3)
                if (!empty($_FILES['files'])) {
                    $videoReview = isset($_FILES['files']) ? $_FILES['files'] : false;
                    $ext = pathinfo($videoReview['name'][0], PATHINFO_EXTENSION);

                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif') {
                        $mediaType = 'images';
                    } else if ($ext == 'doc' || $ext == 'docx' || $ext == 'odt' || $ext == 'csv' || $ext == 'pdf' || $ext == 'txt') {
                        $mediaType = 'files';
                    } else if ($ext == 'mp4' || $ext == 'ogg' || $ext == 'webm') {
                        $mediaType = 'videos';
                    }

                    if ($videoReview !== false) {
                        if (empty($error) && !in_array($ext, $allowed_types))
                            $error = "Invalid file format";

                        if (empty($error) && (!isset($videoReview['size'][0]) || $videoReview['size'][0] > ($filesizeInBytes)))
                            $error = "Maximum filesize limit is " . $filesize . "MB only.";

                        if (empty($error)) {
                            // Put file to AWS S3
                            $videoReviewFile = "s3_" . rand(1, 10000) . "_" . sha1(time()) . "." . $ext;

                            if (!empty($isLoggedInTeam)) {
                                $filekey = $clientId . "/" . $isLoggedInTeam . "/" . $folderName . "/" . $mediaType . "/" . $videoReviewFile;
                            } else {
                                $filekey = $clientId . "/" . $folderName . "/" . $mediaType . "/" . $videoReviewFile;
                            }

                            $filename = $videoReview['name'][0];
                            $input = file_get_contents($videoReview['tmp_name'][0]);
                            $s3 = \Storage::disk('s3');
                            $s3->put($filekey,$input, 'public');
                            //$path = $request->file('files')->store($filekey, 's3');
                        }
                    }

                    $response = array('result' => $filekey, 'error' => $error);
                    echo json_encode($response);
                } //upload single file
                else if (!empty($_FILES['file'])) {
                    $videoReview = isset($_FILES['file']) ? $_FILES['file'] : false;
                    $ext = pathinfo($videoReview['name'], PATHINFO_EXTENSION);

                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif') {
                        $mediaType = 'images';
                    } else if ($ext == 'doc' || $ext == 'docx' || $ext == 'odt' || $ext == 'csv' || $ext == 'pdf' || $ext == 'txt') {
                        $mediaType = 'files';
                    } else if ($ext == 'mp4' || $ext == 'ogg' || $ext == 'webm') {
                        $mediaType = 'videos';
                    }

                    if ($videoReview !== false) {
                        if (empty($error) && !in_array($ext, $allowed_types))
                            $error = "Invalid file format";

                        if (empty($error) && (!isset($videoReview['size']) || $videoReview['size'] > ($filesizeInBytes)))
                            $error = "Maximum filesize limit is " . $filesize . "MB only.";

                        if (empty($error)) {
                            // Put file to AWS S3
                            $videoReviewFile = "s3_" . rand(1, 10000) . "_" . sha1(time()) . "." . $ext;
                            if (!empty($isLoggedInTeam)) {
                                $filekey = $clientId . "/" . $isLoggedInTeam . "/" . $folderName . "/" . $mediaType . "/" . $videoReviewFile;
                            } else {
                                $filekey = $clientId . "/" . $folderName . "/" . $mediaType . "/" . $videoReviewFile;
                            }
                            $filename = $videoReview['name'];
                            $input = file_get_contents($videoReview['tmp_name']);
                            //$this->s3->putObject($input, AWS_BUCKET, $filekey);
                            $s3 = \Storage::disk('s3');
                            $s3->put($filekey, $input, 'public');
                            //$path = $request->file('file')->store($filekey, 's3');
                        }
                    }
                    echo $filekey;
                }
            }
        }
        exit;
    }


    /**
     * This function used to upload images to the amazon s3 server for review
     * @param Request $request
     * @return void
     */
    public function upload_s3_attachment_review(Request $request)
    {
        $clientId = $request->clientId;
        $folderName = $request->folderName;

        $userDetail = getUserDetailsByUserID($clientId);
        if ($userDetail->s3_allow_size > $userDetail->s3_used_size) {

            $videoReviewFile = '';
            $error = "";
            $filesize = getFileSize('filesize');

            if (!empty($_FILES)) {

                $allowed_types = array("doc", "docx", "odt", "png", "gif", "jpeg", "jpg", 'csv', "pdf", "mp4", "webm", "ogg", "txt");
                $error = "";
                $filesizeInBytes = FileSizeConvertToBytes($filesize);

                //Collect Text Review(Save Video into S3)
                if (!empty($_FILES['files'])) {
                    $videoReview = isset($_FILES['files']) ? $_FILES['files'] : false;
                    $mediaName = $videoReview['name'];
                    $ext = pathinfo($videoReview['name'][0], PATHINFO_EXTENSION);

                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif') {
                        $mediaType = 'images';
                        $mediaTypeNew = 'image';
                    } else if ($ext == 'doc' || $ext == 'docx' || $ext == 'odt' || $ext == 'csv' || $ext == 'pdf' || $ext == 'txt') {
                        $mediaType = 'files';
                        $mediaTypeNew = 'file';
                    } else if ($ext == 'mp4' || $ext == 'ogg' || $ext == 'webm') {
                        $mediaType = 'videos';
                        $mediaTypeNew = 'video';
                    }

                    if ($videoReview !== false) {
                        if (empty($error) && !in_array($ext, $allowed_types))
                            $error = "Invalid file format";

                        if (empty($error) && (!isset($videoReview['size'][0]) || $videoReview['size'][0] > ($filesizeInBytes)))
                            $error = "Maximum filesize limit is " . $filesize . "MB only.";

                        if (empty($error)) {
                            // Put file to AWS S3
                            $videoReviewFile = "s3_" . rand(1, 10000) . "_" . sha1(time()) . "." . $ext;
                            $filekey = $clientId . "/" . $folderName . "/" . $mediaType . "/" . $videoReviewFile;
                            //$filekey = "chat_attachments/". $videoReviewFile;
                            $filename = $videoReview['name'][0];
                            $input = file_get_contents($videoReview['tmp_name'][0]);
                            $s3 = \Storage::disk('s3');
                            $s3->put($filekey,$input, 'public');
                            //$path = $request->file('files')->store($filekey, 's3');
                        }
                    }

                    $response = array('result' => $filekey, 'error' => $error);
                    echo json_encode($response);
                } else if (!empty($_FILES['file'])) {
                    $videoReview = isset($_FILES['file']) ? $_FILES['file'] : false;
                    $mediaName = $videoReview['name'];
                    $ext = pathinfo($videoReview['name'], PATHINFO_EXTENSION);

                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif') {
                        $mediaType = 'images';
                        $mediaTypeNew = 'image';
                    } else if ($ext == 'doc' || $ext == 'docx' || $ext == 'odt' || $ext == 'csv' || $ext == 'pdf' || $ext == 'txt') {
                        $mediaType = 'files';
                        $mediaTypeNew = 'file';
                    } else if ($ext == 'mp4' || $ext == 'ogg' || $ext == 'webm') {
                        $mediaType = 'videos';
                        $mediaTypeNew = 'video';
                    }

                    if ($videoReview !== false) {
                        if (empty($error) && !in_array($ext, $allowed_types))
                            $error = "Invalid file format";

                        if (empty($error) && (!isset($videoReview['size']) || $videoReview['size'] > ($filesizeInBytes)))
                            $error = "Maximum filesize limit is " . $filesize . "MB only.";

                        if (empty($error)) {
                            // Put file to AWS S3
                            $videoReviewFile = "s3_" . rand(1, 10000) . "_" . sha1(time()) . "." . $ext;
                            $filekey = $clientId . "/" . $folderName . "/" . $mediaType . "/" . $videoReviewFile;
                            //$filekey = "chat_attachments/". $videoReviewFile;
                            $filename = $videoReview['name'];
                            $input = file_get_contents($videoReview['tmp_name']);
                            $s3 = \Storage::disk('s3');
                            $s3->put($filekey,$input, 'public');
                            //$path = $request->file('file')->store($filekey, 's3');
                        }
                    }


                }

                echo $filekey . '||<input type="hidden" class="imageUrlS3" name="site_uploaded_name[media_url][]" value="' . $filekey . '"><input type="hidden" name="site_uploaded_name[media_type][]" value="' . $mediaTypeNew . '"><input type="hidden" name="site_uploaded_name[media_name][]" value="' . $mediaName . '">';
                exit;

            }
        }
        exit;
    }


    /**
     * Used to upload product review attachments
     * @param Request $request
     */
    public function upload_s3_attachment_product_review(Request $request)
    {
        //$clientId, $folderName,$orderVal=""
        $clientId = $request->clientId;
        $folderName = $request->folderName;
        $orderVal = $request->orderVal;

        $userDetail = getUserDetailsByUserID($clientId);
        if ($userDetail->s3_allow_size > $userDetail->s3_used_size) {

            $videoReviewFile = '';
            $error = "";
            $filesize = getFileSize('filesize');
            if (!empty($_FILES)) {

                $allowed_types = array("doc", "docx", "odt", "png", "gif", "jpeg", "jpg", 'csv', "pdf", "mp4", "webm", "ogg", "txt");
                $error = "";
                $filesizeInBytes = FileSizeConvertToBytes($filesize);


                //Collect Text Review(Save Video into S3)
                if (!empty($_FILES['files'])) {
                    $videoReview = isset($_FILES['files']) ? $_FILES['files'] : false;
                    $mediaName = $videoReview['name'];
                    $ext = pathinfo($videoReview['name'][0], PATHINFO_EXTENSION);

                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif') {
                        $mediaType = 'images';
                        $mediaTypeNew = 'image';
                    } else if ($ext == 'doc' || $ext == 'docx' || $ext == 'odt' || $ext == 'csv' || $ext == 'pdf' || $ext == 'txt') {
                        $mediaType = 'files';
                        $mediaTypeNew = 'file';
                    } else if ($ext == 'mp4' || $ext == 'ogg' || $ext == 'webm') {
                        $mediaType = 'videos';
                        $mediaTypeNew = 'video';
                    }

                    if ($videoReview !== false) {
                        if (empty($error) && !in_array($ext, $allowed_types))
                            $error = "Invalid file format";

                        if (empty($error) && (!isset($videoReview['size'][0]) || $videoReview['size'][0] > ($filesizeInBytes)))
                            $error = "Maximum filesize limit is " . $filesize . "MB only.";

                        if (empty($error)) {
                            // Put file to AWS S3
                            $videoReviewFile = "s3_" . rand(1, 10000) . "_" . sha1(time()) . "." . $ext;
                            $filekey = $clientId . "/" . $folderName . "/" . $mediaType . "/" . $videoReviewFile;
                            //$this->s3->putObject($input, AWS_BUCKET, $filekey);
                            $filename = $videoReview['name'][0];
                            $input = file_get_contents($videoReview['tmp_name'][0]);
                            $s3 = \Storage::disk('s3');
                            $s3->put($filekey,$input, 'public');
                            //$path = $request->file('files')->store($filekey, 's3');
                        }
                    }

                    $response = array('result' => $filekey, 'error' => $error);
                    echo json_encode($response);
                } else if (!empty($_FILES['file'])) {
                    $videoReview = isset($_FILES['file']) ? $_FILES['file'] : false;
                    $mediaName = $videoReview['name'];
                    $ext = pathinfo($videoReview['name'], PATHINFO_EXTENSION);

                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif') {
                        $mediaType = 'images';
                        $mediaTypeNew = 'image';
                    } else if ($ext == 'doc' || $ext == 'docx' || $ext == 'odt' || $ext == 'csv' || $ext == 'pdf' || $ext == 'txt') {
                        $mediaType = 'files';
                        $mediaTypeNew = 'file';
                    } else if ($ext == 'mp4' || $ext == 'ogg' || $ext == 'webm') {
                        $mediaType = 'videos';
                        $mediaTypeNew = 'video';
                    }

                    if ($videoReview !== false) {
                        if (empty($error) && !in_array($ext, $allowed_types))
                            $error = "Invalid file format";

                        if (empty($error) && (!isset($videoReview['size']) || $videoReview['size'] > ($filesizeInBytes)))
                            $error = "Maximum filesize limit is " . $filesize . "MB only.";

                        if (empty($error)) {
                            // Put file to AWS S3
                            $videoReviewFile = "s3_" . rand(1, 10000) . "_" . sha1(time()) . "." . $ext;
                            $filekey = $clientId . "/" . $folderName . "/" . $mediaType . "/" . $videoReviewFile;
                            //$filekey = "chat_attachments/". $videoReviewFile;
                            //$this->s3->putObject($input, AWS_BUCKET, $filekey);

                            $filename = $videoReview['name'];
                            $input = file_get_contents($videoReview['tmp_name']);
                            $s3 = \Storage::disk('s3');
                            $s3->put($filekey,$input, 'public');

                            //$path = $request->file('file')->store($filekey, 's3');
                        }
                    }


                }

                if (!empty($orderVal)) {
                    echo $filekey . '||<input type="hidden" name="uploaded_name_' . $orderVal . '[media_url][]" value="' . $filekey . '"><input type="hidden" name="uploaded_name_' . $orderVal . '[media_type][]" value="' . $mediaTypeNew . '"><input type="hidden" name="uploaded_name_' . $orderVal . '[media_name][]" value="' . $mediaName . '">';
                } else {
                    echo $filekey . '||<input type="hidden" name="uploaded_name[media_url][]" value="' . $filekey . '"><input type="hidden" name="uploaded_name[media_type][]" value="' . $mediaTypeNew . '"><input type="hidden" name="uploaded_name[media_name][]" value="' . $mediaName . '">';
                }

                exit;

            }

        }
        exit;
    }

    /**
     * Upload S3 attachments for questions in reviews
     * @param Request $request
     */
    public function upload_s3_attachment_question_review(Request $request)
    {
        //$clientId, $folderName,$orderVal=""
        $clientId = $request->clientId;
        $folderName = $request->folderName;
        $orderVal = $request->orderVal;

        $userDetail = getUserDetailsByUserID($clientId);
        if ($userDetail->s3_allow_size > $userDetail->s3_used_size) {

            $videoReviewFile = '';
            $error = "";
            $filesize = getFileSize('filesize');
            if (!empty($_FILES)) {

                $allowed_types = array("doc", "docx", "odt", "png", "gif", "jpeg", "jpg", 'csv', "pdf", "mp4", "webm", "ogg", "txt");
                $error = "";
                $filesizeInBytes = FileSizeConvertToBytes($filesize);


                //Collect Text Review(Save Video into S3)
                if (!empty($_FILES['files'])) {
                    $videoReview = isset($_FILES['files']) ? $_FILES['files'] : false;
                    $mediaName = $videoReview['name'];
                    $ext = pathinfo($videoReview['name'][0], PATHINFO_EXTENSION);

                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif') {
                        $mediaType = 'images';
                        $mediaTypeNew = 'image';
                    } else if ($ext == 'doc' || $ext == 'docx' || $ext == 'odt' || $ext == 'csv' || $ext == 'pdf' || $ext == 'txt') {
                        $mediaType = 'files';
                        $mediaTypeNew = 'file';
                    } else if ($ext == 'mp4' || $ext == 'ogg' || $ext == 'webm') {
                        $mediaType = 'videos';
                        $mediaTypeNew = 'video';
                    }

                    if ($videoReview !== false) {
                        if (empty($error) && !in_array($ext, $allowed_types))
                            $error = "Invalid file format";

                        if (empty($error) && (!isset($videoReview['size'][0]) || $videoReview['size'][0] > ($filesizeInBytes)))
                            $error = "Maximum filesize limit is " . $filesize . "MB only.";

                        if (empty($error)) {
                            // Put file to AWS S3
                            $videoReviewFile = "s3_" . rand(1, 10000) . "_" . sha1(time()) . "." . $ext;
                            $filekey = $clientId . "/" . $folderName . "/" . $mediaType . "/" . $videoReviewFile;
                            //$filekey = "chat_attachments/". $videoReviewFile;
                            //$this->s3->putObject($input, AWS_BUCKET, $filekey);
                            $filename = $videoReview['name'][0];
                            $input = file_get_contents($videoReview['tmp_name'][0]);
                            $s3 = \Storage::disk('s3');
                            $s3->put($filekey,$input, 'public');
                            //$path = $request->file('files')->store($filekey, 's3');
                        }
                    }

                    $response = array('result' => $filekey, 'error' => $error);
                    echo json_encode($response);
                } else if (!empty($_FILES['file'])) {
                    $videoReview = isset($_FILES['file']) ? $_FILES['file'] : false;
                    $mediaName = $videoReview['name'];
                    $ext = pathinfo($videoReview['name'], PATHINFO_EXTENSION);

                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif') {
                        $mediaType = 'images';
                        $mediaTypeNew = 'image';
                    } else if ($ext == 'doc' || $ext == 'docx' || $ext == 'odt' || $ext == 'csv' || $ext == 'pdf' || $ext == 'txt') {
                        $mediaType = 'files';
                        $mediaTypeNew = 'file';
                    } else if ($ext == 'mp4' || $ext == 'ogg' || $ext == 'webm') {
                        $mediaType = 'videos';
                        $mediaTypeNew = 'video';
                    }

                    if ($videoReview !== false) {
                        if (empty($error) && !in_array($ext, $allowed_types))
                            $error = "Invalid file format";

                        if (empty($error) && (!isset($videoReview['size']) || $videoReview['size'] > ($filesizeInBytes)))
                            $error = "Maximum filesize limit is " . $filesize . "MB only.";

                        if (empty($error)) {
                            // Put file to AWS S3
                            $videoReviewFile = "s3_" . rand(1, 10000) . "_" . sha1(time()) . "." . $ext;
                            $filekey = $clientId . "/" . $folderName . "/" . $mediaType . "/" . $videoReviewFile;
                            //$filekey = "chat_attachments/". $videoReviewFile;
                            //$this->s3->putObject($input, AWS_BUCKET, $filekey);
                            $filename = $videoReview['name'];
                            $input = file_get_contents($videoReview['tmp_name']);
                            $s3 = \Storage::disk('s3');
                            $s3->put($filekey,$input, 'public');
                            //$path = $request->file('file')->store($filekey, 's3');
                        }
                    }


                }

                if (!empty($orderVal)) {
                    echo $filekey . '||<input type="hidden" name="question_uploaded_name' . $orderVal . '[media_url][]" value="' . $filekey . '"><input type="hidden" name="question_uploaded_name' . $orderVal . '[media_type][]" value="' . $mediaTypeNew . '"><input type="hidden" name="question_uploaded_name' . $orderVal . '[media_name][]" value="' . $mediaName . '">';
                } else {
                    echo $filekey . '||<input type="hidden" name="question_uploaded_name[media_url][]" value="' . $filekey . '"><input type="hidden" name="question_uploaded_name[media_type][]" value="' . $mediaTypeNew . '"><input type="hidden" name="question_uploaded_name[media_name][]" value="' . $mediaName . '">';
                }

                exit;

            }

        }
        exit;
    }
}

?>

