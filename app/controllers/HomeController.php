<?php
class HomeController extends Controller {
  public function index(){ $this->requireAuth(); 
    $this->view('home/home', []);
  }
}
