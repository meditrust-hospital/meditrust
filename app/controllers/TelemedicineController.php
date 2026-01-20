<?php
class TelemedicineController extends Controller {
  public function index(){ $this->requireAuth();  $this->view('telemedicine/telemedicine', ['pageCss'=>'telemedicine.css','pageJs'=>'telemedicine.js']); }

  public function listJson(){ $this->requireAuth();  $items = $this->model('TelemedicineModel')->all(); $this->json($items); }
  public function createJson(){
    $this->requireAuth();
    $csrf = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? ($_POST['csrf_token'] ?? '');
    if (!csrf_verify($csrf)) { $this->json(['ok'=>false,'error'=>'Invalid CSRF token'], 403); }

    $payload = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    // PHP validation
    if (empty($payload['patient_name'])) { $this->json(['ok'=>false,'error'=>'Patient name is required'], 422); }
    if (empty($payload['doctor_name'])) { $this->json(['ok'=>false,'error'=>'Doctor name is required'], 422); }
    if (empty($payload['consult_type'])) { $this->json(['ok'=>false,'error'=>'Consult type is required'], 422); }
    if (empty($payload['datetime'])) { $this->json(['ok'=>false,'error'=>'Date & time is required'], 422); }

    $id = $this->model('TelemedicineModel')->create($payload);
    $this->json(['ok'=>true,'id'=>$id], 201);
  }
}
