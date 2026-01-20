<?php
class FeedbackController extends Controller {
  public function index(){ $this->requireAuth();  $this->view('feedback/feedback', ['pageCss'=>'feedback.css','pageJs'=>'feedback.js']); }

  public function listJson(){ $this->requireAuth();  $items = $this->model('FeedbackModel')->all(); $this->json($items); }
  public function createJson(){
    $this->requireAuth();
    $csrf = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? ($_POST['csrf_token'] ?? '');
    if (!csrf_verify($csrf)) { $this->json(['ok'=>false,'error'=>'Invalid CSRF token'], 403); }

    $payload = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    // PHP validation
    if (empty($payload['patient_name'])) { $this->json(['ok'=>false,'error'=>'Patient name is required'], 422); }
    if (empty($payload['category'])) { $this->json(['ok'=>false,'error'=>'Category is required'], 422); }
    if (empty($payload['message'])) { $this->json(['ok'=>false,'error'=>'Message is required'], 422); }

    $id = $this->model('FeedbackModel')->create($payload);
    $this->json(['ok'=>true,'id'=>$id], 201);
  }
}
