<?php

class SystemController extends Controller {
  //----------------------------------------------------
  // 管理者用メニュー
  //----------------------------------------------------
  public function run() {
    // セッション開始　認証に利用します。
    $this->auth = new Auth();
    $this->auth->set_authname(_SYSTEM_AUTHINFO);
    $this->auth->set_sessname(_SYSTEM_SESSNAME);
    $this->auth->start();

    /*if (!$this->auth->check() && $this->type != 'authenticate'){
    // 未認証
    $this->type = 'login';
  }*/

  // 共用のテンプレートなどをこのフラグで管理用に切り替えます。
  $this->is_system = true;

  // 会員側の画面を表示するためMemberControllerを利用します。
  $MainController = new MainController($this->is_system);

  switch ($this->type) {
    case "login":
    $this->screen_login();
    break;
    case "logout":
    $this->auth->logout();
    $this->screen_login();
    break;

    case "smartphonelist":
    $this->screen_smartphone();
    break;
    case "smartphoneregist":
    $this->smartphone_regist();
    break;
    case "smartphonemodify":
    $this->smartphone_modify();
    break;

    case "memberlist":
    $this->screen_list();
    break;
    case "memberregist":
    $MainController->member_regist();
    break;
    case "memberdelete":
    $MainController->member_delete();
    break;
    default:
    $this->screen_top();
  }
}

//----------------------------------------------------
// ログイン画面表示
//----------------------------------------------------
private function screen_login(){
  $this->form->addElement('text', 'username',     ['size' => 15, 'maxlength' => 50], [ 'label' => 'ユーザ名']);
  $this->form->addElement('password', 'password', ['size' => 15, 'maxlength' => 50], [ 'label' => 'パスワード']);
  $this->form->addElement('submit', 'submit', ['value' =>'ログイン']);
  $this->next_type = 'authenticate';
  $this->title = 'ログイン画面';
  $this->file = "system_login.tpl";
  $this->view_display();
}

public function do_authenticate(){
  // データベースを操作します。
  $SystemModel = new SystemModel();
  $userdata = $SystemModel->get_authinfo($_POST['username']);
  if(!empty($userdata['password']) && $this->auth->check_password($_POST['password'], $userdata['password'])){
    $this->auth->auth_ok($userdata);
    $this->screen_top();
  } else {
    $this->auth_error_mess = $this->auth->auth_no();
    $this->screen_login();
  }
}

//----------------------------------------------------
// トップ画面
//----------------------------------------------------
private function screen_top(){
  unset($_SESSION['search_key']);
  unset($_SESSION[_MEMBER_AUTHINFO]);
  unset($_SESSION['pageID']);
  $this->title = '管理 - トップ画面';
  $this->file = 'system_top.tpl';
  $this->view_display();
}

//----------------------------------------------------
// メンバーの一覧画面
//----------------------------------------------------
private function screen_list(){
  $disp_search_key = "";
  $sql_search_key = "";
  // セッション変数の処理
  unset($_SESSION[_MEMBER_AUTHINFO]);
  if(isset($_POST['search_key']) && $_POST['search_key'] != ""){
    unset($_SESSION['pageID']);
    $_SESSION['search_key'] = $_POST['search_key'];
    $disp_search_key = htmlspecialchars($_POST['search_key'], ENT_QUOTES);
    $sql_search_key = $_POST['search_key'];
  }else{
    if(isset($_POST['submit']) && $_POST['submit'] == "検索する"){
      unset($_SESSION['search_key']);
    }else{
      if(isset($_SESSION['search_key'])){
        $disp_search_key = htmlspecialchars($_SESSION['search_key'], ENT_QUOTES);
        $sql_search_key = $_SESSION['search_key'];
      }
    }
  }
  // データベースを操作します。
  $MemberModel = new MemberModel();
  list($data, $count) = $MemberModel->get_member_list($sql_search_key);
  list($data, $links) = $this->make_page_link($data);

  $this->view->assign('count', $count);
  $this->view->assign('data', $data);
  $this->view->assign('search_key', $disp_search_key);
  $this->view->assign('links', $links['all']);
  $this->title = '管理 - 研究室メンバー画面';
  $this->file = 'system_list.tpl';
  $this->view_display();
}

private function screen_smartphone(){
  $disp_search_key = "";
  $sql_search_key = "";
  // セッション変数の処理
  unset($_SESSION[_MEMBER_AUTHINFO]);
  if(isset($_POST['search_key']) && $_POST['search_key'] != ""){
    unset($_SESSION['pageID']);
    $_SESSION['search_key'] = $_POST['search_key'];
    $disp_search_key = htmlspecialchars($_POST['search_key'], ENT_QUOTES);
    $sql_search_key = $_POST['search_key'];
  }else{
    if(isset($_POST['submit']) && $_POST['submit'] == "検索する"){
      unset($_SESSION['search_key']);
    }else{
      if(isset($_SESSION['search_key'])){
        $disp_search_key = htmlspecialchars($_SESSION['search_key'], ENT_QUOTES);
        $sql_search_key = $_SESSION['search_key'];
      }
    }
  }
  // データベースを操作します。
  $MainModel = new MainModel();
  list($data, $count) = $MainModel->get_smartphone_list($sql_search_key);
  list($data, $links) = $this->make_page_link($data);

  $this->view->assign('count', $count);
  $this->view->assign('data', $data);
  $this->view->assign('search_key', $disp_search_key);
  $this->view->assign('links', $links['all']);
  $this->title = '管理 - 研究室メンバー画面';
  $this->file = 'system_smartphone.tpl';
  $this->view_display();
}

public function smartphone_regist(){

  $btn = "";
  $btn2 = "";
  $this->file = "smartphoneinfo_form.tpl"; // デフォルト

  // フォーム要素のデフォルト値を設定

  $this->make_form_controle();
  // フォームの妥当性検証
  if (!$this->form->validate()) {
    $this->action = "form";
  }

  if ($this->action == "form") {
    $this->title = '新規登録画面';
    $this->next_type = 'smartphoneregist';
    $this->next_action = 'confirm';
    $btn = '確認画面へ';
  } else {
    if ($this->action == "confirm") {
      $this->title = '確認画面dayo';
      $this->next_type = 'smartphoneregist';
      $this->next_action = 'complete';
      $this->form->toggleFrozen(true);
      $btn = '登録する';
      $btn2 = '戻る';
    } else {
      if ($this->action == "complete" && isset($_POST['submit2']) && $_POST['submit2'] == '戻る') {
        $this->title = '新規登録画面';
        $this->next_type = 'smartphoneregist';
        $this->next_action = 'confirm';
        $btn = '確認画面へ';
      } else {
        if ($this->action == "complete" && isset($_POST['submit']) && $_POST['submit'] == '登録する') {
          $MainModel = new MainModel();
          $data = $this->form->getValue();
          if ($this->is_system) {
            $MainModel->regist_smartphone($data);
            $this->title = '登録完了画面';
            $this->message = "登録を完了しました。";
          } else {
            $MainModel->regist_smartphone($data);
            $this->title = '登録完了画面';
            $this->message = "入力されたIDを登録しました。<br>";
          }
          $this->file = "message.tpl";
        }
      }
    }
  }
  $this->form->addElement('submit', 'submit', ['value' =>$btn]);
  $this->form->addElement('submit', 'submit2', ['value' =>$btn2]);
  $this->form->addElement('reset', 'reset', ['value' =>'取り消し']);
  $this->view_display();
}

public function smartphone_modify($auth = "")
    {
        $btn = "";
        $btn2 = "";
        $this->file = "smartphoneinfo_form.tpl";

        // データベースを操作します。
        $MainModel = new MainModel();
        if ($this->is_system && $this->action == "form") {
            $_SESSION[_MEMBER_AUTHINFO] = $MainModel->get_smartphone_data_id($_GET['id']);
        }
        // フォーム要素のデフォルト値を設定



        $this->make_form_controle();

        // フォームの妥当性検証


        if ($this->action == "form") {
            $this->title = '更新画面';
            $this->next_type = 'smartphonemodify';
            $this->next_action = 'confirm';
            $btn = '確認画面へ';
        } else {
            if ($this->action == "confirm") {
                $this->title = '確認画面';
                $this->next_type = 'smartphonemodify';
                $this->next_action = 'complete';
                $this->form->toggleFrozen(true);
                $btn = '更新する';
                $btn2 = '戻る';
            } else {
                if ($this->action == "complete" && isset($_POST['submit2']) && $_POST['submit2'] == '戻る') {
                    $this->title = '更新画面';
                    $this->next_type = 'smartphonemodify';
                    $this->next_action = 'confirm';
                    $btn = '確認画面へ';
                } else {
                    if ($this->action == "complete" && isset($_POST['submit']) && $_POST['submit'] == '更新する') {
                        $userdata = $this->form->getValue();
                        $this->title = '更新完了画面';
                        $userdata['id'] = $_SESSION[_MEMBER_AUTHINFO]['id'];
                        $MainModel->modify_smartphone($userdata);
                            $this->message = "会員情報を修正しました。";
                            $this->file = "message.tpl";
                            if ($this->is_system) {
                                unset($_SESSION[_MEMBER_AUTHINFO]);
                            } else {
                                $_SESSION[_MEMBER_AUTHINFO] = $MemberModel->get_member_data_id($_SESSION[_MEMBER_AUTHINFO]['id']);
                            }
                        }
                    }
                }
            }


        $this->form->addElement('submit', 'submit', ['value' =>$btn]);
        $this->form->addElement('submit', 'submit2', ['value' =>$btn2]);
        $this->form->addElement('reset', 'reset', ['value' =>'取り消し']);
        $this->view_display();
    }
}
