<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin\OffsiteModel;
use Cookie;
use Session;

class Offsite extends Controller
{

    /**
     * Used to get websites
     */
    public function websites()
    {

        //Create instance of OffsiteModel to get its method and properties
        $mOffsite = new OffsiteModel();

        $offstepdata = $mOffsite->getAllOffsite();

        $breadcrumb = '<ul class="breadcrumb">
                    <li><a href="' . base_url('admin/') . '"><i class="icon-home2 position-left"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                    <li class="active">OffSite Brandboost Websites</li>
                </ul>';

        return view('admin.offsite.website.list', ['title' => 'Offsite Brandboost Websites', 'pagename' => $breadcrumb, 'aData' => $offstepdata]);
    }

    /**
     * Convert Image format
     * @param $base64_string
     * @param $output_file
     * @return mixed
     */
    public function base64_to_jpeg($base64_string, $output_file)
    {

        $data = explode(',', $base64_string);
        $path = "./uploads/" . $output_file;
        file_put_contents($path, base64_decode($data[1]));
        return $output_file;
    }


    /**
     * Converting profile image format
     * @param $base64_string
     * @param $output_file
     * @return mixed
     */
    public function base64_to_jpeg_profile($base64_string, $output_file)
    {

        $data = explode(',', $base64_string);
        $path = "./profile_images/" . $output_file;
        file_put_contents($path, base64_decode($data[1]));
        return $output_file;
    }


