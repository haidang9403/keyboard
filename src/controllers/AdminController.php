<?php
namespace Controller;

use Model\UserModel as User;
use Model\ProductModel as Product;
use Model\OrderModel as Order;
use Model\OrderDetailsModel as OrderDetail;
use App\Session;

class AdminController extends BaseController {
    private $user;
    public $currentUser;
    public $type;
    public $model;

    public function __construct(){
        $this->user = new User;
        if(Session::isUserLoggedIn()){
            $this->currentUser = $this->user->findUserById($_SESSION['user_id']);
            if($this->currentUser['role'] != 'admin'){
                header("HTTP/1.1 403 Forbidden");
                exit();
            }
        } else {
            header("HTTP/1.1 403 Forbidden");
            exit();
        }

        $this->type = $_GET["type"] ?? 'profile';
        if($this->type == 'profile'){
            $modelClass = "Model\UserModel";
        }else{
            $modelClass = "Model\\".ucfirst($this->type) . "Model";
        }
        
        if(class_exists( $modelClass )) {
            $this->model = new $modelClass;
        }else{
            NOT_FOUND();
        }
    }

    public function index() {
        $allData = [];
        $data = [];
        $limit = 1;

        switch($this->type){
            case 'user':
                $pageTitle = "Quản lý người dùng";
                $allData = $this->model->get(["role" => " = :role "],["role" => "user"]);
                $limit = 7;
                break;
            case 'product':
                $pageTitle = "Quản lý sản phẩm";
                $allData = $this->model->getAll();
                $limit = 10;
                break;
            case 'order':
                $pageTitle = 'Quản lý đơn hàng';
                $allData = $this->model->getAllOrdering(["status" => " = :status "],["status" => 1],["orders.*","users.username"]);
                $limit = 10;
                break;
            default:
                $pageTitle = "Quản lý";
                break;
        }

        $total_data = count($allData);
        $current_page = 1;
        $total_page = ceil( $total_data/$limit);
        $offset = ($current_page - 1)*$limit;

        $page_array = pagination($total_page, $current_page);

        if($this->type == 'user'){
            $data = $this->model->get(["role" => " = :role "],["role" => "user"],["*"],$limit, $offset);
        } elseif($this->type == 'product') {
            $data = $this->model->get([],[],["*"],$limit, $offset);
        } elseif($this->type == 'order'){
            $data = $this->model->getAllOrdering(["status" => " = :status "],["status" => 1],["orders.*","users.username"],$limit, $offset);
        }


        return $this->view("admin.index",[
            "infoUser" => $this->currentUser,
            "type" => $this->type,
            "pageTitle" => $pageTitle,
            "page_array" => $page_array,
            "data" => $data,
            "current_page" => 1,
            'errors' => session_get_once('errors')
        ]);
    }

    public function paginate(){
        $page = $_POST['page'] ?? 1;
        
        if($this->type == 'user'){
            $allData = $this->model->get(["role" => " = :role "],["role" => "user"]);
            $limit = 16;
        } elseif( $this->type == 'product') {
            $allData = $this->model->getAll();
            $limit = 10;
        } elseif($this->type == 'order'){
            $data = $this->model->getAllOrdering(["status" => " = :status "],["status" => 1],["orders.*","users.username"],$limit, $offset);
            $limit = 16;
        }

        $total_data = count($allData);
        $current_page = $page;
        $total_page = ceil( $total_data/$limit);
        $offset = ($current_page - 1)*$limit;

        $page_array = pagination($total_page, $current_page);

        if($this->type == 'user'){
            $data = $this->model->get(["role" => " = :role "],["role" => "user"],["*"],$limit, $offset);
        } else {
            $data = $this->model->get([],[],["*"],$limit, $offset);
        }

        echo view("admin.product",[
            "array_data" => $data,
            "page_array" => $page_array,
            "current_page" => $current_page,
            "type" => strval($this->type)
        ]);
    }

    public function delete(){
        $id = $_POST['id'] ?? null;

        $cdtRemove = [
            'id' => " = :id "
        ];

        $valueCdtRemove = [
            'id' => $id
        ];

        
        switch($this->type){
            case 'user':
                break;
                case 'product':
                    // xóa product trong giỏ hàng của user
                $orderDetail = new OrderDetail;
                $orderDetail->remove(['product_id' => " = :product_id "],['product_id' => $id]);
                    
                // xóa product
                $data = $this->model->getById($id);
                $this->model->remove($cdtRemove,  $valueCdtRemove);
                // Xóa ảnh
                $targetDir = realpath(__DIR__ . "/../../public/images/uploads/");
                $targetFile = $targetDir . '/' . basename($data['thumbnail']);
                unlink($targetFile);
                break;
        }
    }

    public function edit(){
        $data = $this->filterData($_POST);
        
        if(!isset($_POST['id'])){
            NOT_FOUND();
        } else {
            $data['id'] = $_POST['id'];
        }

        $data['thumbnail_old'] = $_POST['thumbnail_old'] ?? null;
        $data['thumbnail_file'] = $_FILES['thumbnail'] ?? null;

        if($data['thumbnail_file']['error'] > 0){ // Nếu không cập nhật file mới
            unset($data['thumbnail_file']);
        };

        $model_errors = $this->model->validate($data);
        
        if(empty($model_errors)){ // Không có lỗi
            $this->update($data);
        }
        
        // Nếu có lỗi
        $id = $data['id'];
        redirect("/admin?type=$this->type&action=editView&id=$id", [
            'errors' => $model_errors
        ]);
    }

