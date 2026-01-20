<?php
class NotificationsController extends Controller {
  public function index(){ $this->requireAuth();  $this->view('notifications/notifications', ['pageCss'=>'notifications.css','pageJs'=>'notifications.js']); }

  public function listJson(){ $this->requireAuth();  $items = $this->model('NotificationModel')->all(); $this->json($items); }
  public function createJson(){
    $this->requireAuth();
    $csrf = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? ($_POST['csrf_token'] ?? '');
    if (!csrf_verify($csrf)) { $this->json(['ok'=>false,'error'=>'Invalid CSRF token'], 403); }

    $payload = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    // PHP validation
    if (empty($payload['title'])) { $this->json(['ok'=>false,'error'=>'Title is required'], 422); }
    if (empty($payload['message'])) { $this->json(['ok'=>false,'error'=>'Message is required'], 422); }

    $id = $this->model('NotificationModel')->create($payload);
    $this->json(['ok'=>true,'id'=>$id], 201);
  }
}