    /**
     * Used to upload image
     */
    public function add_image(Request $request)
    {

        $response = array();
        if (!empty($request)) {
            $imageName = $request->imageName;
            $fileName = $this->base64_to_jpeg($imageName, 'cropimage' . time() . '.jpg');
            $response['status'] = 'success';
            $response['filename'] = $fileName;
        } else {
            $response['status'] = 'error';
            $response['filename'] = '';
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to upload profile image
     */
    public function add_image_profile(Request $request)
    {

        $response = array();
        if (!empty($request)) {
            $imageName = $request->imageName;
            $fileName = $this->base64_to_jpeg_profile($imageName, 'cropimage' . time() . '.jpg');
            $response['status'] = 'success';
            $response['filename'] = $fileName;
        } else {
            $response['status'] = 'error';
            $response['filename'] = '';
        }

        echo json_encode($response);
        exit;
    }


    /**
     * Used to add Website source
     * @param Request $request
     */
    public function add_website(Request $request)
    {
        //Create instance of OffsiteModel to get its method and properties
        $mOffsite = new OffsiteModel();
        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;

        /*$config['upload_path'] = "./uploads";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);*/

        if (!empty($request)) {

            $offsitename = $request->offsitename;
            $websiteURL = $request->txtURL;
            $description = $request->description;
            //$file_name = strip_tags($request->cropFileName']);
            $siteCategories = serialize($request->siteCategories);
            $brandboostID = $request->brandboostID;

            if (!empty($request->offsiteimage)) {
                $path = $request->offsiteimage->store('uploads');

                $file_name = $request->offsiteimage->hashName();

                $aData = array(
                    'name' => $offsitename,
                    'description' => ($description) ? $description : 'description goes here',
                    'website_url' => $websiteURL,
                    'site_categories' => $siteCategories,
                    'image' => $file_name,
                    'user_id' => $userID,
                    'created' => date("Y-m-d H:i:s")
                );

            } else {
                $aData = array(
                    'name' => $offsitename,
                    'description' => ($description) ? $description : 'description goes here',
                    'website_url' => $websiteURL,
                    'site_categories' => $siteCategories,
                    'user_id' => $userID,
                    'created' => date("Y-m-d H:i:s")
                );
            }


            $result = $mOffsite->addOffsite($aData);
            if ($result) {
                $response['status'] = 'success';
                $response['brandboostID'] = $brandboostID;
                $response['id'] = $result;
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        } else {
            return view('admin.offsite.add_offlist');
        }

    }

    /**
     * Used to delete custom source
     */
    public function delete_customsource(Request $request)
    {
        //Create instance of OffsiteModel to get its method and properties
        $mOffsite = new OffsiteModel();


        $CustomSourceID = $request->CustomSourceID;

        $response = array();
        $aUser = getLoggedUser();
        $userID = $aUser->id;
        if (!empty($CustomSourceID)) {

            $aData = array(
                'CustomSourceID' => $CustomSourceID,
                'user_id' => $userID
            );


            $result = $mOffsite->DelCustomSource($aData);
            if ($result) {
                $response['status'] = 'success';
                $response['id'] = $result;
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        } else {
            $response['status'] = "Error";
        }

    }

    /**
     * Used to add offsite list
     */
    public function add_offlist(Request $request)
    {
        //Create instance of OffsiteModel to get its method and properties
        $mOffsite = new OffsiteModel();
        $response = array();

        if (!empty($request)) {
            $offsitename = $request->offsitename;
            $description = $request->description;
            $userID = $this->session->userdata("current_user_id");

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 1000;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

            $this->load->library('upload', $config);
            $file_name = '';
            if (!empty($_FILES)) {

                if (!$this->upload->do_upload('offsiteimage')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $file_name = $data['upload_data']['file_name'];
                }
            }

            if (!empty($file_name)) {

                $aData = array(
                    'name' => $offsitename,
                    'description' => $description,
                    'image' => $file_name,
                    'user_id' => $userID,
                    'created' => date("Y-m-d H:i:s")
                );
            } else {

                $aData = array(
                    'name' => $offsitename,
                    'description' => $description,
                    'user_id' => $userID,
                    'created' => date("Y-m-d H:i:s")
                );
            }

            $result = $mOffsite->addOffsite($aData);
            if ($result) {
                $response['status'] = 'success';
                $response['id'] = $result;
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        } else {
            $this->template->load('admin/admin_template', 'admin/offsite/add_offlist');
        }
    }

    /**
     * Used to get the list of websites
     */
    public function get_website(Request $request)
    {
        //Create instance of OffsiteModel to get its method and properties
        $mOffsite = new OffsiteModel();
        $response = array();
        $response['status'] = 'error';
        $post = array();
        if (!empty($request)) {
            $aOffsite = $mOffsite->getOffsite($request->offsiteID);
            if ($aOffsite) {
                $response['status'] = 'success';
                $response['result'] = $aOffsite;
                $response['result']['siteCategories'] = unserialize($aOffsite[0]->site_categories);
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }


    /**
     * Used to update websites
     */
    public function update_website(Request $request)
    {
        //Create instance of OffsiteModel to get its method and properties
        $mOffsite = new OffsiteModel();
        $response = array();
        $config['upload_path'] = "./uploads";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);

        if (!empty($request)) {

            $offsitename = $request->offsitename;
            $websiteURL = $request->websiteurl;
            $description = $request->description;
            $siteCategories = serialize($request->edit_siteCategories);
            $offsiteId = $request->edit_offsiteid;
            $userID = $this->session->userdata("current_user_id");
            //$file_name = strip_tags($request->cropFileName']);

            if ($this->upload->do_upload("offsiteimage")) {

                $data = array('upload_data' => $this->upload->data());
                $file_name = $data['upload_data']['file_name'];

                $aData = array(
                    'name' => $offsitename,
                    'website_url' => $websiteURL,
                    'description' => $description,
                    'site_categories' => $siteCategories,
                    'image' => $file_name,
                    'user_id' => $userID,
                    'created' => date("Y-m-d H:i:s")
                );
            } else {

                $aData = array(
                    'name' => $offsitename,
                    'website_url' => $websiteURL,
                    'description' => $description,
                    'site_categories' => $siteCategories,
                    'user_id' => $userID,
                    'created' => date("Y-m-d H:i:s")
                );
            }


            /*if (!empty($file_name)) {

                $aData = array(
                    'name' => $offsitename,
                    'website_url' => $websiteURL,
                    'description' => $description,
					'site_categories' => $siteCategories,
                    'image' => $file_name,
                    'user_id' => $userID,
                    'created' => date("Y-m-d H:i:s")
                );
            } else {

                $aData = array(
                    'name' => $offsitename,
                    'website_url' => $websiteURL,
                    'description' => $description,
					'site_categories' => $siteCategories,
                    'user_id' => $userID,
                    'created' => date("Y-m-d H:i:s")
                );
            }*/

            $result = $mOffsite->updateOffsite($aData, $offsiteId);
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }
            echo json_encode($response);
            exit;
        }
    }

    /**
     * Used to delete website
     */
    public function delete_website(Request $request)
    {
        //Create instance of OffsiteModel to get its method and properties
        $mOffsite = new OffsiteModel();

        $response = array();

        if (!empty($request)) {

            $offsiteId = $request->offsiteId;

            $result = $mOffsite->deleteOffsite($offsiteId);
            if ($result) {
                $response['status'] = 'success';
            } else {
                $response['status'] = "Error";
            }

            echo json_encode($response);
            exit;
        }
    }


    /**
     * Used to crop images
     */
    public function cropImage()
    {

        $this->load->view('cropimage');
    }

}