    public function add(){
        
        $data = $this->filterData($_POST);
        
        $data['thumbnail_file'] = $_FILES['thumbnail'] ?? null;
        
        $model_errors = $this->model->validate($data);
        
        if(empty($model_errors)){ // Không có lỗi
            $this->create($data);
        }
        
        // Nếu có lỗi
        // Lưu dữ liệu vào session nếu bị lỗi
        $this->saveFormValues($_POST);
        redirect("/admin?type=$this->type&action=addView", [
            'errors' => $model_errors
        ]);
        
    }

    protected function create($data){
        switch($this->type){
            case "product":
                $thumbnail = './images/uploads/' . $data['thumbnail_file']['name'];
                $data["thumbnail"] = $thumbnail;
                $targetFile = session_get_once('targetFile');
                
                if (move_uploaded_file($data["thumbnail_file"]["tmp_name"], $targetFile)) {
                    unset($data["thumbnail_file"]); 
                    $this->model->store($data);
                    redirect("/admin?type=$this->type");
                } else {
                    $errors['thumbnail'] = "Có lỗi trong quá trình tải file";
                    redirect("/admin?type=$this->type&action=addView", ['errors' => $model_errors]);
                }
                break;
        }
        
    }

    protected function update($data){
        switch($this->type){
            case "product":
                $id = $data['id'];
                
                
                if(isset($data['thumbnail_file'])){
                    $thumbnailNew = './images/uploads/' . $data['thumbnail_file']['name'];
                    $data["thumbnail"] = $thumbnailNew;
                    $targetFile = session_get_once('targetFile');

                    if (move_uploaded_file($data["thumbnail_file"]["tmp_name"], $targetFile)) {
                        
                        // Xóa ảnh cũ
                        $targetDirOld = realpath(__DIR__ . "/../../public/images/uploads/");
                        $targetFileOld = $targetDirOld . '/' . basename($data['thumbnail_old']);
                        
                        if (unlink($targetFileOld)) {
                            unset($data["thumbnail_old"]);
                            unset($data["thumbnail_file"]);
                            $this->model->set($data,["id" => "= :id"], ["id" => $data['id']]);
                            redirect("/admin?type=$this->type");
                        } else {
                            $errors['thumbnail'] = "Có lỗi trong quá trình cập nhật ảnh";
                            redirect("/admin?type=$this->type&action=editView&id=$id", ['errors' => $model_errors]);
                        }
                    } else {
                        $errors['thumbnail'] = "Có lỗi trong quá trình tải file";
        
                        redirect("/admin?type=$this->type&action=editView&id=$id", ['errors' => $model_errors]);
        
                    }
                } else {
                    $this->model->set($data,["id" => "= :id"], ["id" => $data['id']]);
                    redirect("/admin?type=$this->type");
                }
                
                break;
        }
    }

    protected function filterData(array $data){
        return match($this->type){
            "product" => [
                'title' => $data['title'] ?? null,
                'category' => $data['category'] ?? null,
                'price' => intval($data['price']) ?? null,
                'quantity' => intval($data['quantity']) ?? null,
                'layout'=> $data['layout'] ?? null,
                'switch' => empty($data['switch']) ? "Chưa cập nhật" : $data['switch'],
                'connect' => $data['connect'] ?? null,
                'led' => empty($data['led']) ? "Không có" : $data['led']
            ],
            default => []
        };
    }

    public function addView(){
        //$dirname = $_POST['dirname'] ?? null;
        $dirname = ($_GET['type'] ?? 'user') . '-action';

        // Nhận lỗi tại đây

        return view("admin.$dirname.index",[
            'action' => 'add',
            'type' => $this->type,
            'pageTitle' => 'Thêm sản phẩm',
            "infoUser" => $this->currentUser,
            'old' => $this->getSavedFormValues(),
            'errors' => session_get_once('errors')
        ]);
    }

    public function editView(){
         //$dirname = $_POST['dirname'] ?? null;
        $dirname = ($_GET['type'] ?? 'user') . '-action';
        $id = $_GET['id'] ?? null;

        if(empty($id) && isset($id)){
            NOT_FOUND();
        }

        $data = $this->model->getById($id);
        if(empty($data)){
            NOT_FOUND();
        }
        

        return view("admin.$dirname.index",[
            'action' => 'edit',
            'type' => $this->type,
            'pageTitle' => 'Chỉnh sửa sản phẩm',
            "infoUser" => $this->currentUser,
            'data' => $data,
            'errors' => session_get_once('errors')
        ]);
    }

        public function editProfile(){
        if($this->type == 'profile'){
            $data = $this->filterProfileData($_POST);
        }

        $model_errors = $this->model->validateInfo($data);
        if(empty($model_errors)){ // Thành công
            $this->updateProfile($data);
        }

        redirect("/admin?type=$this->type", ['errors' => $model_errors]);
    }

    protected function filterProfileData($data){
        return [
            'fullname' => $data['fullname'] ?? null,
            'email' => $data['email'] ?? null
        ];
    }

    protected function updateProfile(array $data){
        $this->model->set($data,['id' => ' = :id '], ['id' => $this->currentUser['id']]);
        redirect("/admin?type=$this->type");
    }
}